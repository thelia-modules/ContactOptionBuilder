<?php

namespace ContactOptionBuilder\Loop;

use ContactOptionBuilder\Model\ContactOptionFormBuider;
use ContactOptionBuilder\Model\ContactOptionFormBuiderQuery;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;


class ContactOptionLoop extends BaseLoop implements PropelSearchLoopInterface
{
    public $countable = true;

    public $timestampable = false;

    public $versionable = false;

    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument('id_cob'),
            Argument::createBooleanTypeArgument('user_logout')
        );
    }

    public function buildModelCriteria()
    {
        $contacts = ContactOptionFormBuiderQuery::create();

        if($idCob = $this->getIdCob()){
            $contacts->filterByIdCofb($idCob);
        }

        if(true ===  $this->getUserLogout()){
            $contacts->filterByTypeUserCofb(0);
        }

        return $contacts;
    }

    public function parseResults(LoopResult $loopResult)
    {
        /** @var ContactOptionFormBuider $contactForm */
        foreach ($loopResult->getResultDataCollection() as $contactForm) {

            $loopResultRow = new LoopResultRow($contactForm);
            $loopResultRow->set('ID_COB', $contactForm->getIdCofb());
            $loopResultRow->set('SUBJECT_COB', $contactForm->getSubjectCofb());
            $loopResultRow->set('TYPE_USER_COB', $contactForm->getTypeUserCofb());
            $loopResultRow->set('COMMANDE_OPT_COB', $contactForm->getOrderOptCofb());
            $loopResultRow->set('COMPANY_NAME_OPT_COB', $contactForm->getRaisonSocialeOptCofb());
            $loopResultRow->set('MESSAGE_OPT_COB', $contactForm->getMessageCofb());
            $loopResultRow->set('EMAIL_TO_COB', $contactForm->getEmailToCofb());

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}