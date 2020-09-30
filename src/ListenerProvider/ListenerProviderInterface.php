<?php

declare(strict_types=1);

namespace YigitCukuren\Events\ListenerProvider;

interface ListenerProviderInterface extends \Psr\EventDispatcher\ListenerProviderInterface
{
  public function subscribe(string $event, callable $listener): void;
}
