<?php

declare(strict_types=1);

namespace YigitCukuren\Events;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface;
use YigitCukuren\Events\ListenerProvider\ListenerProvider;
use YigitCukuren\Events\ListenerProvider\ListenerProviderInterface;

class EventDispatcher implements EventDispatcherInterface
{
    private ListenerProviderInterface $listenerProvider;

    public function __construct(ListenerProviderInterface $listenerProvider = null)
    {
        $this->listenerProvider = $listenerProvider ?: new ListenerProvider();
    }

    public function subscribe(...$params): void
    {
        $this->listenerProvider->subscribe(...$params);
    }

    public function dispatch(object $event): EventInterface
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);
        $stoppable = $event instanceof StoppableEventInterface;
        foreach ($listeners as $listener) {
            if ($stoppable && $event->isPropagationStopped()) {
                break;
            }
            $listener($event);
        }

        return $event;
    }
}
