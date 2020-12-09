<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template
{
	var $layout = "";
	var $data = array();

	public function loadContent($view,$data=array(),$die=0)
	{
		$CI =& get_instance();
		
		if(empty($this->layout)) {
			$this->set_layout($CI->settings->info->layout.'.php');
		}
		$site = array();
		foreach($this->data as $k=>$v) {
			$site[$k] = $v;
		}
		foreach($this->data as $k=>$v) {
			$data[$k] = $v;
		}
		$site['content'] = $CI->load->view($view,$data,true);


		$CI->load->view($this->layout, $site);
		if($die) die($CI->output->get_output());
	}

	public function loadData($key, $data) 
	{
		$this->data[$key] = $data;
	}

	public function set_layout($view) 
	{
		$this->layout = $view;
	}

}
?>
