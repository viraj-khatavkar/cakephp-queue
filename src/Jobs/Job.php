<?php

namespace VirajKhatavkar\CakePHPQueue\Jobs;

use Throwable;

abstract class Job
{
    protected $data;

    public function fire()
    {
        $instance = new $this->data['executable'];
        $action = $this->data['action'];

        try {
            $instance->$action($this->data['payload']);
        } catch (Throwable $e) {
            // TODO: log to database table
            // throw the exception
        }
    }
}