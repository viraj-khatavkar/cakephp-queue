<?php

namespace VirajKhatavkar\CakePHPQueue\Queues;

interface QueueContract
{
    public function connect($config);

    public function getConnection();

    public function push($job, $data);
}