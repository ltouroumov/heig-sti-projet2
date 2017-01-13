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

class ComposeFormType extends AbstractType
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tmp = $this->db->executeQuery(
            "SELECT u.id, u.username FROM users u WHERE u.enabled = 1 AND u.id <> ?",
            [$options['ignore_user']]
        )->fetchAll();

        $users = [];
        foreach ($tmp as $row) {
            $users[$row['username']] = $row['id'];
        }

        $builder
            ->add('recipient', Type\ChoiceType::class, [
                'choices' => $users,
                'constraints' => [new Assert\NotBlank()]
            ])
            ->add('subject', Type\TextType::class, [
                'constraints' => [new Assert\NotBlank()]
            ])
            ->add('content', Type\TextareaType::class, [
                'constraints' => [new Assert\NotBlank()],
                'attr' => ['rows' => $options['content_rows']]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'ignore_user' => 0,
            'content_rows' => 20
        ]);
    }


}