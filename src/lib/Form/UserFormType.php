<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 1/12/17
 * Time: 6:05 PM
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', Type\TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex('/^(\w|-|_)+$/')
                ]
            ])
            ->add('plain_password', Type\RepeatedType::class, [
                'type' => Type\PasswordType::class,
                'required' => $options['requires_password'],
                'first_options' => [
                    'label' => 'Password',
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ]
            ])
            ->add('roles', Type\TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^ROLE_[A-Z_]+$/'
                    ])
                ]
            ])
            ->add('enabled', Type\CheckboxType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'requires_password' => false
        ]);
    }


}