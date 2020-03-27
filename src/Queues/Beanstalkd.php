<?php

namespace VirajKhatavkar\CakePHPQueue\Queues;

use Cake\Core\Configure;
use Opis\Closure\SerializableClosure;
use Pheanstalk\Contract\PheanstalkInterface;
use Pheanstalk\Pheanstalk;
use VirajKhatavkar\CakePHPQueue\Job;
use VirajKhatavkar\CakePHPQueue\Jobs\BeanstalkdJob;

class Beanstalkd implements QueueContract
{
    /** @var Pheanstalk */
    protected $pheanstalk;

    protected $queue;

    public function connect($config)
    {
        $this->pheanstalk = Pheanstalk::create(
            $config['host'],
            $config['port'] ?: PheanstalkInterface::DEFAULT_PORT
        );

        $this->queue = $config['queue'] ?: PheanstalkInterface::DEFAULT_TUBE;

        return $this;
    }

    public function getConnection()
    {
        return $this->pheanstalk;
    }

    public function push($job, $data)
    {
        return $this->getConnection()->useTube($this->queue)->put(
            $this->prepareData($job, $data)
        );
    }

    protected function prepareData($job, $data)
    {
        if (is_callable($job)) {
            $job = serialize(
                new SerializableClosure(
                    function () {
                        return true;
                    }
                )
            );
        }


        return json_encode([
            'job'  => $job,
            'data' => $data,
        ]);
    }

    public function getNextJob()
    {
        $this->pheanstalk->watch($this->queue);

        $job = $this->pheanstalk->reserve();

        return new BeanstalkdJob($this->pheanstalk, $job);
    }

    public function runJob()
    {
        // TODO: Implement runJob() method.
    }
}