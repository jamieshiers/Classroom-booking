<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['account_suffix']		= '@hoe.local';
$config['base_dn']				= 'OU=HOE,DC=HOE,DC=LOCAL';
$config['domain_controllers']	= array ("hoe-dc1.hoe.local;hoe-dc2.hoe.local");
$config['ad_username']			= 'shiersj';
$config['ad_password']			= '%PASSWORD%';
$config['real_primarygroup']	= true;
$config['use_ssl']				= false;
$config['use_tls'] 				= false;
$config['recursive_groups']		= true;


