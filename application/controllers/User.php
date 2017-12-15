<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('BaseController');

class User extends BaseController 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function creatuser()
	{
		if(!isset($_GET['username']) or !isset($_GET['password']) or !isset($_GET['privilege']))
		{
			return 0;
			exit();
		}
		$username = $_GET['username'];
		$password = $_GET['password'];
		$privilege = $_GET['privilege'];
		$result = $this->user_model->createUser($username, $password, $privilege);
		echo $result;
	}

	public function load()
	{
		if(!isset($_POST['username']) or !isset($_POST['password']))
		{
			$this->load->view('load');
		}
		else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = $this->user_model->userload($username, $password);
			if($user['code'] == 1)
			{
				$_SESSION['username'] = $user['info']->name;
				$_SESSION['id'] = $user['info']->id;
			}
			exit(json_encode($user));
		}
	}

	public function logout()
	{
		if($_SESSION['username'])
		{
			session_destroy();
			header('Location:/load');
		}
	}

}