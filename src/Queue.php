<?php

namespace VirajKhatavkar\CakePHPQueue;

use VirajKhatavkar\CakePHPQueue\Connections\Connection;

class Queue
{
    public function push($job, $data, $connection)
    {
        $this->buildConnection($connection);
    }

    /**
     * @param $connection
     * @return \VirajKhatavkar\CakePHPQueue\Connections\ConnectionContract
     */
    protected function buildConnection($connection)
    {
        return (new Connection($connection))->make();
    }
}