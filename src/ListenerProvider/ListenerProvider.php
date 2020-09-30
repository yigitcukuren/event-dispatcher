<?php

declare(strict_types=1);

namespace YigitCukuren\Events\ListenerProvider;

class ListenerProvider implements ListenerProviderInterface
{
    private $listeners = [];

    public function subscribe(string $eventClassName, callable $listener): void
    {
        if (!isset($this->listeners[$eventClassName])) {
            $this->listeners[$eventClassName] = [];
        }

        if (\in_array($listener, $this->listeners[$eventClassName], true)) {
            return;
        }

        $this->listeners[$eventClassName][] = $listener;
    }

    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->listeners as $eventType => $listeners) {
            if (!$event instanceof $eventType) {
                continue;
            }
            foreach ($listeners as $listener) {
                yield $listener;
            }
        }
    }
}
