<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('data_model');
		$this->load->helper(array('form', 'url'));

	}
	
	public function index()
	{
		$this->load->view('baseview/header');
		$this->load->view('data/index');
		$this->load->view('baseview/footer');
	}

	/**
	* upload file
	*/
	public function upload()
	{

		$this->load->view('baseview/header');
		$this->load->view('data/upload_index');
		$this->load->view('baseview/footer');
	}

	// upload data of output
	public function upload_output()
	{
		// var_dump(expression)dump($_FILES['file']);
		if(isset($_FILES))
		{
			$file_name = $_FILES['userfile']['tmp_name'];
			$file = fopen($file_name, 'r+');
			$row = fgets($file);
			$row = explode('\t', string)
			var_dump($row);
		}

		$this->load->view('baseview/header');
		$this->load->view('data/upload_output');
		$this->load->view('baseview/footer');
	}

	// upload data of halttime
	public function upload_halttime()
	{
		$this->load->view('baseview/header');
		$this->load->view('data/upload_halttime');
		$this->load->view('baseview/footer');
	}

	// edit file
	public function edit_index()
	{

		$this->load->view('baseview/header');
		$this->load->view('data/edit_index');
		$this->load->view('baseview/footer');
	}

	// 
	public function edit_output()
	{
		$partment = 1;
		if (isset($_GET['partment']))
		{
			$partment = $_GET['partment'];
		}
		$year = 2017;
		$month = 9;
		$result = $this->data_model->getoutput($partment);
		$data['result'] = $result;
		$data['partment'] = $partment;
		$data['year'] = $year;
		$data['month'] = $month;
		$this->load->view('baseview/header');
		$this->load->view('data/edit_output', $data);
		$this->load->view('baseview/footer');
	}

	public function deloutput()
	{
		$month = $_GET['month'];
		$year = $_GET['year'];
		$partment = $_GET['partment'];
	}

	// 
	public function edit_halttime()
	{
		$partment = $_GET['partment'];
		$year = '2017';
		$month = '09';
		$r = $this->data_model->gethalttimelist($partment, '2017', '09');	
		$data['result'] = $r;
		$data['partment'] = $partment;
		$data['year'] = $year;
		$data['month'] = $month;
		$this->load->view('baseview/header');
		$this->load->view('data/edit_halt', $data);
		$this->load->view('baseview/footer');
	}

	// out put the scores
	public function output()
	{
		$this->load->view('baseview/header');
		$this->load->view('data/output');
		$this->load->view('baseview/footer');
	}


	// clean datas
	public function clean()
	{
		$r = 0;
		if (isset($_GET['doit']) && $_GET['doit'] == 1) {
			$r = $this->data_model->cleandata();
		}
		
		$data['r'] = $r;


		$this->load->view('baseview/header');
		$this->load->view('data/clean', $data);
		$this->load->view('baseview/footer');
	}

	// the comment figure
	public function comment()
	{
		$this->load->view('baseview/header');
		$this->load->view('data/comment');
		$this->load->view('baseview/footer');
	}

	public function test()
	{
		
		// $r = $this->data_model->scores();
		// $this->data_model->standlize();	# 所有产量的得分
		// $this->data_model->classmerscore();
		// $this->data_model->merscore();
		var_dump($_FILES);
		
	}

	// 每日班组机型的得分
	public function classmerscore()
	{
		header("Content-type:application/vnd.ms-excel");    
    	header("Content-Disposition:filename=每日班组机型的得分.xls");  
		$list = $this->data_model->classmerscore();

		$strexport="日期\t班组\t机型\t得分\r";
		foreach ($list as $row) 
		{
		 	# code...
		 	$strexport.=$row[0]."\t";     
	        $strexport.=$row[1]."\t";    
	        $strexport.=$row[2]."\t";    
	        $strexport.=$row[3]."\r";   
		}
		$strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport);    
    	exit($strexport);   
	}

	// 每日机型的得分
	public function merscore()
	{
		$list = $this->data_model->merscore();
		header("Content-type:application/vnd.ms-excel");    
    	header("Content-Disposition:filename=每日机型的得分.xls");  

		$strexport="日期\t机型\t得分\r";
		foreach ($list as $row) 
		{
		 	# code...
		 	$strexport.=$row[0]."\t";     
	        $strexport.=$row[1]."\t";    
	        $strexport.=$row[2]."\r";       
		}
		$strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport);    
    	exit($strexport);  
	}
}
