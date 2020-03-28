<?php


namespace VirajKhatavkar\CakePHPQueue\Jobs;


interface JobContract
{
    public function delete();

    public function fire();
}