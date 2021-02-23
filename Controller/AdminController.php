<?php

namespace ContactOptionBuilder\Controller;


use ContactOptionBuilder\ContactOptionBuilder;
use ContactOptionBuilder\Service\COBService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Model\LangQuery;
use Thelia\Tools\URL;

/**
 * Class AdminController
 * @package ContactOptionBuilder\Controller
 *
 * Let Admin create and remove subject for contact form.
 */
class AdminController extends BaseAdminController
{
    public function addSubjectAction()
    {
        // Check if current user is Admin
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }

        $form = $this->createForm('contactoptionbuilder.subject.form'); // Create contact form

        try {
            $this->validateForm($form); // Validation of the form constraints

            /** @var COBService $cobService */
            $cobService = $this->getContainer()->get('contactoptionbuilder.service'); // Get COB service

            // Get COB parameters (has order / need user connected)
            $orderListOption = $form->getForm()->get('cob_order_option')->getData();
            $userThelia = $form->getForm()->get('cob_user_thelia')->getData();

            // Check if order list option is set but doesn't need user to be connected => impossible
            if (true === $orderListOption && false === $userThelia){
                throw new FormValidationException(Translator::getInstance()->trans("Can't show order list only for user thelia"));
            }

            // Get data from Form
            $dataConfiguration = [
                'subject' => $form->getForm()->get('cob_subject')->getData(),
                'message' => $form->getForm()->get('cob_message')->getData(),
                'user_thelia_type' =>$userThelia,
                'order_list_option' => $orderListOption,
                'company_name_option' => $form->getForm()->get('cob_rs_option')->getData(),
                'email_to' => $form->getForm()->get('email_to')->getData(),
            ];

            //Adding Form Option
            $cobService->addContactFormOption($dataConfiguration);

        } catch (FormValidationException $error_message) {
            $this->setupFormErrorContext(
                'Subject configuration',
                $error_message->getMessage(),
                $form
            );

            return $this->render(
                'module-configure',
                [
                    'module_code' => ContactOptionBuilder::MODULE_CODE
                ]
            );
        }

        // Redirect to module page
        return RedirectResponse::create(
            URL::getInstance()->absoluteUrl('/admin/module/' . ContactOptionBuilder::MODULE_CODE)
        );
    }

    public function delSubjectAction($idSubject)
    {
        // Check if current user is Admin
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }


        /** @var COBService $cobService */
        $cobService = $this->getContainer()->get('contactoptionbuilder.service'); // Get COB service

        $cobService->delContactFormOption($idSubject); // Delete option

        // Redirect to module page
        return RedirectResponse::create(
            URL::getInstance()->absoluteUrl('/admin/module/' . ContactOptionBuilder::MODULE_CODE)
        );
    }

    public function showEditPageAction($idSubject)
    {
        return $this->render('edit_subject',[
            'idSubject' => $idSubject
        ], 200);
    }

    /**
     * @param $idSubject
     * @return mixed|\Symfony\Component\HttpFoundation\Response|\Thelia\Core\HttpFoundation\Response|static
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function saveSubjectAction($idSubject)
    {
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }

        $form = $this->createForm('contactoptionbuilder.subject.form'); // Create contact form

        try {
            $lang = $this->getRequest()->getSession()->get("thelia.admin.edition.lang");
            if (!$lang){
                $lang = LangQuery::create()->filterByByDefault(1)->findOne();
            }
            $this->validateForm($form); // Validation of the form constraints

            /** @var COBService $cobService */
            $cobService = $this->getContainer()->get('contactoptionbuilder.service'); // Get COB service

            // Get COB parameters (has order / need user connected)
            $orderListOption = $form->getForm()->get('cob_order_option')->getData();
            $userThelia = $form->getForm()->get('cob_user_thelia')->getData();

            // Check if order list option is set but doesn't need user to be connected => impossible
            if (true === $orderListOption && false === $userThelia){
                throw new FormValidationException(Translator::getInstance()->trans("Can't show order list only for user thelia"));
            }
            $lang = $this->getSession()->get('thelia.admin.edition.lang');

            // Get data from Form
            $dataConfiguration = [
                'locale' => $lang->getLocale(),
                'cob_id' => $idSubject,
                'subject' => $form->getForm()->get('cob_subject')->getData(),
                'message' => $form->getForm()->get('cob_message')->getData(),
                'user_thelia_type' =>$userThelia,
                'order_list_option' => $orderListOption,
                'company_name_option' => $form->getForm()->get('cob_rs_option')->getData(),
                'email_to' => $form->getForm()->get('email_to')->getData(),
            ];

            $cobService->saveContactFormOption($dataConfiguration);

        } catch (FormValidationException $error_message) {
            $this->setupFormErrorContext(
                'Subject configuration',
                $error_message->getMessage(),
                $form
            );

            return $this->render(
                'edit_subject',
                [
                    'idSubject' => $idSubject
                ]
            );
        }
        return RedirectResponse::create(
            URL::getInstance()->absoluteUrl('/admin/module/contactoptionbuilder/edit/' . $idSubject)
        );
    }
}