<?php
namespace Home\Controller;
class UserController extends CommonController{
	protected $usermanager;
	protected $users;
	protected $mobilemanager;
	
	public function _initialize(){
		parent::_initialize();
		$this->usermanager = D("Home/Usermanager");	
		$this->users = D("Home/Users");
		$this->mobilemanager = D("Home/Mobilemanager");
		
	}
	
	public function index(){
		$where['wUseID'] = session('wUseID');
		$count      = $this->usermanager->where($where)->count();
	  	$Page       = new \Think\Page($count,10);
	  	$Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>/<b>%TOTAL_PAGE%</b>页');
	  	$Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	  	$show       = $Page->show();
		$list = $this->usermanager->where($where)->field("wUseID",true)->order('Pid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//\Think\Log::write($this->usermanager->getlastsql(),'WARN','File', C('LOG_PATH').'/log_'.date('y_m_d').'.txt');
		//writelog('File' , $list);
		$this->assign("myfamily",$list);
		$this->assign('page',$show);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function test(){
		//echo microtime(TRUE);
		//echo date('y-m-d h:i:s',microtime(TRUE));
		//echo date("y-m-d",time());
		//echo memory_get_usage();
		//echo __DIR__;
		//echo $_SERVER['SCRIPT_FILENAME'];
		//echo dirname($_SERVER['SCRIPT_FILENAME']).'/';
		//echo realpath(THINK_PATH.'Library').'/';
		//echo CONF_PATH.'config_'.APP_MODE.CONF_EXT;
	}
	
	public function del(){
		$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/User/';
		if($this->usermanager->where(array("pid"=>intval(I("get.id")), "wUseID"=>session('wUseID')))->delete()){
			header("Location:$url");
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function edit(){
		$find=$this->usermanager->where(array("pid"=>intval(I("get.id")), "wUseID"=>session('wUseID')))->field('wUseID', true)->find();
		if($find){
			$this->assign('family',$find);
			$this->display();
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function update(){
		$pid = intval(I("get.id"));
		if($this->usermanager->CheckPid($pid)){
			$data  = I("post.");
			$data["wUseID"] = session('wUseID');
			$url = 'http://'.$_SERVER['HTTP_HOST']. __APP__.'/User/';
			if ($this->usermanager->create($data)){
				$this->usermanager->where(array("pid" => $pid, "wUseID"=>session('wUseID')))->save();
				header("Location:$url");
			}
			header("Location:$url");			
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function familyadd(){
		if(IS_POST){
			$data  = I("post.");
			$data["wUseID"] = session('wUseID');
			if($this->usermanager->create($data)){
				$this->usermanager->add();
				$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/User/';
				header("Location:$url");
			}else{
				$this->error($this->usermanager->getError());
			}
		}
	}
	
	public function useredit(){
		$UserList=$this->users->where(array("pid"=>session("pid")))->field('wMB,wName')->find();
		if($UserList){
			$this->assign('wUseID',session('wUseID'));
			$this->assign('wName',$UserList['wName']);
			$this->assign('wMB',$UserList['wMB']);
			$this->display();
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function pwd(){
		$this->display();
	}
	
	public function accountsave(){
		$postwUseID = trim(I("post.wUseID"));
		if(!empty($postwUseID) && (session('wUseID') != $postwUseID)) {
			$this->error(L('Username_n'));
		}
		$datamob = $this->users->where(array("wMB" => I("post.wMB")))->field('pid')->find();
		if($datamob['pid'] == session('pid') || empty($datamob) ){
			$data['wMB'] = trim(I('post.wMB'));
			$Mobilesave = $this->mobilemanager->where(array("wUseID" => session('wUseID')))->save($data);
		    if($this->users->create()){
				$datauser['wMB'] = trim(I('post.wMB'));
				$datauser['wName'] = trim(I('post.wName'));
				$save=$this->users->where(array("wUseID" => session('wUseID')))->save($datauser);//更新姓名
				session('wMB',I("post.wMB"));
			}
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/User/';
			header("Location:$url");
		}else{
			$this->error(L('S_binding'), __APP__.'/User/useredit/');
		}
	}
	
	public function pwdsave(){
		if(I("post.oldpwd") != '' && I("post.pwd") != '' && I('post.repwd') != ''){
			if(I("post.pwd") != I("post.repwd")){
				$this->error(L('S_pass_c'));
			}else{
				$data=$this->users->where(array("pid" => session('pid')))->field('wPassWord')->find();
				if($data['wPassWord'] != md5(md5(I("post.oldpwd")))){
					$this->error(L('S_pass_e'));
				}else{
					$this->users->where(array("pid" => session('pid')))->setField('wPassWord',md5(md5(I('post.pwd'))));
					$this->success(L('S_edit'), __APP__.'/User/out/');
				}
			}
		}else{
			$this->error(L('S_pass_n'));
		}
	}
	
	public function out(){
		session(null);
		$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/';
		header("Location:$url");
	}
}