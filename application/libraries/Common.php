<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function nohtml($message) 
	{
		$message = trim($message);
		$message = strip_tags($message);
		$message = htmlspecialchars($message, ENT_QUOTES);
		return $message;
	}

	public function mask($val, $mask)
	{
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

}

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */
