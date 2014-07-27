<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  $config["upload_path"]	=	FCPATH . 'assets/upload/';
  $config["allowed_types"]	=	'gif|jpg|png|jpeg|doc|docx|xls|xlsx';
  $config["overwrite"]		=	FALSE;
  $config["max_size"]		=	5120;
  $config["max_width"]		=	0;
  $config["max_height"]		=	0;
  $config["encrypt_name"]	= 	TRUE;
  $config["remove_spaces"]	=	TRUE;
  $config["xss_clean"]		=	FALSE;
  $config["max_filename"]	=	20;
?>