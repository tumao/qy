<?php 
class Data_model extends CI_Model
{
	public $midmap = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default', true);
	}

	// score
	public function scores()
	{
		// var_dump($this->db);
		// $query = $this->db->get('score', 10);
		$r = $this->db->query("SELECT * FROM `score` LIMIT 30 ORDER BY `id` DESC");
		// return $query->result();
		return $r->result();
	}

	// get out put 
	public function getoutput($partment)
	{
		$sql = "SELECT * FROM `class_output` WHERE `partment`=".$partment." ORDER BY `id` DESC LIMIT 20 ";
		$r = $this->db->query($sql);
		return $r->result();
	}

	public function gethalttimelist($partment, $year, $month)
	{
		$date = $year.'-'.$month;
		$sql = "SELECT * FROM `halted_time` WHERE date LIKE '%".$date."%' AND part = ".$partment." ORDER BY `id` DESC LIMIT 20";
		$r = $this->db->query($sql);
		return $r->result();
	}

	// 数据清洗
	public function cleandata()
	{
		$r = $this->getchangebrand();
		if (count($r) > 0)
		{
			foreach ($r as $value) 
			{
				$sql = "SELECT `id` FROM `class_output` WHERE `date`='{$value->date}' AND `class`='{$value->class}' AND `mid`='{$value->mid}'";
				$tmp = $this->db->query($sql);
				$result = $tmp->result();
				$id = $result[0]->id;
				$this->setdatavalid($id, 1);		# 设置当前数据可用
			}
		}

		$sql = "SELECT * FROM `class_output` WHERE `valid` =1";
		$query = $this->db->query($sql);
		$result = $query->result();
		foreach ($result as $value) 
		{
			// var_dump($value);
			// exit();
			$oid = $value->id;
			$odate = $value->date;
			$oclass = $value->class;
			$omid = $value->mid;
			$mver = $this->getver($omid);
			$htinfo = $this->gethalttime($odate, $oclass, $omid);
			if($htinfo !== -1 AND count($htinfo)>0)
			{
				$class_sort = $htinfo->class_sort;
				$httime = $htinfo->halttime;
				$output = $value->output_count;
				$worktime = $this->worktime($class_sort);
				$worktime = $worktime - $httime/60;		// 总的工作时间-停机时常
				$eveop = $output/$worktime;
				if (stripos($mver, 'ZJ17') !== false)
				{
					if ($eveop < 0.5 or $eveop > 0.7)
					{
						$this->setdatavalid($oid, 0);	
					}
				}
				elseif (stripos($mver, 'PROTOSM5') !== false)
				{
					if ($eveop < 0.7 or $eveop > 1.5)
					{
						$this->setdatavalid($oid, 0);	
					}
				}
			}
			else
			{
				$this->setdatavalid($oid, 0);
			}
		}
		return 1;
	}
	// 获取工作时常
	private function worktime($class_sort)
	{
		$work_time = 0;
        if ($class_sort == '早班')
        {
            $work_time = 6 * 60;
        }
        else if ($class_sort == '午班')
        {
            $work_time = 6 * 60;
        }
        else if ($class_sort == '晚班')
        {
            $work_time = 6 * 60 - 20;
        }
        else if ($class_sort == '夜班')
        {
            $work_time = 6 * 60 + 20;
        }

        return $work_time;
	}
        

	// 获取停机时常
	public function gethalttime($date, $class, $mid)
	{
		$sql = "SELECT `class_sort`, `halttime` FROM `halted_time` WHERE `date`='{$date}' AND `class`='{$class}' AND `mid`='{$mid}'";
		$query = $this->db->query($sql);
		$r = $query->result();
		if (count($r)>0)
		{
			$halttime = $r[0]->halttime;
			if ($halttime < 6*60*60)
			{
				return $r[0];
			}
			else
			{
				return -1;
			}
		}
		else
		{
			return -1;
		}
		
	}

	// 通过机组号获取机型
	private function getver($omid)
	{
		$sql = "SELECT `mver` FROM `balance_k` WHERE `mid`='{$omid}'";
		$q = $this->db->query($sql);
		$r = $q->result();
		return $r[0]->mver;
	}

