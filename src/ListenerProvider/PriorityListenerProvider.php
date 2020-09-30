<?php

declare(strict_types=1);

namespace YigitCukuren\Events\ListenerProvider;

class PriorityListenerProvider implements ListenerProviderInterface
{
    private $listeners = [];
    private $priorities = [];

    public function subscribe(string $eventClassName, callable $listener, int $priority = 1000): void
    {
        $priority = "$priority.0";

        if (!isset($this->listeners[$priority][$eventClassName])) {
            $this->listeners[$priority][$eventClassName] = [];
        }

        if (\in_array($listener, $this->listeners[$priority][$eventClassName], true)) {
            return;
        }

        $this->listeners[$priority][$eventClassName][] = $listener;

        $this->priorities = array_keys($this->listeners);
        usort($this->priorities, function ($a, $b) {
            return $b <=> $a;
        });
    }

    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->priorities as $priority) {
            foreach ($this->listeners[$priority] as $eventType => $listeners) {
                if ($event instanceof $eventType) {
                    foreach ($listeners as $listener) {
                        yield $listener;
                    }
                }
            }
        }
    }
}
