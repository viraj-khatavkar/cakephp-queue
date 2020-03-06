<?php

namespace VirajKhatavkar\CakePHPQueue\Tests;

use Cake\Core\Configure;
use PHPUnit\Framework\TestCase;
use VirajKhatavkar\CakePHPQueue\Connections\Connection;

class QueueTest extends TestCase
{
    /** @test */
    public function queue()
    {
        Configure::write('cakephp_queue', [
            'default' => 'beanstalkd',

            'beanstalkd' => [
                'connector' => 'beanstalkd',
                'host'      => '',
                'port'      => '',
                'queue'     => '',
            ],
        ]);

        $connection = new Connection();

//        var_dump($connection->make());
        $connection->make();
    }
}