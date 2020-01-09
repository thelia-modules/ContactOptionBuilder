<?php

namespace ContactOptionBuilder\Service;

use ContactOptionBuilder\Model\ContactOptionFormBuider;
use ContactOptionBuilder\Model\ContactOptionFormBuiderQuery;
use Propel\Runtime\Exception\PropelException;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;

class COBService
{
    public function addContactFormOption($data)
    {
        /** @var ContactOptionFormBuider $cobList */
        $cobList = ContactOptionFormBuiderQuery::create()
            ->filterBySubjectCofb($data['subject'])
            ->findOne();
        try {

            if (null !== $cobList) {
                throw new FormValidationException(Translator::getInstance()->trans("Subect already exist !"));
            }

            $cobNewList = new ContactOptionFormBuider();

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

    public function delContactFormOption($id)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
            ->filterByIdCofb($id)
            ->findOne();

        if (null !== $cob) {
            try {
                $cob->delete();
            } catch (PropelException $e) {
            }
        }
    }

    public function getDestinationEmail($idSubject)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne();

        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->getEmailToCofb();
    }

    public function getSubject($idSubject)
    {
        /** @var ContactOptionFormBuider $cob */
        $cob = ContactOptionFormBuiderQuery::create()
            ->filterByIdCofb($idSubject)
            ->findOne();

        if (null === $cob) {
            throw new FormValidationException(Translator::getInstance()->trans("Subject does not exist !"));
        }

        return $cob->getSubjectCofb();
    }
}