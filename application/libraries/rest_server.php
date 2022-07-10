<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_server {

	protected $client_ip = null;
	protected $req_method = null;

	public function __construct() {
		$this->CI =& get_instance();
		$this->client_ip = $this->get_ip_address();
		$this->req_method = $_SERVER['REQUEST_METHOD'];

		$this->CI->load->library('rest_db');

	}

	public function check_attempts(){
		$this->CI->rest_db->open_conn();
		$call_attemps = $this->CI->rest_db->check_ip_access($this->client_ip, $this->req_method);
		if($call_attemps){
			if($call_attemps->first_call_attempt < date('Y-m-d H:i:s', strtotime("-1 min"))){
				if($this->CI->rest_db->delete_prev_call_attempts($this->client_ip, $this->req_method)){
					if($this->CI->rest_db->insert_new_call_attempt($this->client_ip, $this->req_method)){
						$this->CI->rest_db->close_conn();
						return true;
					}
				}
			}
			else{
				if($call_attemps->call_number < $call_attemps->value){
					if($this->CI->rest_db->update_call_attempt($this->client_ip, $this->req_method, $call_attemps->call_number + 1)){
						$this->CI->rest_db->close_conn();
						return true;
					}
				}
			}
		}
		else{
			if($this->CI->rest_db->insert_new_call_attempt($this->client_ip, $this->req_method)){
				$this->CI->rest_db->close_conn();
				return true;
			}
		}
		$this->CI->rest_db->close_conn();
		return false;
	}

	public function get_attempts_info(){
		$this->CI->rest_db->open_conn();
		$attempts_info = $this->CI->rest_db->check_ip_access($this->client_ip, $this->req_method);
		$this->CI->rest_db->close_conn();
		return $attempts_info;
	}

	private function get_ip_address() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

}
