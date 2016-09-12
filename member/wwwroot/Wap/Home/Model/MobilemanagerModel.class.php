<?php
namespace Home\Model;
use Think\Model;
class MobilemanagerModel extends Model{
	protected $arr = array();
	protected $ArrDelete = array();
	protected $ArrUpdate = array();
	
	
	protected $_validate = array(
			array('wMB','require','{%Cmobile_n}'),
			array('wMB','/^[1-9]\d{4,15}$/','{%S_mobile_g}'),
			array('wName','require','{%Cname_n}'),
	);
	
	public function CheckPid($Pid){
		if(S('List_Mobile_Cache_'.session('pid'))){
			$ListPidO = TarrayToOarray(S('List_Mobile_Cache_'.session('pid')), 'Pid');
		}else{
			$ListPid = $this->where(array('wUseID' => session('wUseID')))->field('Pid')->select();
			$ListPidO = TarrayToOarray($ListPid, 'Pid');
		}	
		if(in_array($Pid, $ListPidO)){
			return true;
		}else{
			return false;
		}
	}
	
	public function ReUpdateMobileInfo(){
		$list = $this->where(array('wUseID' => session('wUseID')))->field('Pid, McID, McName')->order(array('Pid'=>'desc'))->select();
		/*foreach ($list as $k => $v){
			$list[$k]['Pid'] = encode($v['Pid'], C('GRYPTKEY'));
		}*/
		S('List_Mobile_Cache_'.session('pid'), $list);
		if(!S('List_Mobile_Cache_'.session('pid'))){
			return $list;
		}
		return S('List_Mobile_Cache_'.session('pid'));
	}

	public function UpdateMobileDeleteInfo($pid){
		if(S('List_Mobile_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Mobile_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrDelete = S('List_Mobile_Cache_'.session('pid'));
			unset($this->ArrDelete[$key]);
			S('List_Mobile_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	
	public function UpdateMobileInfo($arr ,$pid){
		if(S('List_Mobile_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_Mobile_Cache_'.session('pid')), 'Pid', $pid);
			$this->ArrUpdate = S('List_Mobile_Cache_'.session('pid'));
			$this->ArrUpdate[$key]['McName'] = $arr['McName'];
			S('List_Mobile_Cache_'.session('pid'), $this->ArrUpdate);
		}
	}
	
	public function SelectIfi($username , $McID){
		$sql = "select a.wUserID,a.MCID,a.KeyID,b.KeyName,a.KeyVar
			from irinfo a left join ircodeinfo b on a.KeyID=right(b.KeyID,7)
			where a.wUserID='$username'
			and a.MCID='$McID'
			and BrandNO='RN51F/BG'
			and left(b.KeyName,2)='模式' ORDER BY KeyID;";
		$list = M()->query($sql);
		S('List_Ifi_Cache_'.session('pid').'_'.$McID, $list);
		if(!S('List_Ifi_Cache_'.session('pid').'_'.$McID)){
			return $list;
		}
		return S('List_Ifi_Cache_'.session('pid').'_'.$McID);
	}

	public function UserMoblieList($wUseID){
		$Model = M();
		$UserMobile = $Model->query("
			select a.`Pid`, b.`wName` , a.`McName` , `McNumID` , a.`wUseID` ".#13
			"from `mobilemanager` a
			left join `users` b
			on a.`wUseID` = b.`wUseID`".#13
			"where  (a.`McNumID` in ( select `McNumID` from `mobilemanager` where `wUseID` = '$wUseID')
			and a.`wUseID` <>'$wUseID')
			order by  a.`wUseID` ,a.`Item`");
		foreach ($UserMobile as $k => $v){
			if(empty($v['wName'])) { $UserMobile[$k]['wName']= 'null';}
		}
		S('List_User_Mobile_Cache_'.session('pid'), $UserMobile);
		if(!S('List_User_Mobile_Cache_'.session('pid'))){
			return $UserMobile;
		}
		return S('List_User_Mobile_Cache_'.session('pid'));	
	}
	
	public function DeletUserMoblieList($Pid){
		if(S('List_User_Mobile_Cache_'.session('pid'))){
			$key = FindArrKey(S('List_User_Mobile_Cache_'.session('pid')), 'Pid', $Pid);
			$this->ArrDelete = S('List_User_Mobile_Cache_'.session('pid'));
			unset($this->ArrDelete[$key]);
			S('List_User_Mobile_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	
	public function DeletAllUserMoblieList($wUseID){
		if(S('List_User_Mobile_Cache_'.session('pid'))){
			$this->ArrDelete = S('List_User_Mobile_Cache_'.session('pid'));
			foreach($this->ArrDelete as $k => $v){
				if($wUseID == $v['wUseID']){
					unset($this->ArrDelete[$k]);
				}
			}
			S('List_User_Mobile_Cache_'.session('pid'), $this->ArrDelete);
		}
	}
	
	
	
	
	
	
	
	
}