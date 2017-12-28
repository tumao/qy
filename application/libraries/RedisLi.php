<?php 
class RedisLi extends Redis
{

	public function __construct()
	{
		parent::__construct();
		$this->conn();
	}

	private function conn()		// connect redis and config
	{
		$this->connect('127.0.0.1', 6379);
		$this->select(10);
	}


}

?>