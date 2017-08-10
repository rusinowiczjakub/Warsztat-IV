<?php

class Message
{
    const table = "Messages";

    public $id;
    public $adminId;
    public $clientId;
    public $opened;
    public $message;


    public function getId()
    {
        return $this->id;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getOpened()
    {
        return $this->opened;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setOpened($opened)
    {
        $this->opened = $opened;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }





}
