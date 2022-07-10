<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_db {

	protected $conn = null;
	protected $db_hostname = 'localhost';
	protected $db_username = 'root';
	protected $db_password = '';
	protected $db_database = 'redokun_db';

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function open_conn(){
		try {
			$this->conn = new mysqli($this->db_hostname, $this->db_username, $this->db_password, $this->db_database);
			if ( mysqli_connect_errno()) {
				throw new Exception("Could not connect to database.");
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
		return $this->conn;
	}

	public function close_conn(){
		$this->conn->close();
	}

	public function check_ip_access($client_ip, $req_method){
		$query = "SELECT *, MIN(date_insert) as first_call_attempt
					FROM call_attempts
					JOIN services ON call_attempts.call_method = services.code
					WHERE ip_address = '{$client_ip}' AND call_method = '{$req_method}'
					LIMIT 1";
		$stmt = $this->conn->query($query);
		$all = $stmt->fetch_all(MYSQLI_ASSOC);
		$row = (isset($all[0]) ? $all[0] : array());
		if(!empty($row['id'])) {
			return (object)$row;
		}
		return false;
	}

	public function delete_prev_call_attempts($client_ip, $req_method){
		$query = "DELETE FROM call_attempts WHERE ip_address = '{$client_ip}' AND call_method = '{$req_method}'";
		$this->conn->query($query);
		return $this->conn->affected_rows;
	}

	public function insert_new_call_attempt($client_ip, $req_method){
		$query = "INSERT INTO call_attempts  (ip_address, call_method, date_insert, call_number)
					VALUES ('{$client_ip}', '{$req_method}', '" . date('Y-m-d H:i:s') . "', 1); ";
		$this->conn->query($query);
		return $this->conn->affected_rows;
	}

	public function update_call_attempt($client_ip, $req_method, $new_call_number){
		$query = "UPDATE call_attempts
					SET call_number = {$new_call_number}
					WHERE ip_address = '{$client_ip}' AND call_method = '{$req_method}'";
		$this->conn->query($query);
		return $this->conn->affected_rows;
	}
}
