<?php

namespace ContactOptionBuilder\Controller;


use ContactOptionBuilder\ContactOptionBuilder;
use ContactOptionBuilder\Form\SubjectAdminForm;
use ContactOptionBuilder\Service\COBService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Model\LangQuery;
use Thelia\Tools\URL;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/module/contactoptionbuilder", name="admin_contact_option_builder")
 * Class AdminController
 * @package ContactOptionBuilder\Controller
 *
 * Let Admin create and remove subject for contact form.
 */
class AdminController extends BaseAdminController
{
    /**
     * @Route("/addsubject", name="_add_subject", methods="POST")
     */
    public function addSubjectAction(COBService $cobService)
    {
        // Check if current user is Admin
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }

        $form = $this->createForm(SubjectAdminForm::getName()); // Create contact form

        try {
            $this->validateForm($form); // Validation of the form constraints

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

    /**
     * @Route("/delsubject/{idSubject}", name="_delete_subject", methods="GET")
     */
    public function delSubjectAction($idSubject, COBService $cobService)
    {
        // Check if current user is Admin
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }

        $cobService->delContactFormOption($idSubject); // Delete option

        // Redirect to module page
        return RedirectResponse::create(
            URL::getInstance()->absoluteUrl('/admin/module/' . ContactOptionBuilder::MODULE_CODE)
        );
    }

    /**
     * @Route("/edit/{idSubject}", name="_show", methods="GET")
     */
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
     * @Route("/savesubject/{idSubject}", name="_save_subject", methods="POST")
     */
    public function saveSubjectAction($idSubject, RequestStack $requestStack)
    {
        $authFail = $this->checkAuth(AdminResources::MODULE, ContactOptionBuilder::DOMAIN_NAME, AccessManager::CREATE);
        if ($authFail !== null) {
            return $authFail;
        }

        $form = $this->createForm(SubjectAdminForm::getName()); // Create contact form

        try {
            $lang = $requestStack->getCurrentRequest()->getSession()->get("thelia.admin.edition.lang");
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