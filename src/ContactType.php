<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 06/07/2016
 * Time: 23:46
 */

namespace Art;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class ContactType extends  AbstractType
{
    /**
     * Contact form. 
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        return $builder
            ->add('name', TextType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                        'min' => 3
                    ))),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Name'
                )))
            ->add('email', EmailType::class, array(
                'constraints' => new Assert\Email(),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Yourname@somethingmail.com'
                )))
            ->add('message', TextareaType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(), new Assert\Length(array(
                        'min' => 20
                    ))),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Your Message',
                    'rows' => 15
                )
            ));
    }
    public function getName()
    {
        return 'contact';
    }
}