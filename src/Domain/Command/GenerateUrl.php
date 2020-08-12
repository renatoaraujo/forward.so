<?php
declare(strict_types=1);

namespace ForwardSo\Domain\Command;

use ForwardSo\Domain\ServiceBus\Command;

final class GenerateUrl implements Command
{
    private string $fullPath;

    public function __construct(string $fullPath)
    {
        $this->fullPath = $fullPath;
    }

    public function getFullPath(): string
    {
        return $this->fullPath;
    }
}