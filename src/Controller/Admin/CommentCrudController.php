<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }


  public function configureCrud(Crud $crud): Crud
  {
    return $crud
      ->setEntityLabelInSingular('Comment')
      ->setEntityLabelInPlural('Comments');
  }

  public function configureFilters(Filters $filters): Filters {
    return $filters->add('conference');
  }


  public function configureFields(string $pageName): iterable
    {

      $conference = AssociationField::new('conference');
      $author = TextField::new('author');
      $email = EmailField::new('email');
      $createdAt = DateTimeField::new('createdAt')->setSortable(true);
      $text = TextareaField::new('text');


      if (Crud::PAGE_INDEX === $pageName) {
        return [$author, $email, $createdAt->setFormat('short', 'short')];
      }

      if(Crud::PAGE_EDIT === $pageName || Crud::PAGE_NEW || Crud::PAGE_DETAIL ){
        $conference = AssociationField::new('conference');
//        $createdAt->setFormTypeOption('attr', ['readonly' => true]);
        return [$conference, $createdAt, $author, $email, $text ];
      }

      $fields =  parent::configureFields($pageName);
      $fields[] = $conference;
      return $fields;


    }

}
