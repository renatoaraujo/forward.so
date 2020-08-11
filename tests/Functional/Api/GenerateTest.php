<?php
declare(strict_types=1);

namespace ForwardSo\Tests\Functional\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GenerateTest extends WebTestCase
{
    public function testRequestToGenerateUrlResponseWithSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/generate', [], [], [], json_encode(["url" => "https://google.com"]));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testRequestFailingWithMissingUrlOnBody()
    {
        $client = static::createClient();
        $client->request('POST', '/generate');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent());
        $this->assertEquals($content->message, "Missing URL on body.");
    }
}