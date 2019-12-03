<?php


class User_model extends CI_Model
{
	public $username;
	public $password;
	public $userId;

	public function insert_user($username,$password){
		$this->username = $username;
		$this->password = md5($password);
		$this->userId = md5(uniqid());

		if($this->uniq_user($this->username)){
			$this->db->insert('userTable',$this);
			$upload_path = '/tmp/' . $this->userId;
			mkdir($upload_path);
			return true;
		}else{
			return false;
		}
	}

	public function get_user($userId){
		$query = $this->db->get_where('userTable',array('userId' => $userId),0,1);
		return $query->result();
	}

	public function check_user($username,$password){
		$password = md5($password);
		$result = $this->db->get_where('userTable',array('username' => $username, 'password' => $password))->result();
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	public function uniq_user($username){
		$result = $this->db->get_where('userTable',array('username' => $username))->result();
		if(empty($result)){
			return true;
		}else{
			return false;
		}
	}
}
