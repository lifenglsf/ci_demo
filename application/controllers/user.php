<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

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

	public function user_list() {
		$res = $this->db->get_where('user', array())->result_array();
		print_r($res);
	}
	public function index() {
		$data = $_GET;
		if ((!empty($data['login']) && (!empty($data['password'])))) {
			$res = $this->db->get_where('user', array('mobile' => $data['login'], 'password' => $data['password']))->result();
			$len = count($res);
			if (empty($res)) {
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '用户名或密码错误')) . ")";
			} else {
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'msg' => '登录成功', 'data' => $res[0])) . ")";
			}
		}
		if (empty($data['login'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '用户名不能为空')) . ")";

		}
		if (empty($data['password'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '密码不能为空')) . ")";

		}
	}

	public function register() {
		$data = $_GET;
		if ((!empty($data['login']) && (!empty($data['password'])))) {
			$res = $this->db->get_where('user', array('mobile' => $data['login']))->result();
			$len = count($res);
			if (!empty($res)) {
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => $data['login'] . '用户已存在')) . ")";
			} else {
				$param = $data;
				$param['mobile'] = $data['login'];
				$param['ctime'] = time();
				unset($param['login']);
				unset($param['jsonpcallback']);
				if (empty($param['lat'])) {
					unset($param['lat']);
				}
				if (empty($param['lng'])) {
					unset($param['lng']);
				}
				if (empty($param['uuid'])) {
					unset($param['uuid']);
				}
				if (empty($param['platform'])) {
					unset($param['platform']);
				}
				$r = $this->db->insert('user', $param);
				$id = $this->db->insert_id();
				echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'msg' => '注册成功', 'user' => array('id' => $id))) . ")";
			}
		}
		if (empty($data['login'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '用户名不能为空')) . ")";

		}
		if (empty($data['password'])) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '密码不能为空')) . ")";

		}
	}

	public function addSkill() {
		$data = $_GET;
		$param['service_type'] = $data['service_type'];
		$this->db->update('user', $param, array('id' => $data['id']));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */