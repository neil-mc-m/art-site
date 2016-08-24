<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 21/08/2016
 * Time: 22:46
 */

namespace Art;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateType
 * @package Art
 */
class UpdateType extends AbstractType
{
    /**
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
                    ))
                ),
                'attr' => array(
                    'placeholder' => 'e.g. iontas'
                )
            ))
            ->add('location', TextType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                        'min' => 3
                    ))
                ),
                'attr' => array(
                    'placeholder' => 'the gallery and city/town'
                )
            ))
            ->add('type', TextType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                        'min' => 3
                    ))
                ),
                'attr' => array(
                    'placeholder' => 'group, solo etc'
                )
            ))
            ->add('year', IntegerType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Type(array(
                        'type' => 'integer'
                    )),
                    new Assert\Range(array(
                        'min' => 2000,
                        'max' => 2040
                    ))
                ),
                'attr' => array(
                    'placeholder' => 'the year'
                )
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'update';
    }
}