<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('rest_server');
	}


	public function get(){
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			if($this->rest_server->check_attempts()){
				echo json_encode(
					array("status" => "OK", "message" => "Hello")
				);
				header("HTTP/1.1 200 OK");
			}
			else{
				$call_attemps_info = $this->rest_server->get_attempts_info();
				echo json_encode(
					array("status" => "KO", "message" => "Number of calls exceeded for GET " . $call_attemps_info->call_number . " of " . $call_attemps_info->value)
				);
				header("HTTP/1.1 429 TOO MANY REQUESTS");
			}
		}
		else{
			header("HTTP/1.1 400 BAD REQUEST");
		}
		die();
	}

	public function post(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->rest_server->check_attempts()){
				echo json_encode(
					array("status" => "OK", "message" => "Hello")
				);
				header("HTTP/1.1 200 OK");
			}
			else{
				$call_attemps_info = $this->rest_server->get_attempts_info();
				echo json_encode(
					array("status" => "KO", "message" => "Number of calls exceeded for POST " . $call_attemps_info->call_number . " of " . $call_attemps_info->value)
				);
				header("HTTP/1.1 429 TOO MANY REQUESTS");
			}
		}
		else{
			header("HTTP/1.1 400 BAD REQUEST");
		}
		die();
	}

}
