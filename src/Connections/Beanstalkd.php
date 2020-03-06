<?php

namespace VirajKhatavkar\CakePHPQueue\Connections;

use Cake\Core\Configure;
use Pheanstalk\Pheanstalk;

class Beanstalkd implements ConnectionContract
{
    /** @var Pheanstalk */
    protected $connection;

    public function connect($config)
    {
        print_r($config);
//        $this->connection = Pheanstalk::create(
//            Configure::read('cakephp_queue.beanstalkd.host'),
//            Configure::read('cakephp_queue.beanstalkd.port'),
//            Configure::read('cakephp_queue.beanstalkd.timeout')
//        );

        return $this;
    }
}