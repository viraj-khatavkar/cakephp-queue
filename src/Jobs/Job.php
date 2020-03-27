<?php

namespace VirajKhatavkar\CakePHPQueue\Jobs;

abstract class Job
{
    protected $data;

    public function fire()
    {
        $instance = new $this->data['executable'];

        $action = $this->data['action'];

        $instance->$action($this->data['payload']);

//        var_dump($instance);
    }
}