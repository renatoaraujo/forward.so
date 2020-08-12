<?php
declare(strict_types=1);

namespace ForwardSo\Domain\Service;

use ForwardSo\Domain\Command\GenerateUrl;
use ForwardSo\Domain\Repository\UrlRepository;
use ForwardSo\Domain\Url;
use ForwardSo\Domain\Encoder;

final class GenerateUrlHandler
{
    private Encoder $encoder;
    private UrlRepository $repository;

    public function __construct(Encoder $encoder, UrlRepository $repository)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    public function handle(GenerateUrl $command): Url
    {
        $original = $command->getFullPath();

        $urlId = $this->repository->insertOne($original);
        $encoded = $this->encoder->encode($urlId);
        $generated = sprintf('https://redirect.so/%s', $encoded);

        return Url::fromString($original, $generated);
    }
}