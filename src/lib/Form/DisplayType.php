<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisplayType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getParent()
    {
        return TextType::class;
    }
}
