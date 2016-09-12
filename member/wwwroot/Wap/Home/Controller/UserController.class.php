<?php
namespace Home\Controller;
use Think\Cache\Driver\Redis;
use Think\Cache\Driver\Memcached;
class UserController extends CommonController{
	protected $usermanager;
	protected $users;
	protected $mobilemanager;
	
	public function _initialize(){
		parent::_initialize();
		$this->usermanager = D("Usermanager");	
		$this->users = D("Users");
		$this->mobilemanager = D("Mobilemanager");
		$this->assign('langue',L('langue'));
	}
	
	public function index(){
		if(!S('List_User_Cache_'.session('pid'))){
			$UserListInfo = $this->usermanager->ReUpdateUserInfo();
		}
		$this->assign("myfamily", S('List_User_Cache_'.session('pid'))? S('List_User_Cache_'.session('pid')):$UserListInfo);
		$this->assign('my1','btn0_a');
		$this->display();
	}
	
	public function add(){
		$this->assign('my2','btn0_a');
		$this->display();
	}
	
	public function pwd(){
		$this->assign('my9','btn0_a');
		$this->display();
	}
	
	public function del(){
		//$pid = intval(decode(I("get.id") , C('GRYPTKEY')));
		$pid = I("get.id");
		if($this->usermanager->where(array("pid"=> $pid, "wUseID"=>session('wUseID')))->delete()){
			$this->usermanager->UpdateUserDeleteInfo(I("get.id"));
			$url = 'http://'.$_SERVER['HTTP_HOST'].__APP__.'/User/';
			header("Location:$url");
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function edit(){
		//$pid = intval(decode(I("get.id") , C('GRYPTKEY')));
		$pid = I("get.id");
		$find=$this->usermanager->where(array("pid" => $pid, "wUseID"=>session('wUseID')))->field('familyid , familyname')->find();
		if($find){
			$find['pid'] = I("get.id");
			$this->assign('family',$find);
			$this->assign('my1','btn0_a');
			$this->display();
		}else{
			$this->error(L('S_parameter_e'));
		}
	}
	
	public function update(){
		//$pid = intval(decode(I("get.id") , C('GRYPTKEY')));
		$pid = I("get.id");
		if($this->usermanager->CheckPid($pid)){
			$data  = I("post.");
			$data["wUseID"] = session('wUseID');
			$url = 'http://'.$_SERVER['HTTP_HOST']. __APP__.'/User/';
			if ($this->usermanager->create($data)){
				if($this->usermanager->where(array("pid" => $pid, "wUseID"=>session('wUseID')))->save()){
					$this->usermanager->UpdateUserInfo(array('pid'=> I("get.id"), 'familyid'=>I('post.familyid'), 'familyname'=>I('post.familyname')), I("get.id"));
				}
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
				$pid = $this->usermanager->add();
				$this->usermanager->UpdateUserAddInfo(array('pid'=> $pid , 'familyid'=>I('post.familyid'), 'familyname'=>I('post.familyname')));
				//encode($pid , C('GRYPTKEY'))
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
			$this->assign('wUseID', session('wUseID'));
			$this->assign('wName', $UserList['wName']);
			$this->assign('wMB', session('wMB'));
			$this->assign('my8','btn0_a');
			$this->display();
		}else{
			$this->error(L('S_parameter_e'));
		}
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