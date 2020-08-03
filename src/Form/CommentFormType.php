<?php

namespace App\Form;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class CommentFormType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('author', NULL, ['label' => 'Your name'])
      ->add('text',null, [ 'required' => FALSE])
      ->add('email', EmailType::class)
      ->add('photo', FileType::class, [
        'required' => FALSE,
        'mapped' => FALSE,
        'constraints' => [
          new Image(['maxSize' => '1024k']),
        ],
      ])
      ->add('createdAt')
      ->add('conference')
      ->add('submit', SubmitType::class)
    ;

  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => Comment::class,
    ]);
  }
}