// 设置当前数据是否可用
	private function setdatavalid($id, $stat=0)
	{
		$sql = "UPDATE `class_output` SET `valid`={$stat} WHERE `id`={$id}";
		// echo $sql;
		$this->db->query($sql);
	}

	public function getchangebrand()
	{
		$sql = "SELECT `date`,`class`,`mid` FROM `class_output` WHERE mid NOT LIKE 'T%' AND `mid` != '15#' GROUP BY `date`, `class`, `mid` HAVING COUNT(output_count) = 1 AND SUM(output_count) > 0 ORDER BY `date` ASC";

		$r = $this->db->query($sql);
		return $r->result();
	}

	// 获取清洗后的数据
	public function getcleaneddata()
	{
		$sql = "SELECT * FROM `class_output` WHERE `valid`=1 ORDER BY `date` ASC";
		$q = $this->db->query($sql);
		$r = $q->result();
		return $r;
	}

	// 标准产量
	public function standlize()
	{
		$r = $this->getcleaneddata();
		$odata = array();
		foreach ($r as $value)
		{

			$odate = $value->date;
			$oclass= $value->class;
			$omid = $value->mid;
			$obrand = $value->brand;
			$oop = $value->output_count/5;
			$ver = $this->getver($omid);
			$htinfo = $this->gethalttime($odate, $oclass, $omid);
			$class_sort = $htinfo->class_sort;
			$httime = $htinfo->halttime;
			$worktime = $this->worktime($class_sort);

			$k = $this->getbk($omid, $obrand);		// 未定义的函数
			if ($k > 0)		// 对有均衡值比的进行计算
			{
				$standop = $oop * $k * (360 /($worktime-$httime/60));
				$line = array($odate, $oclass, $omid, $standop, $ver);
				array_push($odata, $line);
				// $this->savesort($ver, $line);
			}
		}
		$balanceop = $this->midnum($odata);

		$exdata = array();

		foreach ($odata as $value) 
		{
			// var_dump($value);
			$date = $value[0];
			$class = $value[1];
			$mid = $value[2];
			$bz = $value[3];		// 标准产量
			$mver = $value[4];
			$bv = $balanceop[$mver];

			$minstdop = $this->getminstdop($odata, $mver);
			$maxstdop = $this->getmaxstdop($odata, $mver);
			if ($bz < $bv)
			{
				$minval = $minstdop;
				$result = 60 + (($bz-$minval)/($bv-$minval))*40;
			}
			else if($bz > $bv)
			{
				$maxval = $maxstdop;
				$result = 100 - (($bz-$bv)/($maxval-$bv))*40;
			}
			// $line = array($date, $mid, $class, $bz, $mver, $result);
			// var_dump($line);
			// array_push($exdata, $line);
			$this->savescore($date, $mid, $class, $standop, $mver, $result);
		}

		return $exdata;
	}


	public function savescore($date, $mid, $class, $standop, $mver, $score)
	{
		$sql = "INSERT INTO `score` (`date`, `mid`, `class`, `standop`, `mver`, `score`) VALUES ('{$date}', '{$mid}', '{$class}', {$standop}, '{$mver}', {$score})";
		$this->db->query($sql);
	}

	public function getminstdop($odata, $mver)
	{

		$min = 100000;
		

		foreach ($odata as $value) 
		{
			if($value[4] == $mver)
			{
				if($value[3] < $min)
				{
					$min = $value[3];
				}
			}
		}

		return $min;
	}

	public function getmaxstdop($odata, $mver)
	{
		// $list = $midmap[$mver];
		$max = 0;
		// foreach ($list as $x) 
		// {
		// 	# code...
		// 	if($x[3] > $max)
		// 	{
		// 		$max = $x[3];
		// 	}
		// }
		// return $max;
		foreach ($odata as $value) 
		{
			if($value[4] == $mver)
			{
				if($value[3] > $max)
				{
					$max = $value[3];
				}
			}
		}

		return $max;

	}

	public function midnum($odata)
	{
		$map = array();
		foreach ($odata as $val) 
		{
			if(array_key_exists($val[4], $map))
			{
				$tmp = $map[$val[4]];
				array_push($tmp, $val[3]);
				$map[$val[4]] = $tmp;
			}
			else
			{
				$tmp = array($val[3]);
				$map[$val[4]] = $tmp;
			}
		}

		// var_dump($map);$line = array($odate, $oclass, $omid, $standop, $ver);
		$midnum = array();
		foreach ($map as $key => $value)
		{
			asort($value);
			$midnum[$key] = $value[ceil(count($value)/2)];
		}

		// var_dump($midnum);
		// echo '111';
		return $midnum;
	}
	// key:array(array, array)
	public function savesort($ver, $data)
	{
		$tmp = array();

		if (array_key_exists($ver, $this->midmap))
		{
			$tmp = $this->xsort($this->midmap[$ver], $data, 3);
		}
		else
		{
			array_push($tmp, $data);
		}
		$this->midmap[$ver] = $tmp;
		return $this->midmap;
	}

	// 对机型下的产量进行排序
	public function xsort($list, $value, $index)
	{
		
		for($i = 0; $i < count($list); $i++)
		{
			if ($list[$i][$index] > $value[$index]) 
			{
				# code...
				$tmp = array();
				for ($x = $i; $x < count($list); $x++)
				{
					$tmp = $list[$x];
					$list[$x] = $value;
					$value = $tmp;
				}
				array_push($list, $value);
				// break;
			}
		}

		return $list;
	}

	// 获取均衡系数
	private function getbk($mid, $brand)
	{
		$sql = "SELECT `b_k` FROM `balance_k` WHERE `mid` = '{$mid}' AND `brand` = '{$brand}'";
		$query = $this->db->query($sql);
		$result = $query->result();
		if (count($result) > 0)
		{
			return $result[0]->b_k;	
		}
		else
		{
			return -1;
		}
		
	}

	// 获取每天，工班，机型的得分
	public function classmerscore()
	{
		$sql =  "SELECT date, class, mver, SUM(standop) as ssop,SUM(score) as sscor,COUNT(mver) as cmver FROM score GROUP BY date, class, mver ORDER BY date, class";
		$query = $this->db->query($sql);
		$r = $query->result();
		// var_dump($r);
		$result = array();
		foreach ($r as $value) 
		{
			# code...
			$scoreinfo = $this->getscores($value->date, $value->class, $value->mver);
			$score = 0;
			foreach ($scoreinfo as $x) 
			{
				# code...
				$score += ($x->standop/$value->ssop)*$x->score;
			}
			$line = array($value->date, $value->class,$value->mver, $score);
			array_push($result, $line);
		}

		return $result;
	}

	// 获取机型的得分
	public function merscore()
	{
		$sql =  "SELECT date, mver, SUM(standop) as ssop,SUM(score) as sscor,COUNT(mver) as cmver FROM score GROUP BY date, mver ORDER BY date, class";
		$query = $this->db->query($sql);
		$r = $query->result();
		$result = array();

		foreach ($r as $value) {
			$scoreinfo = $this->getmerscore($value->date, $value->mver);
			$score = 0;

			foreach ($scoreinfo as $x)
			{
				# code...
				$score += ($x->standop/$value->ssop)*$x->score;
			}
			$line = array($value->date, $value->mver, $score);
			array_push($result, $line);
		}
		return $result;
	}

	// 每日工班，机型得分
	public function getscores($date,$class,$mver)
	{
        $sql = "SELECT standop, score FROM score WHERE date = '{$date}' AND class='{$class}' AND mver='{$mver}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
	}

	//  获取机型得分
	public function getmerscore($date, $mver)
	{
		$sql = "SELECT standop, score FROM score WHERE date = '{$date}' AND mver='{$mver}'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

}
