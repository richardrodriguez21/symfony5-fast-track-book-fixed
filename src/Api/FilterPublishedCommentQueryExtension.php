<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-09-11
 * Time: 07:49
 */

namespace App\Api;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Comment;
use Doctrine\ORM\QueryBuilder;

class FilterPublishedCommentQueryExtension implements
  QueryCollectionExtensionInterface, QueryItemExtensionInterface {

  public function applyToCollection(QueryBuilder $qb,
                                    QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = NULL) {
    if (Comment::class === $resourceClass) {
      $qb->andWhere(sprintf("%s.state = 'published'",
        $qb->getRootAliases()[0]));
    }
  }

  public function applyToItem(QueryBuilder $qb, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = NULL, array $context = []) {
    if (Comment::class === $resourceClass) {
      $qb->andWhere(sprintf("%s.state = 'published'",
        $qb->getRootAliases()[0]));
    }
  }
}
