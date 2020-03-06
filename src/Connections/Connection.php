<?php

namespace VirajKhatavkar\CakePHPQueue\Connections;

use Cake\Core\Configure;

class Connection
{
    protected $mapper = [
        'beanstalkd' => Beanstalkd::class,
    ];

    /**
     * @var string
     */
    protected $connection;

    public function __construct($connection = 'default')
    {
        $this->connection = $connection;

        if ($connection === 'default') {
            $this->connection = Configure::read('cakephp_queue.default');
        }
    }

    public function make(): ConnectionContract
    {
        return $this->mapConnector()->connect(Configure::read("cakephp_queue.$this->connection"));
    }

    protected function mapConnector(): ConnectionContract
    {
        if ($this->invalidConnector()) {
            throw new \Exception("Invalid connector");
        }

        return new $this->mapper[Configure::read("cakephp_queue.$this->connection.connector")];
    }

    public function invalidConnector() : bool
    {
        return !$this->validConnector();
    }

    public function validConnector() : bool
    {
        return array_key_exists(Configure::read("cakephp_queue.$this->connection.connector"), $this->mapper);
    }

}