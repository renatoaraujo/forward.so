<?php
declare(strict_types=1);

namespace ForwardSo\Domain\ServiceBus;

interface EventBus
{
    public function handle(Command $command);
}