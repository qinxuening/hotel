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
		//$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");		
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
		//$Pid=intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");
		if($this->modeltype_head->CheckPid($Pid)){
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
			$find=$this->modeltype_head->where(array("Pid" => $Pid))->field("wUseID",true)->find();
			if($find){
				$findmodel=$this->modeltype->where(array("wModel" => $find['Pid']))->field('McID ,Type')->select();
				foreach ($findmodel as $k => $v){
					if(1 == $v['Type']){
						$dataOn[] = $v['McID'];
					}else{
						$dataOff[] = $v['McID'];
					}
				}
				$this->assign("checklistOn" , $dataOn);
				$this->assign("checklistOff" , $dataOff);
				$this->assign("myMobile",$list);
				$this->assign('type',$find);
				$this->display();
			}else{
				$this->error(L('S_parameter_e'));
			}
		}else{
			$this->error(L('S_parameter_e'));
		}			
	}

	public function update(){
		//$Pid = intval(decode(I("get.id") , C('GRYPTKEY')));
		$Pid = I("get.id");
		if($this->modeltype_head->CheckPid($Pid)){
			$HeadInfo = I('post.');
			$HeadInfo['wUseID'] = session('wUseID');
			if($this->modeltype_head->create($HeadInfo)){
				$this->modeltype_head->where(array("Pid" => $Pid))->save();
			}
			$this->modeltype->where(array("wModel" => $Pid))->delete();
			$wModelOndata=I('post.wModelOn',null);
			$wModelOffdata=I('post.wModelOff',null);
			for($i=0;$i<count($wModelOndata);$i++){
				$dataOn['wModel']=$Pid;
				$dataOn['McID']=$wModelOndata[$i];
				$dataOn['wUseID']=session('wUseID');
				$dataOn['Type']= 1;
				$this->modeltype->create();
				$this->modeltype->add($dataOn);
			}
			for($i=0;$i<count($wModelOffdata);$i++){
				$dataOff['wModel']=$Pid;
				$dataOff['McID']=$wModelOffdata[$i];
				$dataOff['wUseID']=session('wUseID');
				$dataOff['Type']= 0;
				$this->modeltype->create();
				$this->modeltype->add($dataOff);
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Type/';
			header("Location:$url");
		}else{
			$this->error(L('S_parameter_e'));
		}
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
		$this->assign("myMobile",$list);
		$this->assign('my5','btn0_a');
		$this->display();
	}
	
	public function typeadd(){
		$HeadInfo = I('post.');
		$HeadInfo['wUseID'] = session('wUseID');
		if($this->modeltype_head->create($HeadInfo)){
			$id=$this->modeltype_head->add();
			$wModelOndata=I('post.wModelOn',null);
			$wModelOffdata=I('post.wModelOff',null);
			for($i=0;$i<count($wModelOndata);$i++){
				$dataOn['wModel']=$id;
				$dataOn['McID']=$wModelOndata[$i];
				$dataOn['wUseID']=session('wUseID');
				$dataOn['Type']= 1;
				$this->modeltype->create();
				$this->modeltype->add($dataOn);
			}
			for($i=0;$i<count($wModelOffdata);$i++){
				$dataOff['wModel']=$id;
				$dataOff['McID']=$wModelOffdata[$i];
				$dataOff['wUseID']=session('wUseID');
				$dataOff['Type']= 0;
				$this->modeltype->create();
				$this->modeltype->add($dataOff);
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/Type/';
			header("Location:$url");
		}else{
			$this->error($this->modeltype_head->getError());
		}
	}
}