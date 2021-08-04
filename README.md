# yigitcukuren/event-dispatcher

Simple PSR-14 Event Dispatcher

## Example Usage

```php
use App\Events\AppOpened;
use App\Listeners\First;
use App\Listeners\Second;
use YigitCukuren\Events\EventDispatcher;
use YigitCukuren\Events\ListenerProvider\PriorityListenerProvider;

$dispatcher = new EventDispatcher(new PriorityListenerProvider());
$dispatcher->subscribe(AppOpened::class, new First(), 0);
$dispatcher->subscribe(AppOpened::class, new Second(), 1);
$dispatcher->subscribe(AppOpened::class, function (AppOpened $event) {
  echo '<pre>';
  var_dump($event);
}, 2);

$dispatcher->dispatch(new AppOpened('app'));

```