<?php

defined('BASEPATH') OR exit('No directory script access allowed');

class Migration_create_tb_service extends CI_Migration {
	public function up(){
		$this->dbforge->create_database($this->config->item('db_database'));
	}
}
