<?php

class Datatables {

	var $draw;
	var $start;
	var $length;
	var $total_rows;

	var $col;
	var $dir;
	var $field;
	var $order = null;

	var $search;
	var $search_type;

	var $data = array();

	var $error="";
	var $CI = null;

	public function __construct() 
	{
		$this->CI =& get_instance();
		$this->draw = intval($this->CI->input->post("draw"));
		$this->start = intval($this->CI->input->post("start"));
		$this->length = intval($this->CI->input->post("length"));

		if($this->length <= 0 ) $this->length = null;
		if($this->start <= 0) $this->start = null;

		$this->get_search_data();
	}

	public function set_default_order($col, $dir) 
	{
		$this->order = array();
		$this->order[] = array("field" => $col,"sort" => $dir);
		return $this;
	}

	public function set_total_rows($rows) 
	{
		$this->total_rows = $rows;
	}

	public function ordering($ordering) 
	{

		if(isset($_GET['order'])) {
			$order = $this->CI->input->post("order");
			if(!empty($order)) {
				foreach($order as $o) {
					$this->col = $o['column'];
					$this->dir= $o['dir'];
				}
			}
		}

		if($this->dir != "asc" && $this->dir != "desc") $this->dir = "asc";
		if(isset($ordering[$this->col])) {
			$this->order = array();
			foreach($ordering[$this->col] as $k=>$v) {
				if(empty($v) || $v === 0 ) {
					$v = $this->dir;
				}
				$this->order[] = array("field" => $k, "sort" => $v);
			}
		} else {
			$this->error = "You tried to search for an invalid section.";
		}
	}

	public function get_search_data() 
	{
		$search = $this->CI->input->post("search");
		$search_type = intval($this->CI->input->post("search_type"));

		$search_value = "";
		if(!empty($search['value'])) {
			$search_value = $this->CI->common->nohtml($search['value']);
		}
		$this->search = $search_value;
		$this->search_type = $search_type;
	}

	public function process() 
	{
		$output = array(
			"draw" => $this->draw,
			"recordsTotal" => $this->total_rows,
			"recordsFiltered" => $this->total_rows,
			"data" => $this->data
		);
		if($this->total_rows == 0) {
		}
		return $output;
	}

	public function db_order() 
	{
		if($this->order != null) {
			foreach($this->order as $order) {
				$this->CI->db->order_by($order['field'], $order['sort']);
			}
		}
	}

	public function db_search($columns) 
	{
		if(!empty($this->search)) {
			if($this->search_type == 0) {

				$words = explode(" ", $this->search);
				$this->CI->db->group_start();
				foreach($words as $word) {
					foreach($columns as $field) {
						$this->CI->db->or_like($field, $word);
					}
				}
				$this->CI->db->group_end();

			} elseif($this->search_type == 1) {

				$this->CI->db->group_start();
				foreach($columns as $field) {
					$this->CI->db->or_like($field, $this->search);
				}
				$this->CI->db->group_end();

			} else {

				if(isset($columns[$this->search_type-2])) {
					$this->CI->db->group_start();
					$this->CI->db->or_like($columns[$this->search_type-2], 
						$this->search);
					$this->CI->db->group_end();
				}
			}
		}
	}
}

?>