<?php
declare(strict_types=1);

namespace ForwardSo\Domain;

interface Encoder
{
    public function encode(int $urlId): string;
    public function decode(string $hash): array;
}