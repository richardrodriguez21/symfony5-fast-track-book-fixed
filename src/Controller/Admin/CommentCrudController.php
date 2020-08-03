<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FormFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\File;

class CommentCrudController extends AbstractCrudController
{
    private $photoDir;

  /**
   * CommentCrudController constructor.
   *
   * @param $photosDir
   */
  public function __construct(string $photoDir) {
    $this->photoDir = $photoDir;
  }


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
      $state = TextField::new('state');
      $email = EmailField::new('email');
      $createdAt = DateTimeField::new('createdAt')->setSortable(true);
      $text = TextareaField::new('text');
      $photoFilename = ImageField::new('photoFilename', 'Photo')->setBasePath('/uploads/photos');

      if (Crud::PAGE_INDEX === $pageName) {
        return [$author,$state,  $email, $photoFilename, $createdAt->setFormat('short', 'short')];
      }

      if(Crud::PAGE_EDIT === $pageName || Crud::PAGE_NEW || Crud::PAGE_DETAIL ){
        $conference = AssociationField::new('conference');
//        $createdAt->setFormTypeOption('attr', ['readonly' => true]);
        return [$conference, $createdAt, $author,$state, $email, $text];
      }

      $fields =  parent::configureFields($pageName);
      $fields[] = $conference;
      return $fields;


    }





}
