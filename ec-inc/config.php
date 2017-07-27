<?
	/**
	 * Load the eCooby mysqli.
	 *
	 * @package eCooby
	 */
	$config = array('host' => '', 'user' => '', 'password' => '', 'database' => ''); // Mysqli configuration

    $mysqli = @new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
    if (mysqli_connect_errno()) {
    	echo "Подключение невозможно: ".mysqli_connect_error();
    }

	$mysqli->query("SET CHARACTER SET 'utf8'");
	$mysqli->query("set character_set_client='utf8'");
	$mysqli->query("set character_set_results='utf8'");
	$mysqli->query("set collation_connection='utf8_general_ci'");
	$mysqli->query("SET NAMES utf8");
