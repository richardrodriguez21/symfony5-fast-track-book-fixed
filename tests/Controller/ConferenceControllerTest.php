<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

//class ConferenceControllerTest extends WebTestCase {
class ConferenceControllerTest extends PantherTestCase {

  public function testIndex() {
    $client = static::createClient();
    $client->request('GET', '/');
    $this->assertResponseIsSuccessful();
    $this->assertSelectorTextContains('h2', 'Give your feedback');
  }


  public function testCommentSubmission() {
    //    $client = static::createClient();
    //
    $client = static::createPantherClient([
      'external_base_uri' =>
        'https://127.0.0.1:8000/',
    ]);
   $client->request('GET', 'conference/amsterdam-2019');
    $client->submitForm('comment_form_submit', [
      'comment_form[author]' => 'Fabien',
      'comment_form[text]' => 'Some feedback from an automated functional test',
      'comment_form[email]' => 'me@automat.ed',
      'comment_form[photo]' => dirname(__DIR__, 2) . '/public/images/underconstruction.gif',
    ]);

    $this->assertSelectorTextContains('div', 'There are 2 comments');

  }

  public function testConferencePage() {
    $client =   $client = static::createPantherClient([
      'external_base_uri' =>
        'https://127.0.0.1:8000/',
    ]);
    $crawler = $client->request('GET', '');
    $client->wait(2);

    $this->assertCount(2, $crawler->filter('h4'));

    $client->clickLink('View');

    $this->assertPageTitleContains('Amsterdam');
    $client->wait(1);
    $this->assertSelectorTextContains('h2', 'Amsterdam 2019');
//    $this->assertSelectorTextContains('div', 'There are 1 comments');
  }
}