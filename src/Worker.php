<?php

namespace VirajKhatavkar\CakePHPQueue;

use Cake\Cache\Cache;
use Cake\Datasource\ConnectionManager;
use VirajKhatavkar\CakePHPQueue\Queues\Connection;

class Worker
{
    public function work($queueConnection, $databaseConnection = 'default')
    {
        //TODO:register signals

        $lastRestart = $this->getTimestampOfLastQueueRestart();

        while (true) {

            //TODO:set timeout handler

            $job = $this->buildConnection($queueConnection)->getNextJob();

            if ($job) {

                $this->reconnectDatabase($databaseConnection);
                $job->fire();
                $job->delete();

            }

            if ($this->queueShouldRestart($lastRestart)) {
                $this->stopWorker();
            }
        }
    }

    /**
     * @param $connection
     * @return \VirajKhatavkar\CakePHPQueue\Queues\QueueContract
     */
    protected function buildConnection($connection)
    {
        return (new Connection($connection))->make();
    }

    /**
     * Get the last queue restart timestamp, or null.
     * @return int|null
     */
    protected function getTimestampOfLastQueueRestart()
    {
        return Cache::read('cakephp_queue_restart');
    }

    /**
     * Determine if the queue worker should restart.
     * @param int|null $lastRestart
     * @return bool
     */
    protected function queueShouldRestart($lastRestart)
    {
        return $this->getTimestampOfLastQueueRestart() != $lastRestart;
    }

    protected function reconnectDatabase($connection)
    {
        /** @var \Cake\Database\Connection $connection */
        $connection = ConnectionManager::get($connection);
        $connection->disconnect();
        $connection->connect();
    }

    public function stopWorker()
    {
        exit(12);
    }
}