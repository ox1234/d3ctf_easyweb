<?php


class File extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// setting smarty security options
		$my_security_policy = new Smarty_Security($this->ci_smarty);
		$my_security_policy->php_functions = null;
		$my_security_policy->php_handling = Smarty::PHP_REMOVE;
		$my_security_policy->streams = array();
		$this->renderPath = FCPATH . 'templates/';
		$this->base_url = array('base_url' => $this->config->item('base_url'));
		$this->ci_smarty->assign('base_url', $this->base_url);
	}

	public function index()
	{
		if($this->session->has_userdata('userId')){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_FILES['userfile']['error'] > 0){
					echo "Error: " . $_FILES["file"]["error"] . "<br />";
				}else{
					$filename = $_FILES['userfile']['name'];
					$filename = str_replace('..','',$filename);
					$uploadPath = '/tmp/' . $this->session->userId . '/';
					if(substr($filename,0,1) === '.'){
						echo "<script>alert('Error: file type is not allowed');</script><script>history.back();</script>";
					}else{
						$filepath = '/tmp/' . $this->session->userId . '/' . $filename;
						move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadPath . $filename);
						echo "<script>alert('file store in $filepath')</script><script>history.back();</script>";
					}
				}
			} else {
				$this->ci_smarty->display($this->renderPath . 'picup/index.tpl');
			}
		}else{
			redirect('user/login');
		}
	}

	private function getExt($filename){
		$arr = pathinfo($filename);
		$ext = $arr['extension'];
		return $ext;
	}
}
