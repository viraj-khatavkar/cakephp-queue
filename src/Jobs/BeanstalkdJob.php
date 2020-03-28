<?php

namespace VirajKhatavkar\CakePHPQueue\Jobs;


use Pheanstalk\Job as PheanstalkJob;

class BeanstalkdJob extends Job implements JobContract
{

    /** @var \Pheanstalk\Pheanstalk */
    public $connection;

    /**
     * @var \Pheanstalk\Job|\VirajKhatavkar\CakePHPQueue\Jobs\Job
     */
    public $job;

    /**
     * BeanstalkdJob constructor.
     * @param $connection
     * @param PheanstalkJob $job
     */
    public function __construct($connection, PheanstalkJob $job)
    {
        $this->connection = $connection;
        $this->job = $job;
        $this->setData($job);
    }

    public function delete()
    {
        $this->connection->delete($this->job);
    }

    public function release()
    {
        $this->connection->release($this->job);
    }

    protected function setData(PheanstalkJob $job)
    {
        $data = json_decode($job->getData(), true);

        $this->data = [
            'executable' => $data['job'],
            'payload'    => $data['data'],
            'action'     => $data['action'] ?? 'handle',
        ];
    }
}