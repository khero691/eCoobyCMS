<? 
	session_start();
	header('Content-Type: text/html; charset=utf-8', true);

	require('../../ec-inc/config.php' );
	require('../../ec-inc/version.php' );
	
	require( dirname( __FILE__ ) . '/options.php' );

	$connection = curl_init();
	$ecUpg = base64_decode(ecUpg);
	$query = md5($_SERVER['SERVER_NAME'].'/'.ec_get($mysqli, 'settings', 'license'));

	if(curl_setopt($connection, CURLOPT_URL, $ecUpg.'?u='.$query.'&version='.EC_VERSION.'&s=getupgrade')) {
		curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec($connection);
		if($result !== EC_VERSION && $result != 'NO_NEWER_VERSION' && $result != 'HASH_NOT_CORRECT') { 
			/*if($mysqli->query("UPDATE `ec_settings` SET `value` = '$version' WHERE `op_name` = 'version'")) {
				echo 'success';
			} else echo 'error';*/
			echo 'INSTALL';
			$files = explode(', ', $result);
			unset($p);
			for ($i=0; $i < count($files); $i++) { 
				$connFile = curl_init();
				if(curl_setopt($connFile, CURLOPT_URL, $ecUpg.'?u='.$query.'&version='.EC_VERSION.'&s=getfiles&file='.base64_encode($files[$i]))) {
					curl_setopt($connFile, CURLOPT_RETURNTRANSFER, 1); 
					$file = curl_exec($connFile);
					$fp = fopen('../../'.$files[$i], 'w');
					fwrite($fp, $file); // Запись в файл
					fclose($fp);
					$p++;
				}
				curl_close($connFile);
			}
			$time = time();
			if($mysqli->query("UPDATE `ec_settings` SET `value` = '$time' WHERE `op_name` = 'update'")) {
				if($p!=0) echo 'SUCCESS';
			} else echo 'ERROR';
		} else echo 'NO_UPDATES';
	} else echo 'NO_CONNECT';
	curl_close($connection);