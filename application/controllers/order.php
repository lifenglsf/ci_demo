<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Order extends CI_Controller {

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
		$data = $_GET;
		$res = $this->db->get_where('order', array('cid' => $data['cid']))->result_array();
		foreach ($res as $key => $value) {
			$user = $this->db->get_where('user', array('id' => $value['uid']))->result();
			$res[$key]['user'] = $user;
		}
		echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'data' => $res, 'num' => count($res))) . ")";
		exit;
	}

	public function add() {
		$data = $_GET;
		$res = $this->db->get_where('order', array('cid' => $data['cid'], 'uid' => $data['uid']))->result();
		$len = count($res);
		if (!empty($res)) {
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 1, 'msg' => '您已抢单')) . ")";
			exit;
		} else {
			$param = $data;
			$param['uid'] = $data['uid'];
			$param['cid'] = $data['cid'];
			$param['ctime'] = time();
			unset($param['jsonpcallback']);

			$r = $this->db->insert('order', $param);
			$id = $this->db->insert_id();
			echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'msg' => '抢单成功')) . ")";
			exit;
		}

	}

	public function edit() {
		$data = $_GET;
		$param['cid'] = $data['cid'];
		$param['uid'] = $data['uid'];
		$param['id'] = $data['cid'];
		$this->db->where($param);
		$r = $this->db->update('order', array('status' => 1));
		$this->db->where(array('id' => $param['cid']));
		$this->db->update('content', array('status' => 1));
		echo $_GET['jsonpcallback'] . "(" . json_encode(array('errno' => 0, 'msg' => "选择成功")) . ")";exit;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */