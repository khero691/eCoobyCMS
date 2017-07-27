<?php
	//Инициализирует сеанс
	$connection = curl_init();
	//Устанавливаем адрес для подключения, по умолчанию методом GET
	$qu = base64_encode('Admin1');
	$query = $_SERVER['REQUEST_URI'];

	$query = str_replace('/ec-admin/test.php', '', $query);
//	echo $query;
	curl_setopt($connection, CURLOPT_URL, "http://blog.cooby.ru/ec-admin/include/update.php".$query);
	//Выполняем запрос
	curl_exec($connection);
	//Завершает сеанс
	curl_close($connection);