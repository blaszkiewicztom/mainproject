<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendMessageForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('content',TextareaType::class, array(
            'attr' => array(
                'class' => 'form-control',
                'rows' => '5'
            ),
            'label' => 'Treść wiadomości',
        ))
            ->add('submit', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-primary',
                    'value' => $options['submit_value']
                ),
                'label' => 'Wyślij',
            ));



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Message',
            'submit_value' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_send_message_form';
    }
}
