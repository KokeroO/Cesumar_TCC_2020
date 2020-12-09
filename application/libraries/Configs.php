<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Configs 
{	
	var $info=array();
	public function __construct() 
	{
		$CI =& get_instance();
		$site = $CI->db->select("*")
		->limit(1)
		->get("configuracoes");
		
		if($site->num_rows() == 0) {
			echo "Erro: Falta a linha de configurações no banco de dados.";
			exit;
		} else {
			$this->info = $site->row();
		}
	}
}
?>