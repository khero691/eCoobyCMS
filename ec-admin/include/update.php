<?php 
	if($_GET['op']) {
		session_start();
		header('Content-Type: text/html; charset=utf-8', true);

		require('../../ec-inc/config.php' );
		
		require( dirname( __FILE__ ) . '/options.php' );
		$op = clear($mysqli, $_GET['op']);
		if($op == 'setting') {
			$s = clear($mysqli, $_GET['s']);
			$id = clear($mysqli, $_GET['id']);
			if($result = $mysqli->query("SELECT * FROM `ec_settings` WHERE `op_name` = '$id'")) {
				$row = $result->fetch_assoc();
				if(strlen($row['id']) > 0) {
					$mysqli->query("UPDATE `ec_settings` SET `value` = '$s' WHERE `op_name` = '$id'");
				} else echo 'error';
			} else echo 'error';
		} elseif($op == 'cogs') {
			$s = clear($mysqli, $_GET['s']);
			$id = clear($mysqli, $_GET['id']);
			$u_id = $_COOKIE['userId'];
			if($result = $mysqli->query("SELECT * FROM `ec_admins` WHERE `user_id` = '$u_id'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) {
					if(!$mysqli->query("UPDATE `ec_admins` SET `$id` = '$s' WHERE `user_id` = '$u_id'")) {
						echo 'error';
					} else echo 'success';
				} else echo 'error';
			} else echo 'error';
		} elseif($op == 'addPost') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			$items = explode("/*/*/", $s);
			$title = $items[0];
			$sdesc = $items[1];
			$fdesc = $items[2];
			$categ = $items[4];
			$author_id = $_COOKIE['userId'];
			$time = time();
			if($mysqli->query("INSERT INTO `ec_news` VALUES (NULL, '$title', '$sdesc', '$fdesc', '$author_id', 'no image', '$time', '$categ', '0')")) {
				$tags = explode(",", $items[3]);
				for ($i=0; $i < count($tags); $i++) {
					new_tag($mysqli, $tags[$i], $time, '1');
				}
				echo 'Новость успешно добавлена.';
			} else echo 'Ошибка при отправлении формы.';
		} elseif($op == 'addPage') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			$items = explode("/*/*/", $s);
			$title = $items[0];
			$content = $items[1];
			$url = $items[2];
			$author_id = $_COOKIE['userId'];
			$time = time();
			if($mysqli->query("INSERT INTO `ec_pages` VALUES (NULL, '$url', '$title', '$content', '$time', '$author_id', '0')")) {
				echo 'Страница успешно добавлена.';
			} else echo 'Ошибка при отправлении формы.';
		} elseif($op == 'addNav') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			$items = explode("/*/*/", $s);
			$title = $items[0];
			$url = $items[1];
			if($mysqli->query("INSERT INTO `ec_navigation_items` VALUES (NULL, '$title', '$url', '0')")) {
				echo 'Пункт навигации успешно добавлен.';
			} else echo 'Ошибка при отправлении формы.';
		} elseif($op == 'getAvatar') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			if($result = $mysqli->query("SELECT * FROM `ec_users` WHERE `name` = '$s'")) {
				$row = $result->fetch_assoc();
				if($row['name'] === $s) {
					if(strlen($row['avatar']) == 0) {
						echo 'http://ecooby.ru/api/no_user.jpg';
					} else echo $row['avatar'];
				} else echo 'error';
			} else echo 'error';
		} elseif($op == 'admin_auth') {
			$login = clear($mysqli, $_GET['login']);
			$password = clear($mysqli, $_GET['password']);
			if($result = $mysqli->query("SELECT * FROM `ec_users` WHERE `name` = '$login'")) {
				$row = $result->fetch_assoc();
				if($row['password'] == md5($password) && $row['name'] === $login) {
					echo $row['id'];
				} else echo 'error_pass';
			} else echo 'error';
		} elseif($op == 'getPage') {
			$s = clear($mysqli, $_GET['s']);
			if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `url` = '$s'")) {
				$row = $result->fetch_assoc();
				if(!$row['id'] > 0) {
					echo 'null';
				} else echo $row['id'];
			} else echo 'error query';
		} elseif($op == 'getPass') {
			$s = clear($mysqli, $_GET['s']);
			$id = $_COOKIE['userId'];
			if($result = $mysqli->query("SELECT * FROM `ec_users` WHERE `id` = '$id'")) {
				$row = $result->fetch_assoc();
				if($row['password'] == md5($s)) {
					echo 'success';
				} else echo 'error';
			} else echo 'error query';
		} elseif($op == 'setPass') {
			$s = clear($mysqli, $_GET['s']);
			$id = $_COOKIE['userId'];
			if($result = $mysqli->query("SELECT * FROM `ec_users` WHERE `id` = '$id'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) {
					$s = md5($s);
					if($mysqli->query("UPDATE `ec_users` SET `password` = '$s' WHERE `id` = '$id'")) {
						echo 'success';
					} else echo 'error';
				} else echo 'error';
			} else echo 'error';
		} elseif($op == 'delModule') {
			$s = base64_decode(clear($mysqli, $_GET['s']));
			$id = $_COOKIE['userId'];
			$hash = $_COOKIE['access_hash'];
			if(isHash($mysqli, $hash) == 'success') {
				if(unlink('../../ec-modules/'.$s)) echo 'success';
				else echo 'error';
			} else echo 'error';
		} elseif($op == 'editNav') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			$items = explode("/*/*/", $s);
			$text = $items[0];
			$url = $items[1];
			$id = $items[2];
			if($mysqli->query("UPDATE `ec_navigation_items` SET `text` = '$text', `url` = '$url' WHERE `id` = '$id'")) {
				echo 'Изменения успешно сохранены.';
			} else echo 'error';
		} elseif($op == 'editPost') {
			$s = clear($mysqli, $_GET['s']);
			$s = base64_decode($s);
			$items = explode("/*/*/", $s);
			$title = $items[0];
			$sdesc = $items[1];
			$fdesc = $items[2];
			$id = $items[3];
			if($mysqli->query("UPDATE `ec_news` SET `title` = '$title', `sdesc` = '$sdesc', `fdesc` = '$fdesc' WHERE `id` = '$id'")) {
				echo 'Изменения успешно сохранены.';
			} else echo 'error';
		} elseif($op == 'delPost') {
			$id = clear($mysqli, $_GET['id']);
			if($mysqli->query("UPDATE `ec_news` SET `hide` = '1' WHERE `id` = '$id'")) {
				echo 'success';
			} else echo 'error';
		} elseif($op == 'delPage') {
			$id = clear($mysqli, $_GET['id']);
			if($mysqli->query("UPDATE `ec_pages` SET `hide` = '1' WHERE `id` = '$id'")) {
				echo 'success';
			} else echo 'error';
		} elseif($op == 'delNav') {
			$id = clear($mysqli, $_GET['id']);
			if($mysqli->query("UPDATE `ec_navigation_items` SET `hide` = '1' WHERE `id` = '$id'")) {
				echo 'success';
			} else echo 'error';
		} else echo 'error';
	} else echo 'no request';