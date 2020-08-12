<?php
declare(strict_types=1);

namespace ForwardSo\Infrastructure\ServiceBus;

use ForwardSo\Domain\ServiceBus\Command;
use ForwardSo\Domain\ServiceBus\EventBus;
use League\Tactician\CommandBus;

final class TacticianEventBus implements EventBus
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(Command $command)
    {
        return $this->commandBus->handle($command);
    }

}