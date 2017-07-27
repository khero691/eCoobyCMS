<?php
/**
 * Loads the eCooby common files.
 *
 * @package Admin eCooby
 */
	session_start();
	header('Content-Type: text/html; charset=utf-8', true);
	
	require('../ec-inc/config.php' );
	
	require('../ec-inc/version.php' );

	if($_COOKIE['userId'] && $_COOKIE['access_hash']) {
		if($result = $mysqli->query("SELECT * FROM `ec_users` ORDER BY `id`")) {
			unset($i);
			do {
				if($row['id'] != 0) {
					if($_COOKIE['access_hash'] == md5($row['id'].'-'.$row['login'].'-'.$row['password'])) $i++;
				}
			} while ($row = $result->fetch_assoc());

			if($i < 1) {
				//setcookie('access_hash', '', time() - (86400 * 30), '/');
				//setcookie('userId', '', time() - (86400 * 30), '/');
			}
			
		}
	}
	
	require( dirname( __FILE__ ) . '/options.php' );
