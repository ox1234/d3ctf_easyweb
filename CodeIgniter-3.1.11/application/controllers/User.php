<?php

class User extends CI_Controller
{

	private $renderPath;
	private $base_url;


	public function __construct()
	{
		parent::__construct();
		$this->cache->redis;
		//	setting smarty security options
		$my_security_policy = new Smarty_Security($this->ci_smarty);
		$my_security_policy->php_functions = null;
		$my_security_policy->php_handling = Smarty::PHP_REMOVE;
		$my_security_policy->streams = array();
		$this->ci_smarty->enableSecurity($my_security_policy);
		$this->renderPath = FCPATH . 'templates/';
		$this->load->model('User_model');
		$this->load->model('Render_model');
		$this->base_url = array('base_url' => $this->config->item('base_url'));
		$this->ci_smarty->assign('base_url', $this->base_url);
	}

	public function index()
	{
		if ($this->session->has_userdata('userId')) {
			$userView = $this->Render_model->get_view($this->session->userId);
			$prouserView = 'data:,' . $userView;
			$this->username = array('username' => $this->getUsername($this->session->userId));
			$this->ci_smarty->assign('username', $this->username);
			$this->ci_smarty->display($prouserView);
		} else {
			redirect('/user/login');
		}
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$init_content = file_get_contents($this->renderPath . 'index/koocola.tpl');
			$init_content = str_replace(array("\r\n", "\r", "\n", "\t"), "", $init_content);
			if ($this->User_model->insert_user($username, $password)) {
				$this->Render_model->insert_view($username, $init_content);
				redirect('user/login');
			} else {
				redirect('user/login');
			}
		} else {
			redirect('user/login');
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('user/login');
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$result = $this->User_model->check_user($username, $password);
			if ($result) {
				$userId = $result[0]->userId;
				$this->session->set_userdata('userId', $userId);
				redirect('user/profile');
			} else {
				echo "<script>alert('your password or username not right');</script><script>history.back();</script>";
			}
		} else {
			$this->ci_smarty->display($this->renderPath . 'login/index.tpl');
		}
	}

	public function profile()
	{
		if ($this->session->has_userdata('userId')) {
			$this->ci_smarty->display($this->renderPath . 'profile/index.tpl');
		} else {
			redirect('user/login');
		}
	}

	private function getUsername($userId)
	{
		$res = $this->db->query("SELECT username FROM userTable WHERE userId = '$userId'")->result();
		if ($res) {
			$username = $res[0]->username;
			return $username;
		} else {
			return false;
		}
	}
}
