<?php
declare(strict_types=1);

namespace ForwardSo\Infrastructure\Repository;

use ForwardSo\Domain\Repository\UrlRepository;
use ForwardSo\Domain\Url;

final class DoctrineUrlRepository implements UrlRepository
{
    public function findOneById(int $id): ?Url
    {
        return Url::fromString("", "");
    }

    public function insertOne(string $url): int
    {
        return rand(0,100);
    }

}