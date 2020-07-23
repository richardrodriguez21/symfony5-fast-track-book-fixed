<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-07-15
 * Time: 23:53
 */

namespace App;

use App\Entity\Comment;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SpamChecker {

  private $client;

  private $endpoint;

  private $akismeKey;

  public function __construct(HttpClientInterface $client, string $akismetKey) {
    $this->client = $client;
    $this->akismeKey = $akismetKey;
    $this->endpoint = sprintf('https://%s.rest.akismet.com/1.1/comment-check',
      $akismetKey);
  }

  /**
   * @return int Spam score: 0: not spam, 1: maybe spam, 2: blatant spam
   *
   * @throws \RuntimeException if the call did not work
   */
  public function getSpamScore(Comment $comment, array $context): int {
    // validatekey

//   $response = $this->client->request('POST', 'https://rest.akismet.com/1.1/verify-key', [
//      'body' => array_merge($context, [
//        'key' => $this->akismeKey,
//        'blog' => 'https://guestbook.wip'
//      ]),
//    ]);
//
//   dump($response);


    $response = $this->client->request('POST', $this->endpoint, [
      'body' => array_merge($context, [
        'blog' => 'https://guestbook.wip',
        'comment_type' => 'comment',
        'comment_author' => $comment->getAuthor(),
        'comment_author_email' => $comment->getEmail(),
        'comment_content' => $comment->getText(),
        'comment_date_gmt' => $comment->getCreatedAt()->format('c'),
        'blog_lang' => 'en',
        'blog_charset' => 'UTF-8',
        'is_test' => TRUE,
      ]),
    ]);
    $headers = $response->getHeaders();
    if ('discard' === ($headers['x-akismet-pro-tip'][0] ?? '')) {
      return 2;
    }
    $content = $response->getContent();
    if (isset($headers['x-akismet-debug-help'][0])) {
      throw new \RuntimeException(sprintf('Unable to check for spam: %s
(%s).', $content, $headers['x-akismet-debug-help'][0]));
    }
    return 'true' === $content ? 1 : 0;
  }
}