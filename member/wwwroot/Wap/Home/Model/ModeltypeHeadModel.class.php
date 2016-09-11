<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ModeltypeHeadModel extends RelationModel{
	protected $ArrAdd = array();
	protected $ArrDelete = array();
	protected $ArrUpdate = array();
	
	//自动验证
	protected $_validate=array(
			array('wName','require','{%Model_n}'),
	);
	
	//一对多关联模型
	protected $_link = array(
			'modeltype'=>array(
					'mapping_type'=>self::HAS_MANY,//一对多
					'class_name'=>'modeltype',
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
	
	public function ReUpdateTypeInfo(){
		$list = $this->where(array("wUseID" => session('wUseID')))->order(array('Pid'=>'desc'))->field('wName, Pid')->select();
		foreach ($list as $k => $v){
			$list[$k]['Pid'] = encode($v['Pid'], C('GRYPTKEY'));
		}
		S('List_Type_Cache_'.session('pid'), $list);
		if(!S('List_Type_Cache_'.session('pid'))){
			return $list;
		}
		return S('List_Type_Cache_'.session('pid'));
	}
	
	public function UpdateUserAddInfo($arr){
		if(S('List_Type_Cache_'.session('pid'))){
			$this->ArrAdd = S('List_Type_Cache_'.session('pid'));
			array_unshift($this->ArrAdd, $arr);
			S('List_Type_Cache_'.session('pid'), $this->ArrAdd);
		}
	}
	
	public function UpdateTypeDeleteInfo($pid){
		if(S('List_Type_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Type_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrDelete = S('List_Type_Cache_'.session('pid'));
			unset($this->ArrDelete[$key]);
			S('List_Type_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	public function UpdateTypeInfo($arr ,$pid){
		if(S('List_Type_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Type_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrUpdate = S('List_Type_Cache_'.session('pid'));
			$this->ArrUpdate[$key]['wName'] = $arr['wName'];
			S('List_Type_Cache_'.session('pid'), $this->ArrUpdate);
		}
	}
}
