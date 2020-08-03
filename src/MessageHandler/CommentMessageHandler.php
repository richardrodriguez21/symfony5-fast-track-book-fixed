<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-08-03
 * Time: 09:19
 */

namespace App\MessageHandler;

use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\SpamChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CommentMessageHandler implements MessageHandlerInterface {

  private $spamChecker;

  private $entityManager;

  private $commentRepository;

  public function __construct(EntityManagerInterface $entityManager,
                              SpamChecker $spamChecker, CommentRepository $commentRepository) {
    $this->entityManager = $entityManager;
    $this->spamChecker = $spamChecker;
    $this->commentRepository = $commentRepository;
  }

  public function __invoke(CommentMessage $message) {
    $comment = $this->commentRepository->find($message->getId());
    if (!$comment) {
      return;
    }
    if (1 === $this->spamChecker->getSpamScore($comment,
        $message->getContext())) {
      $comment->setState('spam');
    }
    else {
      $comment->setState('published');
    }
    $this->entityManager->flush();
  }
}