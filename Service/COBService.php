<?php

namespace ContactOptionBuilder\Service;

use ContactOptionBuilder\Model\ContactOptionFormBuider;
use ContactOptionBuilder\Model\ContactOptionFormBuiderQuery;
use Propel\Runtime\Exception\PropelException;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;

class COBService
{
    /**
     * @param $data
     * Create a new Form Option
     */
    public function addContactFormOption($data)
    {
        /** @var ContactOptionFormBuider $cobList */
        $cobList = ContactOptionFormBuiderQuery::create()
            ->filterBySubjectCofb($data['subject'])
            ->findOne(); // Search an already existing form option with this subject

        try {

            // If a form option with this subject exists, throw an Exception
            if (null !== $cobList) {
                throw new FormValidationException(Translator::getInstance()->trans("Subect already exist !"));
            }

            $cobNewList = new ContactOptionFormBuider(); // Instantiate a new COB

            // Inserting all given data in the new COB and save it
            $cobNewList
                ->setTypeUserCofb($data['user_thelia_type'])
                ->setMessageCofb($data['message'])
                ->setSubjectCofb($data['subject'])
                ->setOrderOptCofb($data['order_list_option'])
                ->setRaisonSocialeOptCofb($data['company_name_option'])
                ->setEmailToCofb($data['email_to'])
                ->save();

        } catch (PropelException $e) {
            throw new FormValidationException($e->getMessage());
        }
    }

    /**
     * @param $id
     * Delete a selected Form Option
     */
    public function delContactFormOption($id)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
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
     * @return string
     * Get the destination email for the selected subject
     */
    public function getDestinationEmail($idSubject)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne(); // Find the COB with the subject

        // Check if COB exists
        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->getEmailToCofb(); // Return the COB Destination Email
    }

    /**
     * @param $idSubject
     * @return string
     * Get the subject of an option with the ID
     */
    public function getSubject($idSubject)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne(); // Search the COB with the subject's ID

        // Check if COB exists
        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->getSubjectCofb(); // Return the COB subject
    }
}