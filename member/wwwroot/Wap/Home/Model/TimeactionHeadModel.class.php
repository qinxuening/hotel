<?php
namespace Home\Model;
use Think\Model\RelationModel;
class TimeactionHeadModel extends RelationModel{
	protected $ArrAdd = array();
	protected $ArrDelete = array();
	protected $ArrUpdate = array();
	
	//自动验证
	protected $_validate=array(
			array('wName','require','时间名称不能为空!'),
			array('wTime', 'require','时间不能为空！'),
	);
	
	//关联模型
	protected $_link = array(
			'timeaction'=>array(
					'mapping_type'=>self::HAS_MANY,//一对一
					'class_name'=>'timeaction',
					'foreign_key'=>'wModel',
			),
	);
	
	public function CheckPid($Pid){
		$ListPid = $this->where(array('wUseID' => session('wUseID')))->field('Pid')->select();
		$ListPidO = TarrayToOarray($ListPid, 'Pid');
		if(in_array($Pid, $ListPidO)){
			return true;
		}else{
			return false;
		}
	}
	
	public function ReUpdateTimeInfo(){
		$list = $this->where(array('wUseID' => session('wUseID')))->field('wName, Pid')->order(array('Pid'=>'desc'))->select();
		foreach ($list as $k => $v){
			$list[$k]['Pid'] = encode($v['Pid'], C('GRYPTKEY'));
		}
		S('List_Time_Cache_'.session('pid'), $list);
		if(!S('List_Time_Cache_'.session('pid'))){
			return $list;
		}
		return S('List_Time_Cache_'.session('pid'));
	}	
	
	public function UpdateTimeAddInfo($arr){
		if(S('List_Time_Cache_'.session('pid'))){
			$this->ArrAdd = S('List_Time_Cache_'.session('pid'));
			array_unshift($this->ArrAdd, $arr);
			S('List_Time_Cache_'.session('pid'), $this->ArrAdd);
		}
	}	
	public function UpdateTimeDeleteInfo($pid){
		if(S('List_Time_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Time_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrDelete = S('List_Time_Cache_'.session('pid'));
			unset($this->ArrDelete[$key]);
			S('List_Time_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	
	public function UpdateTimeInfo($arr ,$pid){
		if(S('List_Time_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Time_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrUpdate = S('List_Time_Cache_'.session('pid'));
			$this->ArrUpdate[$key]['wName'] = $arr['wName'];
			S('List_Time_Cache_'.session('pid'), $this->ArrUpdate);
		}
	}
}