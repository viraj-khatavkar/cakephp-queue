<?php

use VirajKhatavkar\CakePHPQueue\Queue;

if (!function_exists('dispatchJob')) {

    function dispatchJob($job)
    {
        (new Queue())->push();
    }

}