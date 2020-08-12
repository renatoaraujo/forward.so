<?php
declare(strict_types=1);

namespace ForwardSo\Infrastructure\Decorator;

use ForwardSo\Domain\Encoder;
use Hashids\Hashids;

final class HashIdsEncoder implements Encoder
{
    private Hashids $hashids;

    public function __construct()
    {
        $this->hashids = new Hashids();
    }

    public function encode(int $urlId): string
    {
        return $this->hashids->encode($urlId);
    }

    public function decode(string $hash): array
    {
        return $this->hashids->decode($hash);
    }
}