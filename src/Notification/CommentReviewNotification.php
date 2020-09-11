<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-09-06
 * Time: 10:47
 */

namespace App\Notification;

use Symfony\Component\Notifier\Bridge\Slack\Block\SlackDividerBlock;
use Symfony\Component\Notifier\Bridge\Slack\Block\SlackSectionBlock;
use Symfony\Component\Notifier\Bridge\Slack\SlackOptions;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Message\EmailMessage;
use Symfony\Component\Notifier\Notification\ChatNotificationInterface;
use Symfony\Component\Notifier\Notification\EmailNotificationInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;

class CommentReviewNotification extends Notification implements
  EmailNotificationInterface, ChatNotificationInterface {

  private $comment;

  public function __construct(Comment $comment) {
    $this->comment = $comment;
    parent::__construct('New comment posted');
  }

  public function asChatMessage(Recipient $recipient, string $transport =
  NULL): ?ChatMessage {
    if ('slack' !== $transport) {
      return NULL;
    }

    $message = ChatMessage::fromNotification($this, $recipient,
      $transport);
    $message->subject($this->getSubject());
    $message->options((new SlackOptions())
      ->iconEmoji('tada')
      ->iconUrl('https://guestbook.example.com')
      ->username('Guestbook')
      ->block((new SlackSectionBlock())->text($this->getSubject()))
      ->block(new SlackDividerBlock())
      ->block((new SlackSectionBlock())
        ->text(sprintf('%s (%s) says: %s', $this->comment
          ->getAuthor(), $this->comment->getEmail(), $this->comment->getText()))
      )
    );

    return $message;
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

  public function getChannels(Recipient $recipient): array {
    if (preg_match('{\b(great|awesome)\b}i', $this->comment->getText())) {
      return ['email', 'chat/slack'];
    }

    $this->importance(Notification::IMPORTANCE_LOW);

    return ['email'];
  }
}