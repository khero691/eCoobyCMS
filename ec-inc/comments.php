<?php
	if($_GET['post_id']) {
		require('load.php');
		$template = ec_get($mysqli, 'settings', 'template');
		$post_id = clear($mysqli, $_GET['post_id']);
		$email = clear($mysqli, $_GET['email']);
		$message = clear($mysqli, $_GET['message']);
		$name = clear($mysqli, $_GET['name']);
		$type = clear($mysqli, $_GET['type']);
		if(ec_get($mysqli, 'settings', 'reg_comment') == 0) {
			$ec_comment_f = file_get_contents("../ec-tpl/{$template}/contents/overall/comment.tpl");

			$ec_comment_f = str_replace('%{comment text}%', $message, $ec_comment_f);
			$ec_comment_f = str_replace('%{comment name}%', $name, $ec_comment_f);
			$ec_comment_f = str_replace('%{comment email}%', $email, $ec_comment_f);
			$ec_avatar_f = '';
			$ec_comment_f = str_replace('%{comment avatar}%', $ec_avatar_f, $ec_comment_f);
			$ec_comment_f = str_replace('%{comment link}%', '#', $ec_comment_f);

			$time = time();
			$mysqli->query("INSERT INTO `ec_comments` VALUES (NULL, '$type', '$post_id', '$message', '$email', '$name', '$time', '', '0')");
			echo $ec_comment_f;
		}
	}