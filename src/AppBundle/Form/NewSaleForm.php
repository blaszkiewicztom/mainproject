<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Shipment;
use AppBundle\Entity\WhoPaysOption;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewSaleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name', TextType::class, array(
            'label' => 'Nazwa produktu',
            'attr' => array(
                'class' => 'form-control'
            )
        ))
            ->add('category', EntityType::class, array(
                'label' => 'Kategoria',
                'class' => Category::class,
                'placeholder' => '== Wybierz ==',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Opis produktu',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => 3
                )
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Zawartość',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => 3
                )
            ))
            ->add('minPrice', MoneyType::class, array(
                'label' => 'Cena minimalna',
                'currency' => 'PLN',
                'attr' => array(
                    'class' => 'form-control'
                )

            ))
            ->add('shipment', EntityType::class, array(
                'class' => Shipment::class,
                'label' => 'Typ przesyłki',
                'placeholder' => '== Wybierz ==',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('whoPays', EntityType::class, array(
                'class' => WhoPaysOption::class,
                'label' => 'Koszty przesyłki pokrywa: ',
                'placeholder' => '== Wybierz ==',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'Stan produktu',
                'choices' => array(
                    'Nowy' => 'nowy',
                    'Używany' => 'używany'
                ),
                'placeholder' => '== Wybierz ==',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('expiresAfter', ChoiceType::class, array(
                'label' => 'Długość trwania aukcji',
                'choices' => array(
                    '7 dni' => 7,
                    '14 dni' => 14,
                    '21 dni' => 21,
                ),
                'placeholder' => '== Wybierz ==',
                'attr' => array(
                    'class' => 'form-control'
                )
            ));




    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_new_sale_form';
    }
}