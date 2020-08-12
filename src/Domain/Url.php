<?php
declare(strict_types=1);

namespace ForwardSo\Domain;

final class Url implements \JsonSerializable
{
    private string $original;
    private string $generated;

    private function __construct()
    {
    }

    public static function fromString(string $original, string $generated): Url
    {
        $instance = new Url();

        if (false === filter_var($original, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid url given.', 400);
        }

        $instance->original = $original;
        $instance->generated = $generated;
        return $instance;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getGenerated(): string
    {
        return $this->generated;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}