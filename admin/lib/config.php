<?php if(!defined('_lib')) die("Error");

	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	$config_url=$_SERVER["SERVER_NAME"].'/itlvn';

	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'itlvn';
	$config['database']['refix'] = 'table_';
	$_SESSION['ckfinder_baseUrl']=$config_url;
	$ip_host = '127.0.0.1';
	$mail_host = 'noreply@demo69.ninavietnam.com.vn';
	$pass_mail = '1234qwer!@';
	$config['salt']='dx8e*UM%Mk';
	$config['nobots']='noodp, NOINDEX, NOFOLLOW';
	$config['map']='10.8537915,106.6261557';
	$config['sitekey']='6LfvR5kUAAAAAAnZRf9Unj_aMfp2mZjMFDY031XO';
	$config['secretkey']='6LfvR5kUAAAAAEGmaWPCwd5asnCgPlpu3AaHZnYZ';
	$config['lang']=array(''=>'Tiếng Việt','en'=>'Tiếng Anh');
	$config['arrayDomainSSL']=array("");
	date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
