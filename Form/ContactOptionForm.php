<?php

namespace ContactOptionBuilder\Form;

use ContactOptionBuilder\Model\ContactOptionFormBuilder;
use ContactOptionBuilder\Model\ContactOptionFormBuilderQuery;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\LangQuery;

class ContactOptionForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add('name', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
                'label' => Translator::getInstance()->trans('Full Name'),
                'label_attr' => array(
                    'for' => 'name_contact',
                ),
            ))
            ->add('email', EmailType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Email(),
                ),
                'label' => Translator::getInstance()->trans('Your Email Address'),
                'label_attr' => array(
                    'for' => 'email_contact',
                ),
            ))
            ->add(
                'contact_subject',
                ChoiceType::class, [
                    'label' => Translator::getInstance()->trans("Contact mail subject"),
                    'label_attr' => array(
                        'for' => 'contact_subject'
                    ),
                    'choices' => $this->getAllSubject(),
                ]
            )
            ->add('message', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
                'label' => Translator::getInstance()->trans('Your Message'),
                'label_attr' => array(
                    'for' => 'message_contact',
                ),

            ))
            ->add(
                'order',
                TextType::class, [
                    'label' => Translator::getInstance()->trans("Your order"),
                    'label_attr' => array(
                        'for' => 'order'
                    ),
                    'required'=> false
                ]
            )
            ->add(
                'company_name',
                TextType::class, [
                    'label' => Translator::getInstance()->trans("Company Name"),
                    'label_attr' => array(
                        'for' => 'company_name'
                    ),
                    'required'=> false
                ]
            );
    }

    public function getAllSubject()
    {
        $subjects = ContactOptionFormBuilderQuery::create()
                        ->find();

        $data =[];

        $lang = $this->getRequest()->getSession()->getLang();
        if (!$lang){
            $lang = LangQuery::create()->filterByByDefault(1)->findOne();
        }

        /** @var ContactOptionFormBuilder $subject */
        foreach ($subjects as $subject){
            $subject->setLocale($lang->getLocale());
            $data[$subject->getSubjectCofb()] = $subject->getIdCofb();
        }

        return $data;
    }

    public static function getName()
    {
        return "contactoptionbuilder_front_form";
    }
}