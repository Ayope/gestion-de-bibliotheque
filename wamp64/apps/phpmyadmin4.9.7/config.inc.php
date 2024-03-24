<?php

/* Servers configuration */
$i = 0;
/* The 'cookie' auth_type uses AES algorithm to encrypt the password. If
 * at least one server configuration uses 'cookie' auth_type, enter here a
 * pass phrase that will be used by AES. The minimum length is 32 characters
 * The maximum length seems to be 46 characters. */
$cfg['blowfish_secret'] = 'h]C+{nqW$omNoTIkCwC$%z-LTcy%p6_j';

//Checking Active DBMS Servers
$wampConf = @parse_ini_file('../../wampmanager.conf');
//Check if MySQL and MariaDB with MariaDB on default port
$mariaFirst = ($wampConf['SupportMySQL'] == 'on' && $wampConf['SupportMariaDB'] == 'on' && $wampConf['mariaPortUsed'] == $wampConf['mysqlDefaultPort']) ? true : false;
if($wampConf['SupportMySQL'] == 'on') {
/* Server: localhost [1] */
	$i++;
	if($mariaFirst) $i++;
	$cfg['Servers'][$i]['verbose'] = 'MySQL';
	$cfg['Servers'][$i]['host'] = '127.0.0.1';
	$cfg['Servers'][$i]['port'] = $wampConf['mysqlPortUsed'];
	$cfg['Servers'][$i]['extension'] = 'mysqli';
	$cfg['Servers'][$i]['auth_type'] = 'cookie';
	$cfg['Servers'][$i]['user'] = '';
	$cfg['Servers'][$i]['password'] = '';

	// Hidden databases in PhpMyAdmin left panel
	//$cfg['Servers'][$i]['hide_db'] = '(information_schema|mysql|performance_schema|sys)';

	// Allow connection without password
	$cfg['Servers'][$i]['AllowNoPassword'] = true;
}
/* Server: localhost [2] */
if($wampConf['SupportMariaDB'] =='on') {
	$i++;
	if($mariaFirst) $i -= 2;
	$cfg['Servers'][$i]['verbose'] = 'MariaDB';
	$cfg['Servers'][$i]['host'] = '127.0.0.1';
	$cfg['Servers'][$i]['port'] = $wampConf['mariaPortUsed'];
	$cfg['Servers'][$i]['extension'] = 'mysqli';
	$cfg['Servers'][$i]['auth_type'] = 'cookie';
	$cfg['Servers'][$i]['user'] = '';
	$cfg['Servers'][$i]['password'] = '';

	// Hidden databases in PhpMyAdmin left panel
	//$cfg['Servers'][$i]['hide_db'] = '(information_schema|mysql|performance_schema|sys)';
	// Allow connection without password
	$cfg['Servers'][$i]['AllowNoPassword'] = true;
}

// Suppress Warning about pmadb tables
$cfg['PmaNoRelation_DisableWarning'] = true;

// To have PRIMARY & INDEX in table structure export
$cfg['Export']['sql_drop_table'] = true;
$cfg['Export']['sql_if_not_exists'] = true;

$cfg['MySQLManualBase'] = 'http://dev.mysql.com/doc/refman/5.7/en/';
/* End of servers configuration */

?>
