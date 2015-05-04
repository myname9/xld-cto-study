<?php
namespace ItTutorial\ctocamp\src\mq;
use ItTutorial\ctocamp\src\mq\RedisPool;


trait SingletonTrait
{
	private static $instance=null;
	public static function MQ()
	{
		if(self::$instance == null){
			self::$instance = new self;
			self::$instance->init();
		}
		return self::$instance;
	}
}

abstract class PHPMQ
{
	abstract protected function getKey();
	abstract protected function package($data);
	abstract protected function unpackage($msg);
	protected $redis;
	
	public function init()
	{
		RedisPool::addServer(['F1'=>['127.0.0.1',6379]]);
		$this->redis = RedisPool::getRedis('F1');
	}
	
	public function push($msg)
	{
		$this->redis->rpush($this->getKey(),$this->package($msg));
	}
	
	public function pop()
	{
		return $this->unpackage($this->redis->lpop($this->getKey()));
        }
}