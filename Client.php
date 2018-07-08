<?php

class Client
{
    public $clients;
    protected $model;

    function __construct()
    {
        include_once('class.php');
        $this->model = new Model();
        $this->clients = $this->getClients();
    }

    function getClients()
    {
        return $this->model->getFromMySQL();
    }

    function add($name, $surname, $phones)
    {

        if (empty($name)) {
            return 'error enter your name';
        }
        if (empty($surname)) {
            return 'error enter your surname';
        }
        if (!empty($phones) && !is_array($phones)) {
            return 'error: phone must be array';
        }
        $client = $this->model->add($name, $surname, $phones);
        var_dump($client);
        if ($client) {
            array_push($this->clients, $client);
        }
        return $client;
    }

}