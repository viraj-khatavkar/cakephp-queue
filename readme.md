## CakePHP Queue

An queue library for CakePHP applications. It supports beanstalk.

```php
use VirajKhatavkar\CakePHPQueue\Queue;

(new Queue())->push(
    SomeClassJob::class,
    ['key' => 'value'],
    'connection-name',
);
```