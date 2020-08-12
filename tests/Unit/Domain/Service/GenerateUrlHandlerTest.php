<?php
declare(strict_types=1);

namespace ForwardSo\Tests\Unit\Domain\Service;

use ForwardSo\Domain\Command\GenerateUrl;
use ForwardSo\Domain\Encoder;
use ForwardSo\Domain\Repository\UrlRepository;
use ForwardSo\Domain\Service\GenerateUrlHandler;
use ForwardSo\Domain\Url;
use PHPUnit\Framework\TestCase;

final class GenerateUrlHandlerTest extends TestCase
{
    /**
     * @dataProvider validProvider
     * @param string $url
     */
    public function testItWillGenerateSuccessfully(string $url): void
    {
        $command = new GenerateUrl($url);
        $hash = uniqid();

        $encoder = $this->getMockBuilder(Encoder::class)->getMock();
        $encoder->expects($this->once())
            ->method('encode')
            ->willReturn($hash);

        $repository = $this->getMockBuilder(UrlRepository::class)->getMock();
        $repository->expects($this->once())
            ->method("insertOne")
            ->willReturn(rand(1, 100));

        $handler = new GenerateUrlHandler($encoder, $repository);
        $result = $handler->handle($command);
        $this->assertInstanceOf(Url::class, $result);
        $this->assertEquals($url, $result->getOriginal());
        $this->assertEquals(sprintf("https://redirect.so/%s", $hash), $result->getGenerated());
    }

    /**
     * @dataProvider invalidProvider
     * @param string $url
     */
    public function testItWillFailToGenerate(string $url): void
    {
        $command = new GenerateUrl($url);
        $hash = uniqid();

        $encoder = $this->getMockBuilder(Encoder::class)->getMock();
        $encoder->expects($this->once())
            ->method('encode')
            ->willReturn($hash);

        $repository = $this->getMockBuilder(UrlRepository::class)->getMock();
        $repository->expects($this->once())
            ->method("insertOne")
            ->willReturn(rand(1, 100));

        $handler = new GenerateUrlHandler($encoder, $repository);

        $this->expectException(\InvalidArgumentException::class);
        $result = $handler->handle($command);

        $this->assertEquals($url, $result->getOriginal());
        $this->assertEquals(sprintf("https://redirect.so/%s", $hash), $result->getGenerated());
    }

    public function validProvider(): array
    {
        return [
            ["https://google.com"],
            ["https://facebook.com"],
            ["https://twitter.com"],
            ["https://hellofresh.com"],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            ["https://.com"],
            ["https://"],
        ];
    }
}