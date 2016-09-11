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
		$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
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
		$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		if($this->timeaction_head->CheckPid($Pid)){
			//$wMB=session('wMB');
			//$wUseID=session('wUseID');
			//$list = $this->mobilemanager->query("select * from `mobilemanager` where `wUseID` ='$wUseID' AND `wMB`='$wMB' AND left(`McID`,2) not in ('02','03','12','15')");
			if(!S('List_Mobile_Cache_'.session('pid'))){
				$list = $this->mobilemanager->where(array('wUseID' => session('wUseID')))->field('McID, McName')->select();
			}
			$find = $this->timeaction_head->where(array('Pid' => $Pid))->field("wUseID",true)->find();
			if($find){
				$findmodel = $this->timeaction->where(array('wModel' => $find['Pid']))->field('McID')->select();
				$m = TarrayToOarray($findmodel, 'McID');
				$this->assign("checklist",$m);
				$this->assign("myMobile",S('List_Mobile_Cache_'.session('pid')) ? S('List_Mobile_Cache_'.session('pid')) : $list);
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
		$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		if($this->timeaction_head->CheckPid($Pid)){
			$HeadInfo = I('post.');
			$HeadInfo['wUseID'] = session('wUseID');
			if($this->timeaction_head->create($HeadInfo)){
				if($this->timeaction_head->where(array('Pid' => $Pid))->save()){
					$this->timeaction_head->UpdateTimeInfo(array('wName' => trim(I('post.wName'))), I("get.id"));
				}
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
		//$wMB=session('wMB');
		//$wUseID=session('wUseID');
		//$list = $this->mobilemanager->query("select `McID`, `McName` from `mobilemanager` where `wUseID` ='$wUseID' AND `wMB`='$wMB' AND left(`McID`,2) not in ('02','03','12','15')");
		$list = $this->mobilemanager->where(array('wUseID' => session('wUseID')))->field('McID, McName')->select();
		if(!S('List_Mobile_Cache_'.session('pid'))){
			$list = $this->mobilemanager->where(array('wUseID' => session('wUseID')))->field('McID, McName')->select();
		}
		$this->assign("myMobile", S('List_Mobile_Cache_'.session('pid')) ? S('List_Mobile_Cache_'.session('pid')) : $list);
		$this->assign('my7','btn0_a');
		$this->display();
	}
	
	public function typeadd(){
		$HeadInfo = I('post.');
		$HeadInfo['wUseID'] = session('wUseID');
		if($this->timeaction_head->create($HeadInfo)){
			$id=$this->timeaction_head->add();
			$this->timeaction_head->UpdateTimeAddInfo(array('wName' => I('post.wName'), 'Pid'=>  encode($id , C('GRYPTKEY'))));
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