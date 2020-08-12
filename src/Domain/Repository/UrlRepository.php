<?php
declare(strict_types=1);

namespace ForwardSo\Domain\Repository;

use ForwardSo\Domain\Url;

interface UrlRepository
{
    public function findOneById(int $id): ?Url;
    public function insertOne(string $url): int;
}