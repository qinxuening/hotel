<?php
namespace Home\Model;
use Think\Model;
class UsermanagerModel extends Model{
	protected $ArrAdd = array();
	protected $ArrDelete = array();
	protected $ArrUpdate = array();
	
	protected $_validate = array(
			array('familyname','require','{%Member_name_n}'),
			array('familyid','require','{%Identification_id_n}'),
			array('wName','/^0?[1-99]{1,2}$/','{%Member_id_e}'),
	);
	
	public function CheckPid($Pid){
		$ListPid = $this->where(array('wUseID' => session('wUseID')))->field('pid')->select();
		$ListPidO = TarrayToOarray($ListPid, 'pid');
		if(in_array($Pid, $ListPidO)){
			return true;
		}else{
			return false;
		}
	}

	public function ReUpdateUserInfo(){
		$list = $this->where(array('wUseID' => session('wUseID')))->field("wUseID",true)->order('pid desc')->select();
		foreach ($list as $k => $v){
			$list[$k]['pid'] = encode($v['pid'], C('GRYPTKEY'));
		}
		S('List_User_Cache_'.session('pid'), $list);
		if(!S('List_User_Cache_'.session('pid'))){
			return $list;
		}
		return S('List_User_Cache_'.session('pid'));
	}
	
	public function UpdateUserDeleteInfo($pid){
		if(S('List_User_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_User_Cache_'.session('pid')), 'pid', $pid);
			$this->ArrDelete = S('List_User_Cache_'.session('pid'));
			unset($this->ArrDelete[$key]);
			S('List_User_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	
	public function UpdateUserAddInfo($arr){
		if(S('List_User_Cache_'.session('pid'))){
			$this->ArrAdd = S('List_User_Cache_'.session('pid'));
			array_unshift($this->ArrAdd, $arr);
			S('List_User_Cache_'.session('pid'), $this->ArrAdd);
		}
	}
	
	public function UpdateUserInfo($arr ,$pid){
		if(S('List_User_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_User_Cache_'.session('pid')), 'pid', $pid);
			$this->ArrUpdate = S('List_User_Cache_'.session('pid'));
			$this->ArrUpdate[$key]['familyid'] = $arr['familyid'];
			$this->ArrUpdate[$key]['familyname'] = $arr['familyname'];
			S('List_User_Cache_'.session('pid'), $this->ArrUpdate);
		}	
	}
	
	
	
}