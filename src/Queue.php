<?php

namespace VirajKhatavkar\CakePHPQueue;

use VirajKhatavkar\CakePHPQueue\Queues\Connection;

class Queue
{
    /**
     * @param string|callable $job
     * @param $data
     * @param $connection
     */
    public function push($job, $data, $connection)
    {
        return $this->buildConnection($connection)->push($job, $data);
    }

    /**
     * @param $connection
     * @return \VirajKhatavkar\CakePHPQueue\Queues\QueueContract
     */
    protected function buildConnection($connection)
    {
        return (new Connection($connection))->make();
    }
}