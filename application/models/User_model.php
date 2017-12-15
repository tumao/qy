<?php 

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default', true);
	}

	public function createUser($name, $password, $ugroup)
	{
		if ($this->hasUser($name) == 1)
		{
			return json_encode(array('code'=>0, 'msg'=>'this user already exist'));		// already exist this user
			exit();
		}
			 // INSERT INTO `user`(`id`, `name`, `password`, `ugroup`) VALUES
		$password = $this->encode_passwd($password);
		$sql = "INSERT INTO `user` (`name`, `password`, `ugroup`) VALUES('{$name}', '{$password}', '{$ugroup}')";
		$q = $this->db->query($sql);

		return json_encode(array('code'=>1, 'msg'=>'success'));
	}


	private function hasUser($name)
	{
		$sql = "SELECT `id` FROM `user` WHERE `name`='{$name}'";
		$q = $this->db->query($sql);
		$result = $q->result();
		if (count($result) > 0)
		{
			return 1;
		}
		else if (count($result) == 0)		// no this user
		{
			return 0;
		}

	}

	private function encode_passwd($passwd)
	{
		 $basestr = 'cigurate_';
		 $passwd = $basestr.$passwd;
		 return md5($passwd);
	}

	public function userload($username, $passwd)
	{
		$passwd = $this->encode_passwd($passwd);
		$sql = "SELECT `name`, `id` FROM `user` WHERE `name`='{$username}' AND `password`='{$passwd}' LIMIT 1";
		$q = $this->db->query($sql);
		$result = $q->result();

		if(count($result) == 1)
		{
			return array('code' => 1, 'msg' => 'success', 'info' => $result[0]);

		}
		else
		{
			return array('code' => 0, 'msg' => 'user name or password error');
		}
	}

	public function test()
	{
		echo '111';
	}

}