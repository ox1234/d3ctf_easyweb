<?php


class Render_model extends CI_Model
{
	public $username;
	public $userView;

	public function insert_view($username, $content){
		$this->username = $username;
		$this->userView = $content;
		$this->db->insert('userRender',$this);
	}

	public function get_view($userId){
		$res = $this->db->query("SELECT username FROM userTable WHERE userId='$userId'")->result();
		if($res){
			$username = $res[0]->username;
			$username = $this->sql_safe($username);
			$username = $this->safe_render($username);
			$userView = $this->db->query("SELECT userView FROM userRender WHERE username='$username'")->result();
			$userView = $userView[0]->userView;
			return $userView;
		}else{
			return false;
		}
	}
	private function safe_render($username){
		$username = str_replace(array('{','}'),'',$username);
		return $username;
	}

	private function sql_safe($sql){
		if(preg_match('/and|or|order|delete|select|union|load_file|updatexml|\(|extractvalue|\)|/i',$sql)){
			return '';
		}else{
			return $sql;
		}
	}
}
