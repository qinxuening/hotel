<?php
namespace Home\Controller;
use Think\Controller;
class LostpasswordController extends Controller{
	protected $users;
	protected $mobilevercode;
	
	public function _initialize(){
		$this->users = M('Users');
		$this->mobilevercode = M('Mobilevercode');
		$this->assign('langue',L('langue'));
	}
	
	public function index(){
		$this->display();
	}

	function _empty(){
		header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
		$this->display("Public:404");
	}
	
	public function mobile(){
		if(trim(I('post.wUseID')) != ''){
			$mdata = $this->users->where(array('wUseID' => trim(I('post.wUseID'))))->field('wMB, intl')->find();
			if($mdata){
				session('passID', trim(I('post.wUseID')));
				session('passwMB',$mdata['wMB']);
				session('intl',$mdata['intl']);
				$this->assign('wMB',mobile($mdata['wMB']));
				$this->display();
			}else{
				$this->error(L('S_member_n'));
			}
		}else{
			header("Location:".__APP__."/Lostpassword/");
		}
	}

	public function mob(){
		if (trim(I('post.mobile')) != '' && session('passwMB') != ''){
			$mdata = $this->mobilevercode->where(array('mb' => session('passwMB')))->find();
			if(!$mdata){
				$data["vercode"] = mt_rand(100000,999999);
				$data["cdatetime"] = date('Y-m-d H:i:s',time()+10);
				$data["mb"] = session('passwMB');
				$this->mobilevercode->data($data)->add();
				if (session('intl') == '86'){
					$SendMSG = L('FindSMS').$data["vercode"].L('NotReveal');
					$SendMSG = iconv("UTF-8","",$SendMSG);
					$smsok = intlsmsto1(session('passwMB'), $SendMSG, $data["vercode"]);
				}else{
					$SendMSG = "Dear user, you are retrieving your password, the verification code is:".$data["vercode"].",please do not disclose to others【Loyalty Technology】.";
					$smsok = intlsmsto(session('intl').session('passwMB'),$SendMSG,$data["vercode"]);
				}
					
			}else{
				if(strtotime($mdata["cdatetime"])+50 < time()){
					$data["vercode"] = mt_rand(100000,999999);
					$data["cdatetime"] = date('Y-m-d H:i:s',time()+10);
					$data["mb"] = session('passwMB');
					$this->mobilevercode->where(array('mb' => $mdata['mb']))->save($data);
					if (session('intl') == '86'){
						$SendMSG = L('FindSMS').$data["vercode"].L('NotReveal');
						$SendMSG = iconv("UTF-8","",$SendMSG);
						$smsok=intlsmsto1(session('passwMB'),$SendMSG,$data["vercode"]);
					}else{
						$SendMSG="Dear user, you are retrieving your password, the verification code is:".$data["vercode"].",please do not disclose to others.";
						$smsok=intlsmsto(session('intl').session('passwMB'),$SendMSG,$data["vercode"]);
					}
				}
			}
			$this->assign('msg', $smsok);
			$this->display();
		}else{
			header("Location:".__APP__."/Lostpassword/");
		}
	}

	public function Password(){
		if (trim(I('post.authCode')) != '' && session('passwMB') != '' && session('passID') !=''){
			$mdata=$this->mobilevercode->where(array('mb' => session('passwMB'), 'vercode' => trim(I('post.authCode'))))->field('pid')->find();
			if($mdata){
				$this->display();
			}else{
				$this->error(L('S_code_e'));
			}
		}else{
			$this->error(L('S_parameter_e'), '__APP__/');
		}
	}
	
	public function Complete(){
		if (trim(I('post.wPassWord')) != '' && trim(I('post.pwd')) != '' && session('passID') != ''){
			if(trim(I('post.wPassWord')) != trim(I('pwd'))){
				$this->error(L('S_pass_c'));
			}else{
				$save=$this->users->where(array('wUseID' => session('passID')))->setField('wPassWord',md5(trim(I('post.wPassWord'))));
				$data["vercode"]=mt_rand(100000,999999);
				$this->mobilevercode->where(array('mb' => session('passwMB')))->save($data);
				session(null);
				$this->display();
			}
		}else{
			$url = 'http://'.$_SERVER['HTTP_HOST'];
			header("Location:$url");
		}
	}
	
	public function CheckMobile() {
		$mdata=$this->users->where(array('wUseID' => trim(I('post.param'))))->field('pid')->find();
		if($mdata){
			echo '{"status":"y"}';
		} else {
			echo L('Y_user_ex');
		}
	}
}