<?php
namespace Home\Controller;
class TypeController extends CommonController{
	protected $modeltype_head;
	protected $mobilemanager;
	protected $modeltype;
	
	public function _initialize(){
		parent::_initialize();
		$this->modeltype_head = D("Modeltype_head");
		$this->mobilemanager = D("Mobilemanager");
		$this->modeltype = D("Modeltype");
	}
	public function index(){
		if(!S('List_Type_Cache_'.session('pid'))){
			$TypeListInfo = $this->modeltype_head->ReUpdateTypeInfo();
		}
		$this->assign("mytype",S('List_Type_Cache_'.session('pid'))? S('List_Type_Cache_'.session('pid')):$TypeListInfo);
		$this->assign('my4','btn0_a');
		$this->display();
	}

	public function del(){
		$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));		
		if($this->modeltype_head->CheckPid($Pid)){
			$result = $this->modeltype_head->relation(true)->where(array('Pid' => $Pid))->delete();
			if($result){
				$this->modeltype_head->UpdateTypeDeleteInfo(I("get.id"));
				$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Type/';
				header("Location:$url");
			}else{
				$this->error(L('S_del_e'),U('Type/index'));
			}
		}else{
			$this->error(L('S_parameter_e'));
		}
	}

	public function edit(){
		$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		if($this->modeltype_head->CheckPid($Pid)){
			//$wMB=session('wMB');
			//$wUseID=session('wUseID');
			//$list = $this->mobilemanager->query("select `McID`, `McName` from `mobilemanager` where `wUseID` ='$wUseID' AND `wMB`='$wMB' AND left(`McID`,2) not in ('02','03','12','15')");
			if(!S('List_Mobile_Cache_'.session('pid'))){
				$list = $this->mobilemanager->where(array('wUseID' => session('wUseID')))->field('McID, McName')->select();
			}
			$find=$this->modeltype_head->where(array("Pid" => $Pid))->field("wUseID",true)->find();
			if($find){
				$findmodel=$this->modeltype->where(array("wModel" => $find['Pid']))->field('McID')->select();
				$m = TarrayToOarray($findmodel, 'McID');
				$this->assign("checklist",$m);
				$this->assign("myMobile",S('List_Mobile_Cache_'.session('pid'))?S('List_Mobile_Cache_'.session('pid')):$list);
				$find['Pid'] = I("get.id");
				$this->assign('type',$find);
				$this->assign('my4','btn0_a');
				$this->display();
			}else{
				$this->error(L('S_parameter_e'));
			}
		}else{
			$this->error(L('S_parameter_e'));
		}
	}

	public function update(){
		$Pid = intval(decode(I("get.id") , C('GRYPTKEY')));
		if($this->modeltype_head->CheckPid($Pid)){
			$HeadInfo = I('post.');
			$HeadInfo['wUseID'] = session('wUseID');
			if($this->modeltype_head->create($HeadInfo)){
				if($this->modeltype_head->where(array("Pid" => $Pid))->save()){
					$this->modeltype_head->UpdateTypeInfo(array('wName' => trim(I('post.wName'))), I("get.id"));
				}
			}
			$this->modeltype->where(array("wModel" => $Pid))->delete();
			$wModeldata=I('post.wModel',null);
			for($i=0;$i<count($wModeldata);$i++){
				$data['wModel']=$Pid;
				$data['McID']=$wModeldata[$i];
				$data['wUseID']=session('wUseID');
				$this->modeltype->create();
				$this->modeltype->add($data);
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Type/';
			header("Location:$url");
		}else{
			$this->error(L('S_parameter_e'));
		}
	}

	public function add(){
		//$wMB=session('wMB');
		//$wUseID=session('wUseID');
		//$list = $this->mobilemanager->query("select `McID`, `McName` from `mobilemanager` where `wUseID` ='$wUseID' AND `wMB`='$wMB' AND left(`McID`,2) not in ('02','03','12','15')");
		if(!S('List_Mobile_Cache_'.session('pid'))){
			$list = $this->mobilemanager->where(array('wUseID' => session('wUseID')))->field('McID, McName')->select();
		}
		$this->assign("myMobile",S('List_Mobile_Cache_'.session('pid'))?S('List_Mobile_Cache_'.session('pid')):$list);
		$this->assign('my5','btn0_a');
		$this->display();
	}
	
	public function typeadd(){
		$HeadInfo = I('post.');
		$HeadInfo['wUseID'] = session('wUseID');
		if($this->modeltype_head->create($HeadInfo)){
			$id=$this->modeltype_head->add();
			$this->modeltype_head->UpdateUserAddInfo(array('wName' => I('post.wName'), 'Pid'=> encode($id , C('GRYPTKEY'))));
			$wModeldata=I('post.wModel',null);
			$Model=D("modeltype");
			for($i=0;$i<count($wModeldata);$i++){
				$data['wModel']=$id;
				$data['McID']=$wModeldata[$i];
				$data['wUseID']=session('wUseID');
				$this->modeltype->create();
				$this->modeltype->add($data);
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Type/';
			header("Location:$url");
		}else{
			$this->error($this->modeltype_head->getError());
		}
	}
}