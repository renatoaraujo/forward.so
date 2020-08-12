<?php
declare(strict_types=1);

namespace ForwardSo\Tests\Functional\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GenerateTest extends WebTestCase
{
    public function testRequestToGenerateUrlResponseWithSuccess()
    {
        $url = "https://google.com";
        $client = static::createClient();
        $client->request('POST', '/generate', [], [], [], json_encode(["url" => $url]));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent());
        $this->assertEquals($url, $content->original);
        $this->assertNotEquals($url, $content->generated);
    }

    public function testRequestFailingWithMissingUrlOnBody()
    {
        $client = static::createClient();
        $client->request('POST', '/generate');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent());
        $this->assertEquals("Missing URL on body.", $content->message);
    }
}