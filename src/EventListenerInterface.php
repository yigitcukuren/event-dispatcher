<?php

declare(strict_types=1);

namespace YigitCukuren\Events;

interface EventListenerInterface
{
    public function __invoke(EventInterface $event);
}
