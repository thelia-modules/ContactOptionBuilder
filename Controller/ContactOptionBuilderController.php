<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia	                                                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*	    along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/

namespace ContactOptionBuilder\Controller;

use ContactOptionBuilder\ContactOptionBuilder;
use ContactOptionBuilder\Service\COBService;

use ReCaptcha\Event\ReCaptchaCheckEvent;
use ReCaptcha\Event\ReCaptchaEvents;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Log\Tlog;
use Thelia\Model\ConfigQuery;

/**
 * Class ContactOptionBuilderController
 * @package ContactOptionBuilder\Controller
 *
 * Call when contact form is submitted.
 */
class ContactOptionBuilderController extends BaseFrontController
{

    public function sendAction()
    {
        // Obtain and dipatch CAPTCHA event
        $checkCaptchaEvent = new ReCaptchaCheckEvent();
        $this->dispatch(ReCaptchaEvents::CHECK_CAPTCHA_EVENT, $checkCaptchaEvent);

        $contactForm = $this->createForm('contactoptionbuilder.front.form'); // Get contact form

        try {
            $form = $this->validateForm($contactForm); // Validation of the form constraints

            // Check CAPTCHA success
            if ($checkCaptchaEvent->isHuman() == false) {
                $err_message = $this->getTranslator()->trans(
                    "Invalid captcha",
                    [],
                    ContactOptionBuilder::MESSAGE_DOMAIN
                );
                throw new FormValidationException($err_message);
            }

            $subjectId = $form->get('contact_subject')->getData();

            /** @var COBService $cobService */
            $cobService = $this->getContainer()->get('contactoptionbuilder.service'); // Get COB Service

            $to = $cobService->getDestinationEmail($subjectId); // Get destination email for selected subject
            $subjectLabel = $cobService->getSubject($subjectId); // Get subject label for selected subject

            // Creating email template
            $htmlBody = '<p><strong>'.$subjectLabel.'</strong></p>';
            $htmlBody .= '<p>'.$form->get('message')->getData().'</p>';
            $htmlBody .= '<p>'.$form->get('name')->getData().'/'.$form->get('email')->getData().'</p>';

            // If there is a company name, add it to the email
            if($form->get('company_name')->getData()){
                $htmlBody.='<span>Raison sociale :';
                $htmlBody.= $form->get('company_name')->getData().'</span>';
            }

            // If there is an order reference, add it to the email
            if($form->get('order')->getData()){
                $htmlBody.='</p><span>Commande n°:';
                $htmlBody.= $form->get('order')->getData().'</span>';
            }

            // Send the mail
            $this->getMailer()->sendSimpleEmailMessage(
                [ConfigQuery::getStoreEmail() => $form->get('name')->getData()],
                [$to],
                $subjectLabel,
                $htmlBody,
                '',
                [],
                [],
                [$form->get('email')->getData() => $form->get('name')->getData()]
            );

            // Auto redirect with success case
            if ($contactForm->hasSuccessUrl()) {
                return $this->generateSuccessRedirect($contactForm);
            }

            return $this->generateRedirectFromRoute('contact.success'); // Explicit redirect

        } catch (FormValidationException $e) {
            $error_message = $e->getMessage();
        }

        Tlog::getInstance()->error(sprintf('Error during sending contact mail : %s', $error_message));

        $contactForm->setErrorMessage($error_message);

        $this->getParserContext()
            ->addForm($contactForm)
            ->setGeneralError($error_message);

        // Redirect to error URL if defined
        if ($contactForm->hasErrorUrl()) {
            return $this->generateErrorRedirect($contactForm);
        }
    }
}
