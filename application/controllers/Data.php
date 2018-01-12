<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('BaseController');
require ('/workspace/qy_pp/ext/Classes/PHPExcel.php');
require ('/workspace/qy_pp/ext/Classes/PHPExcel/IOFactory.php');

class Data extends BaseController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('data_model');
		$this->load->helper(array('form', 'url'));
        $objphpexcel = new PHPExcel();
        $this->load->driver('cache');
        $this->load->library('RedisLi');
//        
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
		if(isset($_FILES['userfile']))
		{
			$file_name = $_FILES['userfile']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($file_name);
            $rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();
            $columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();
            $dataArr = array();
            for ($row = 1; $row <= $rowCount; $row++)
            {
                //列数循环 , 列数是以A列开始
                $datarow = array();
                for ($column = 'A'; $column <= $columnCount; $column++) 
                {
                    $datarow[] = $objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue();
                }
                $dataArr[] = $datarow;
            }
            for($i = 1; $i < count($dataArr); $i++)
            {
                if($dataArr[$i][5] == '制造一部')
                {
                    $partment = 1;
                }
                else if($dataArr[$i][5] == '制造二部')
                {
                    $partment = 2;
                }
                else
                {
                    $partment = 0;
                }
                $this->data_model->insert_class_output($dataArr[$i][0], $dataArr[$i][1], $dataArr[$i][2], $dataArr[$i][3], $dataArr[$i][4], $partment);
            }
        }
		$this->load->view('baseview/header');
		$this->load->view('data/upload_output');
		$this->load->view('baseview/footer');
	}

	// upload data of halttime
	public function upload_halttime()
	{
        if(isset($_FILES['haltfile']))
		{
			$file_name = $_FILES['haltfile']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($file_name);
            $sheetSelected = 0;
            $objPHPExcel->setActiveSheetIndex($sheetSelected);
            $rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();
            $columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();
            $dataArr = array();
            for ($row = 1; $row <= $rowCount; $row++)
            {
                //列数循环 , 列数是以A列开始
                $datarow = array();
                for ($column = 'A'; $column <= $columnCount; $column++) 
                {
                    $datarow[] = $objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue();
                }
                $dataArr[] = $datarow;
            }
            // var_dump($dataArr);
            for($i = 1; $i < count($dataArr); $i++)
            {
                $date = $dataArr[$i][0];
              
                $date = date('Y-m-d', ($date-25569)*24*60*60);
                $mid = $dataArr[$i][1];
                $partment =  $dataArr[$i][2];
                $class_sort =  $dataArr[$i][3];
                $class =  $dataArr[$i][4];
                $halttime =  $dataArr[$i][5];
                $this->data_model->insert_halttime($date, $partment, $class, $mid, $class_sort, $halttime);
            }
        }
        // exit();
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
		$year = 2017;
		$month = 9;
		if (isset($_GET['partment']))
		{
			$partment = $_GET['partment'];
		}
		if(isset($_GET['date'])){
			$date = $_GET['date'] ;
		}
		$year = explode('-', $date)[0];
		$month = explode('-', $date)[1];
		
		$result = $this->data_model->getoutput($partment, $year, $month);
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
		if (isset($_GET['partment']))
		{
			$partment = $_GET['partment'];
		}
		if(isset($_GET['date'])){
			$date = $_GET['date'] ;
		}

		$year = explode('-', $date)[0];
		$month = explode('-', $date)[1];

		$r = $this->data_model->gethalttimelist($partment, $year, $month);
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
		if (isset($_GET['doit']) && $_GET['doit'] == 1 && isset($_GET['year']) && isset($_GET['month']) && isset($_GET['partment'])) 
		{
			$partment = $_GET['partment'];
			$month = $_GET['month'];
			$year = $_GET['year'];
			$r = $this->data_model->cleandata($partment, $year, $month);
		}
		
		$data['r'] = $r;

		// $this->data_model->standlize();		// 清洗后将分数保存到数据库中
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
		$r = $this->data_model->partscr('2017','9');
		var_dump($r);
	}

	// 每日班组机型的得分
	public function classmerscore()
	{
		$partment = $_GET['partment'];
		$year = $_GET['year'];
		$month = $_GET['month'];
		header("Content-type:application/vnd.ms-excel");    
    	header("Content-Disposition:filename=每日班组机型的得分.xls");  
		$list = $this->data_model->classmerscore($partment, $year, $month);

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
		$partment = $_GET['partment'];
		$year = $_GET['year'];
		$month = $_GET['month'];
		$list = $this->data_model->merscore($partment, $year, $month);
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

	public function graphslist()
	{
		$this->load->view('data/graphlist1');
	}

	public function graphresult()
	{
		$result = $this->data_model->classmerscore(1, 2017, 9);
		$mvers = $this->data_model->mvers(1);
		$classes = $this->data_model->classes(1);

		$merscore = $this->data_model->merscore(1, 2017, 9);

		$verline = array();
		foreach ($mvers as $val) 
		{	
			$mver = $val->mver;
			$classline = array();
			foreach($classes as $cla)
			{
				$line = array();
				$class = $cla->class;
				foreach ($result as $item)
				{
					if($item[2] == $mver and $item[1] == $class)
					{
						array_push($line, array($item[0], $item[3]));
					}
				}
				$classline[$class] = $line;
			}
			$verline[$mver]	= $classline;
		}

		$nmerscore = array();
		foreach ($mvers as $val) 
		{
			$mver = $val->mver;
			$line = array();
			foreach ($merscore as $item) 
			{
				if($item[1] == $mver)
				{
					array_push($line, array($item[0], $item[2]));
				}
			}
			$nmerscore[$mver] = $line;

		}

		$data['mvers'] = $mvers;
		$data['classes'] = $classes;
		$data['result'] = $verline;
		$data['merscore'] = $nmerscore;
		var_dump($data);exit;
		exit(json_encode($data));
	}

	public function newclamerscr($partment='1', $year='2017', $month='9')
	{
		$clamerscore = $this->data_model->nclassmersc($partment, $year, $month);	// part_mer_class_date

		$newclamerscr = array();
		foreach($clamerscore as $key => $item)
		{
			$itemlist = explode('_', $key);

			if(isset($newclamerscr[$itemlist[1]]))
			{
				$merline = $newclamerscr[$itemlist[1]];
				// if(isset($newclamerscr[$itemlist[1]][$itemlist[2]]))
				if(isset($merline[$itemlist[2]]))
				{
					$classline = $merline[$itemlist[2]];
					array_push($classline, array($itemlist[3], $item));
					$merline[$itemlist[2]] = $classline;
				}
				else
				{
					$tempclaline = array();
					array_push($tempclaline, array($itemlist[3], $item));
					$merline[$itemlist[2]] = $tempclaline;
				}
				$newclamerscr[$itemlist[1]] = $merline;
			}
			else
			{	
				$tmp = array();
				array_push($tmp, array($itemlist[3], $item));
				$tempclaline = array($itemlist[2]=>$tmp);
				$newclamerscr[$itemlist[1]] = $tempclaline;
			}
		}

		return $newclamerscr;
	}

	 /*
	 * part result of merchine
	 */
	public function newmerscr($partment, $year, $month)
	{
		$merscore = $this->data_model->nmerscr($partment, $year, $month);			// part_mer_date

		$newmerscr = array();

		foreach($merscore as $key => $item)
		{
			$itemlist = explode('_', $key);			// 0:part 1:mer 2:date

			if(isset($newmerscr[$itemlist[1]]))
			{
				$merline = $newmerscr[$itemlist[1]];
				array_push($merline, array($itemlist[2], $item));
				$newmerscr[$itemlist[1]]= $merline;
			}
			else
			{
				$tmp = array();
				array_push($tmp, array($itemlist[2], $item));
				$newmerscr[$itemlist[1]] = $tmp;
			}
		}
		return $newmerscr;
	}

	public function partscr($year, $month)
	{
		$partscr = $this->data_model->partscr($year, $month);
		$newpartscr = array();

		foreach($partscr as $key=>$val)
		{
			$itemlist = explode('_', $key);

			if(isset($newpartscr[$itemlist[0]]))
			{
				$oldline = $newpartscr[$itemlist[0]];
				array_push($oldline, array($itemlist[1], $val));
				$newpartscr[$itemlist[0]] = $oldline;
			}
			else
			{
				$tmp = array();
				array_push($tmp, array($itemlist[1], $val));
				$newpartscr[$itemlist[0]] = $tmp;
			}
		}

		return $newpartscr;
	}

	/*
	*
	*
	*/
	public function chartmain()
	{
		
		if(isset($_GET['timestamp']))
		{
			$timestamp = $_GET['timestamp'];
			$timestamp = strtotime($timestamp);
			$date = date('Y-m', $timestamp);
			$date = explode('-', $date);
			$year = $date[0];
			$month = $date[1];
		}
		else
		{
			$date = $this->data_model->newestdate();
			$date = explode('-', $date);
			$year = $date[0];
			$month = $date[1];
		}

		$part1 = $this->newmerscr(1, $year, $month);
		$part2 = $this->newmerscr(2, $year, $month);

		$data['evepart'] = array($part1, $part2);
		$data['partscr'] = $this->partscr($year, $month);

		// $data['mainchart'] = 
		exit(json_encode($data));

	}

	public function edit_merid()
	{
		$part = 1;
		$moid = '1#';
		if(isset($_GET['part']))
		{
			$part = $_GET['part'];
		}
		if(isset($_GET['moid']))
		{
			$moid = $_GET['moid'];
		}
		$mver = $_GET['mver'];

		$this->data_model->edit_merid($part, $moid, $mver);
	}


}
