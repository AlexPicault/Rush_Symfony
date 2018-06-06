<?php

namespace AppBundle\Form;

use AppBundle\Entity\product;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class searchProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required'=>false
            ))
            ->add('category')
            ->add('immediatePrice', TextType::class, array(
                'required'=>false,
            ))
            ->add('price', TextType::class, array(
                'required'=>false,
                'label' =>'min price'
            ))
            ->add('immediatePrice', TextType::class, array(
                'required'=>false,
                'label' =>'max price'
            ))
            ->add('goooo', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\category',
            'data_class' => 'AppBundle\Entity\product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'search';
    }
}
