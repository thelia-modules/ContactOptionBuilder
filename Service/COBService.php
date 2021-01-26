<?php

namespace ContactOptionBuilder\Service;

use ContactOptionBuilder\Model\ContactOptionFormBuilder;
use ContactOptionBuilder\Model\ContactOptionFormBuilderQuery;
use Propel\Runtime\Exception\PropelException;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Model\Lang;
use Thelia\Model\LangQuery;

class COBService
{
    /**
     * @param $data
     * Create a new Form Option
     */
    public function addContactFormOption($data)
    {
        /** @var ContactOptionFormBuilder $cobList */
        $cobList = ContactOptionFormBuilderQuery::create()
            ->useContactOptionFormBuilderI18nQuery()
            ->filterBySubjectCofb($data['subject'])
            ->endUse()
            ->findOne(); // Search an already existing form option with this subject

        try {

            // If a form option with this subject exists, throw an Exception
            if (null !== $cobList) {
                throw new FormValidationException(Translator::getInstance()->trans("Subect already exist !"));
            }

            $cobNewList = new ContactOptionFormBuilder(); // Instantiate a new COB
            $langs = LangQuery::create()->filterByActive(1)->find();

            // Inserting all given data in the new COB and save it
            /** @var Lang $lang */
            foreach ($langs as $lang){
                $cobNewList
                    ->setLocale($lang->getLocale())
                    ->setTypeUserCofb($data['user_thelia_type'])
                    ->setMessageCofb($data['message'])
                    ->setSubjectCofb($data['subject'])
                    ->setOrderOptCofb($data['order_list_option'])
                    ->setRaisonSocialeOptCofb($data['company_name_option'])
                    ->setEmailToCofb($data['email_to'])
                    ;
            }
            $cobNewList->save();

        } catch (PropelException $e) {
            throw new FormValidationException($e->getMessage());
        }
    }

    /**
     * @param $data
     * @throws PropelException
     */
    public function saveContactFormOption($data)
    {
        $cob = ContactOptionFormBuilderQuery::create()->filterByIdCofb($data['cob_id'])->findOne();

        $cob
            ->setLocale($data['locale'])
            ->setTypeUserCofb($data['user_thelia_type'])
            ->setMessageCofb($data['message'])
            ->setSubjectCofb($data['subject'])
            ->setOrderOptCofb($data['order_list_option'])
            ->setRaisonSocialeOptCofb($data['company_name_option'])
            ->setEmailToCofb($data['email_to'])
            ->save();

    }

    /**
     * @param $id
     * Delete a selected Form Option
     */
    public function delContactFormOption($id)
    {
        /** @var ContactOptionFormBuilder $cob */
        $cob = ContactOptionFormBuilderQuery::create()
            ->filterByIdCofb($id)
            ->findOne(); // Search the COB with the id

        // Check if COB exists
        if (null !== $cob) {
            try {
                $cob->delete(); // Delete the COB
            } catch (PropelException $e) {
            }
        }
    }

    /**
     * @param $idSubject
     * @param $locale
     * @return string
     * Get the destination email for the selected subject
     */
    public function getDestinationEmail($idSubject, $locale)
    {
        /** @var ContactOptionFormBuilder $cob */
        $cob = ContactOptionFormBuilderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne(); // Find the COB with the subject

        // Check if COB exists
        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->setLocale($locale)->getEmailToCofb(); // Return the COB Destination Email
    }

    /**
     * @param $idSubject
     * @param $local
     * @return string
     * Get the subject of an option with the ID
     */
    public function getSubject($idSubject, $local)
    {
        /** @var ContactOptionFormBuilder $cob */
        $cob = ContactOptionFormBuilderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne(); // Search the COB with the subject's ID

        // Check if COB exists
        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->setLocale($local)->getSubjectCofb(); // Return the COB subject
    }
}