<?php 
	class Dbconnect extends CI_Model {
		function __construct() {
			parent:: __construct();
		}
		public function getData($table, $column, $value) {
			$query = $this->db->get_where($table, array($column => $value));
			return $query->result();
		}
		public function getID($table, $column, $value) {
			$query = $this->db->get_where($table, array($column => $value));
			$temp = $query->result();
			return $temp[0]->student_id;
		}
		public function writeData($table, $data) {
			$this->db->insert($table, $data);
		}
		public function updateData($table, $data, $key, $value) {
			$this->db->set($data);
			$this->db->where($key, $value);
			$this->db->update($table, $data);
		}
	}
?>