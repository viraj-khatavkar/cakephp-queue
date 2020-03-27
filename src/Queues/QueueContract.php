<?php

namespace VirajKhatavkar\CakePHPQueue\Queues;

use VirajKhatavkar\CakePHPQueue\Jobs\Job;

interface QueueContract
{
    public function connect($config);

    public function getConnection();

    public function push($job, $data);

    public function getNextJob();

    public function runJob();
}