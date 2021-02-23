<?php

namespace ContactOptionBuilder\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class SubjectAdminForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'cob_subject',
                TextType::class, [
                    'label' => Translator::getInstance()->trans("Contact mail subject"),
                    'label_attr' => array(
                        'for' => 'cob_subject'
                    ),
                    'constraints' => [
                        new Assert\NotBlank
                    ],
                ]
            )
            ->add(
                'cob_message',

                TextareaType::class, [
                    'label' => Translator::getInstance()->trans("Contact mail comment"),
                    'label_attr' => array(
                        'for' => 'cob_message'
                    ),
                    'required'=> false
                ]
            )
            ->add(
                'cob_user_thelia',

                CheckboxType::class, [
                    'label' => Translator::getInstance()->trans("User Thelia"),
                    'label_attr' => array(
                        'for' => 'cob_user_thelia'
                    ),
                    'required'=> false
                ]
            )
            ->add(
                'cob_order_option',

                CheckboxType::class, [
                    'label' => Translator::getInstance()->trans("Display order list"),
                    'label_attr' => array(
                        'for' => 'cob_order_option'
                    ),
                    'required'=> false
                ]
            )
            ->add(
                'cob_rs_option',

                CheckboxType::class, [
                    'label' => Translator::getInstance()->trans("Display input company name"),
                    'label_attr' => array(
                        'for' => 'cob_rs_option'
                    ),
                    'required'=> false
                ]
            )
            ->add(
                'email_to',
                EmailType::class, [
                    'label' => Translator::getInstance()->trans("Destination email to send message"),
                    'label_attr' => array(
                        'for' => 'email_to'
                    ),
                    'constraints' => [
                        new Assert\Email()
                    ]
                ]
            );
    }

    public function getName()
    {
        return "contact_option_builder_subject";
    }
}