<?php
namespace ItTutorial\ctocamp\src\mq;
use ItTutorial\ctocamp\src\mq\PHPMQ;


class UserMQ extends PHPMQ
{
    use SingletonTrait;

    protected function getKey()
    {
            return 'list:user:reg';
    }
    protected function package($data)
    {
            return json_encode($data);
    }
    protected function unpackage($msg)
    {
            return json_decode($msg,TRUE);
    }
}