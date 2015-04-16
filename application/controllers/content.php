<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

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
	public function index() {
		$param = $_GET;
		if (empty($param)) {
			$param = array();
		}
		unset($param['jsonpcallback']);
		$p = $param;
		unset($p['uid']);
		$session_exist = $this -> db -> get_where('sessions',array('sid' => $data['sid'])) -> result();
		if(empty($session_exist)){
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'is_login'=>0,'data' => array(),'msg' => '请先登录')) . ")";
			exit;
		}
		$res = $this->db->get_where('content', $p)->result_array();
		foreach ($res as $k => $v) {
			
			if ($v['uid'] == $param['uid']) {
				unset($res[$k]); //过滤自己发布的需求
			}
			if (empty($v['service_type'])) {
				$service_type = 0;
			} else {
				$service_type = $v['service_type'];
			}
			switch ($service_type) {

				case 1:
					$res[$k]['skill'] = "家电维修";
					break;
				case 2:
					$res[$k]['skill'] = "开锁";
					break;
				case 3:
					$res[$k]['skill'] = "海外代购";
					break;
				default:
					$res[$k]['skill'] = "家电维修";
					break;
			}
			$o = $this->db->get_where('order', array('cid' => $v['id']))->result();
			$len = count($o);
			if (empty($o)) {
				$res[$k]['is_grap'] = 0;
			} else {
				$res[$k]['is_grap'] = 1;
			}
			if (!empty($param['uid'])) {
				$o = $this->db->get_where('order', array('cid' => $v['id'], 'uid' => $param['uid']))->result();
				$len = count($o);
				if (empty($o)) {
					$res[$k]['notchoose'] = 0;
				} else {
					$res[$k]['notchoose'] = 1;
				}
			}

			/*if (!empty($param['uid'])) {
		foreach($o as $kk =$vv){
		if($vv['uid'] == $param["uid"]){
		$res[$k]['is_choose'] = 1
		}else{
		$res[$k]['is_choose'] = 0;
		}
		}
		}*/

		}
		echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'is_login' => 1,'data' => $res,'msg' => '')) . ")";
		exit;

	}

	public function add() {
		$data = $_GET;
		$session_exist = $this -> db -> get_where('sessions',array('sid' => $data['sid'])) -> result();
		if(empty($session_exist)){
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'data' => array(),'msg' => '请先登录')) . ")";
			exit;
		}
		if ((!empty($data['title']) && (!empty($data['content'])))) {
			$param = $data;
			$param['content'] = htmlspecialchars($data['content']);
			$param['ctime'] = time();
			unset($param['login']);
			unset($param['jsonpcallback']);
			$r = $this->db->insert('content', $param);
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'msg' => '发布成功','is_login' => 1)) . ")";
		}
		if (empty($data['title'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '标题不能为空','is_login' => 1)) . ")";

		}
		if (empty($data['content'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '内容不能为空','is_login' => 1)) . ")";

		}
	}

	public function detail() {

		$data = $_GET
		$session_exist = $this -> db -> get_where('sessions',array('sid' => $data['sess_id'])) -> result();
		if(empty($session_exist)){
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'data' => array(),'msg' => '请先登录','is_login' => 0)) . ")";
			exit;
		}
		if (!empty($data['cid'])) {
			$param['id'] = $data['cid'];
			$r = $this->db->get_where('content', $param)->result_array();
			$city = "";
			$province = "";
			$county = "";
			if(!empty($r)){
				if(!empty($r[0]['city'])){
					$cityArr = $this -> db-> get_where('region',array('id' => $r[0]['city']))->result_array();
					$city = $cityArr[0]['local_name'];
				}
				if(!empty($r[0]['province'])){
					$provinceArr  = $this -> db-> get_where('region',array('id' => $r[0]['province']))->result_array();
					$province = $provinceArr[0]['local_name'];
				}
				if(!empty($r[0]['county'])){
					$countyArr = $this -> db-> get_where('region',array('id' => $r[0]['county']))->result_array();
					$county = $countyArr[0]['local_name'];
				}
				$r[0]['dis'] = $province.$city.$county;
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'data' => $r[0],'msg' => '','is_login' => 1)) . ")";exit;

			}else{
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '参数错误','data' => array(),'is_login' => 1)) . ")";exit;

			}
			
		}
		if (empty($data['cid'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '参数错误','data' => array(),'is_login' => 1)) . ")";exit;

		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */