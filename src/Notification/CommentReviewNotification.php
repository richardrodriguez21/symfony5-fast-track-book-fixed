<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-09-06
 * Time: 10:47
 */

namespace App\Notification;

use App\Entity\Comment;
use Symfony\Component\Notifier\Message\EmailMessage;

use Symfony\Component\Notifier\Notification\EmailNotificationInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;

class CommentReviewNotification extends Notification implements
  EmailNotificationInterface {

  private $comment;

  public function __construct(Comment $comment) {
    $this->comment = $comment;
    parent::__construct('New comment posted');
  }

  public function asEmailMessage(Recipient $recipient, string $transport =
  NULL): ?EmailMessage {
    $message = EmailMessage::fromNotification($this, $recipient,
      $transport);
    $message->getMessage()
      ->htmlTemplate('emails/comment_notification.html.twig')
      ->context(['comment' => $this->comment]);
    return $message;
  }
}