<?php

namespace VirajKhatavkar\CakePHPQueue\Queues;

use VirajKhatavkar\CakePHPQueue\Jobs\JobContract;

interface QueueContract
{
    public function connect($config);

    public function getConnection();

    public function push($job, $data);

    public function getNextJob() : JobContract;

    public function runJob();
}