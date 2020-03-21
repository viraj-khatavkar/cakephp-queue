<?php

namespace VirajKhatavkar\CakePHPQueue\Queues;

use Cake\Core\Configure;
use Pheanstalk\Contract\PheanstalkInterface;
use Pheanstalk\Pheanstalk;

class Beanstalkd implements QueueContract
{
    /** @var Pheanstalk */
    protected $connection;

    protected $queue;

    public function connect($config)
    {
        $this->connection = Pheanstalk::create(
            $config['host'],
            $config['port'] ?: PheanstalkInterface::DEFAULT_PORT
        );

        $this->queue = $config['queue'] ?: PheanstalkInterface::DEFAULT_TUBE;

        return $this;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function push($job, $data)
    {
        return $this->getConnection()->useTube($this->queue)->put(
            $this->prepareData($job, $data)
        );
    }

    protected function prepareData($job, $data)
    {
        return json_encode([
            'job'  => $job,
            'data' => $data,
        ]);
    }
}