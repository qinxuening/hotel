<?php
namespace Home\Controller;
class TimeController extends CommonController{
	protected $timeaction_head;
	protected $mobilemanager;
	protected $timeaction;
	
	public function _initialize(){
		parent::_initialize();
		$this->timeaction_head = D("TimeactionHead");
		$this->mobilemanager = D('Mobilemanager');
		$this->timeaction = D('Timeaction');
	}
	
	public function index(){
		if(!S('List_Time_Cache_'.session('pid'))){
			$TypeTimeInfo = $this->timeaction_head->ReUpdateTimeInfo();
		}
		$this->assign("mytype",S('List_Time_Cache_'.session('pid')) ? S('List_Time_Cache_'.session('pid')) : $TypeTimeInfo);
		$this->assign('my6','btn0_a');
		$this->display();
	}

	public function del(){
		//$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");
		if($this->timeaction_head->CheckPid($Pid)){
			$result = $this->timeaction_head->relation(true)->where(array('Pid' => $Pid))->delete();
			if($result){
				$this->timeaction_head->UpdateTimeDeleteInfo(I("get.id"));
				$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Time/';
				header("Location:$url");
			}else{
				$this->error(L('S_del_e'),U('Time/index'));
			}
		}else{
			$this->error(L('S_parameter_e'));
		}
	}

	public function edit(){
		//$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");
		if($this->timeaction_head->CheckPid($Pid)){
			//$list = $this->mobilemanager->query("select * from `mobilemanager` where `wUseID` ='$wUseID' AND `wMB`='$wMB' AND left(`McID`,2) not in ('02','03','12','15')");
			if(!S('List_Mobile_Cache_'.session('pid'))){
				$Rlist = $this->mobilemanager->ReUpdateMobileInfo();
			}else{
				$Rlist = S('List_Mobile_Cache_'.session('pid'));
			}
			foreach ($Rlist as $k => $v){
				if(substr($v['McID'] , 0 ,2) != '12'){
					$list[] = $Rlist[$k];
				}
			}
			$find = $this->timeaction_head->where(array('Pid' => $Pid))->field("wUseID",true)->find();
			if($find){
				$findmodel = $this->timeaction->where(array('wModel' => $find['Pid']))->field('McID')->select();
				$m = TarrayToOarray($findmodel, 'McID');
				$this->assign("checklist",$m);
				$this->assign("myMobile" , $list);
				$find['Pid'] = I("get.id");
				$this->assign('type',$find);
				$this->assign('my6','btn0_a');
				$this->display();
			}else{
				$this->error(L('S_parameter_e'));
			}
		}else{
			$this->error(L('S_parameter_e'));
		}
	}

	public function update(){
		//$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");
		if($this->timeaction_head->CheckPid($Pid)){
			/*$HeadInfo = I('post.');
			$HeadInfo['wUseID'] = session('wUseID');
			if($this->timeaction_head->create($HeadInfo)){
				if($this->timeaction_head->where(array('Pid' => $Pid))->save()){
					$this->timeaction_head->UpdateTimeInfo(array('wName' => trim(I('post.wName'))), I("get.id"));
				}
			}*/
			$HeadInfo['wUseID'] = session('wUseID');
			$HeadInfo['wTime'] = I('post.wTime');
			$HeadInfo['wName'] = I('post.wName');
			$HeadInfo['wType'] = I('post.wType')?I('post.wType'):0;
			$HeadInfo['wMon'] = I('post.wMon')?I('post.wMon'):0;
			$HeadInfo['wTues'] = I('post.wTues')?I('post.wTues'):0;
			$HeadInfo['wWed'] = I('post.wWed')?I('post.wWed'):0;
			$HeadInfo['wThur'] = I('post.wThur')?I('post.wThur'):0;
			$HeadInfo['wFri'] = I('post.wFri')?I('post.wFri'):0;
			$HeadInfo['wSat'] = I('post.wSat')?I('post.wSat'):0;
			$HeadInfo['wSunday'] = I('post.wSunday')?I('post.wSunday'):0;
			if($this->timeaction_head->create()){
				$this->timeaction_head->where(array('Pid' => $Pid))->save($HeadInfo);
			}
			$this->timeaction->where(array('wModel' => $Pid))->delete();
			$wModeldata=I('post.wModel',null);
			for($i=0;$i<count($wModeldata);$i++){
				$data['wModel']=$Pid;
				$data['McID']=$wModeldata[$i];
				$data['wUseID']=session('wUseID');
				$this->timeaction->create();
				$this->timeaction->add($data);
			}
		}else{
			$this->error(L('S_parameter_e'));
		}
		$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Time/';
		header("Location:$url");
	}

	public function add(){
		if(!S('List_Mobile_Cache_'.session('pid'))){
			$Rlist = $this->mobilemanager->ReUpdateMobileInfo();
			}else{
				$Rlist = S('List_Mobile_Cache_'.session('pid'));
			}
			foreach ($Rlist as $k => $v){
				if(substr($v['McID'] , 0 ,2) != '12'){
					$list[] = $Rlist[$k];
			}
		}
		$this->assign("myMobile" , $list);
		$this->assign('my7','btn0_a');
		$this->display();
	}
	
	public function typeadd(){
		$HeadInfo = I('post.');
		$HeadInfo['wUseID'] = session('wUseID');
		if($this->timeaction_head->create($HeadInfo)){
			$id=$this->timeaction_head->add();
			$this->timeaction_head->UpdateTimeAddInfo(array('wName' => I('post.wName'), 'Pid'=>  $id));//encode($id , C('GRYPTKEY'))
			$wModeldata=I('post.wModel',null);
			for($i=0;$i<count($wModeldata);$i++){
				$data['wModel']=$id;
				$data['McID']=$wModeldata[$i];
				$data['wUseID']=session('wUseID');
				$this->timeaction->create();
				$this->timeaction->add($data);
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Time/';
			header("Location:$url");
		}else{
			$this->error($this->timeaction_head->getError());
		}
	}
}