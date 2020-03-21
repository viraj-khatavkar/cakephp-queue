<?php

namespace VirajKhatavkar\CakePHPQueue\Tests;

use Cake\Core\Configure;
use Pheanstalk\Job;
use Pheanstalk\Pheanstalk;
use PHPUnit\Framework\TestCase;
use VirajKhatavkar\CakePHPQueue\Queues\Connection;
use VirajKhatavkar\CakePHPQueue\Queue;

class QueueTest extends TestCase
{
    /** @test */
    public function can_connect_to_beanstalk()
    {
        Configure::write('cakephp_queue', [
            'default' => 'beanstalkd',

            'beanstalkd' => [
                'connector' => 'beanstalkd',
                'host'      => '127.0.0.1',
                'port'      => '',
                'queue'     => '',
            ],

            'queue-with-custom-name' => [
                'connector' => 'beanstalkd',
                'host'      => '127.0.0.1',
                'port'      => '',
                'queue'     => '',
            ],
        ]);

        $connection = new Connection();
        $connector = $connection->make();

        $this->assertInstanceOf(Pheanstalk::class, $connector->getConnection());

        $connection = new Connection('queue-with-custom-name');
        $connector = $connection->make();

        $this->assertInstanceOf(Pheanstalk::class, $connector->getConnection());
    }

    /** @test */
    public function can_push_job_to_beanstalk()
    {
        Configure::write('cakephp_queue', [
            'default' => 'beanstalkd',

            'beanstalkd' => [
                'connector' => 'beanstalkd',
                'host'      => '127.0.0.1',
                'port'      => '',
                'queue'     => '',
            ],

            'queue-with-custom-name' => [
                'connector' => 'beanstalkd',
                'host'      => '127.0.0.1',
                'port'      => '',
                'queue'     => '',
            ],
        ]);

        $queue = new Queue();

        /** @var Job $pushedJob */
        $pushedJob = $queue->push('test job', 'abc', 'default');

        $this->assertInstanceOf(Job::class, $pushedJob);
        $this->assertSame('abc', json_decode($pushedJob->getData(), true)['data']);
    }
}