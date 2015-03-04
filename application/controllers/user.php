<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = $_GET;
		if((!empty($data['login'])&&(!empty($data['password'])))){
			$res = $this -> db -> get_where('user',array('name' => $data['login'],'password' => $data['password']))->result();
			$len = count($res);
			if(empty($res)){
				echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '用户名或密码错误')).")";
			}else{
				echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 0,'msg' => '登录成功')).")";
			}
		}
		if(empty($data['login'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '用户名不能为空')).")";

		}
		if(empty($data['password'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '密码不能为空')).")";

		}
	}

	public function register(){
		$data = $_GET;
		if((!empty($data['login'])&&(!empty($data['password'])))){
			$res = $this -> db -> get_where('user',array('mobile' => $data['login']))->result();
			$len = count($res);
			if(!empty($res)){
				echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => $data['login'].'用户已存在')).")";
			}else{
				$param = $data;
				$param['mobile'] = $data['login'];
				unset($param['login']);
				unset($param['jsonpcallback']);
				$r = $this -> db  -> insert('user',$param);
				echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 0,'msg' => '注册成功')).")";
			}
		}
		if(empty($data['login'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '用户名不能为空')).")";

		}
		if(empty($data['password'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '密码不能为空')).")";

		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */