<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

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
			$res = $this -> db -> get_where('user',array('mobile' => $data['login'],'password' => $data['password']))->result();
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

	public function add(){
		$data = $_GET;
		if((!empty($data['title'])&&(!empty($data['content'])))){
			$param = $data;
			$param['content'] = htmlspecialchars($data['content']);
			$param['ctime'] = time();
			unset($param['login']);
			unset($param['jsonpcallback']);
			$r = $this -> db  -> insert('content',$param);
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 0,'msg' => '发布成功')).")";
		}
		if(empty($data['title'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '标题不能为空')).")";

		}
		if(empty($data['content'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '内容不能为空')).")";

		}
	}

	public function detail(){
		$data = $_GET;
		if(!empty($data['cid'])){
			$param['id'] = $data['cid'];
			$r = $this -> db  -> get_where('content',$param)->result();
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 0,'data' => $r[0])).")";exit;
		}
		if(empty($data['id'])){
			echo $_GET['jsonpcallback']."(".json_encode(array('errno' => 1,'msg' => '参数错误')).")";exit;

		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */