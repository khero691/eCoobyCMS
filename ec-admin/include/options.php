<?php 
	function ec_get($mysqli, $section, $op_name) {
		if($section == 'settings') {
			if($result = $mysqli->query("SELECT * FROM `ec_settings` WHERE `op_name` = '$op_name'")) {
				$row = $result->fetch_assoc();
				if(strlen($row['value']) > 0) return $row['value'];
			}
		} elseif($section == 'cogs') {
			if($_COOKIE['userId']) {
				$id = $_COOKIE['userId'];
				if($result = $mysqli->query("SELECT * FROM `ec_admins` WHERE `user_id` = '$id'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) return $row[$op_name];
				}
			}
		} elseif($section == 'title') {
			if($result = $mysqli->query("SELECT * FROM `ec_pages_title` WHERE `url` = '$op_name' AND `type` = '1'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) return $row['title'];
				else return 'error';
			}
		} else return 'error';
	}

	function clear($mysqli, $result) {
		$result = strip_tags($result);
		$result = htmlspecialchars($result);
		$result = mysqli_real_escape_string($mysqli, $result);
		return $result;
	}

	function getFileExpansion($filename) {
    	return substr($filename, strrpos($filename, '.') + 1);
  	}

	function getCreateTime($time) {
		$CreateTime = array('day' => date('d', $time), 'month' => date('m', $time), 'year' => date('Y', $time), 'hour' => date('H', $time), 'minute' => date('i', $time));
		if(date('d', time()) == $CreateTime['day']) $date = 'Сегодня';
		else $date = $CreateTime['day'].'/'.$CreateTime['month'].'/'.$CreateTime['year'];

		return $CreateTime['hour'].':'.$CreateTime['minute'].'<br>'.$date;
	}


	function getCreateDate($time) {
		$CreateDate = array('day' => date('d', $time), 'month' => date('m', $time), 'year' => date('Y', $time));
		$date = $CreateDate['day'].'/'.$CreateDate['month'].'/'.$CreateDate['year'];

		return $date;
	}
	function new_view($mysqli, $id, $type) {
		if($type == 'post') $type = '1';
		elseif($type == 'page') $type = '2';
		elseif($type == 'blog') $type = '3';
		if($id > 0) {
			if($result = $mysqli->query("SELECT * FROM `ec_page_views` ORDER BY `id`")) {
				$i = 0;
				$adress = $_SERVER["REMOTE_ADDR"];
				do {
					if($row['object_id'] == $id && $row['type'] == $type && $row['ip'] == $adress) $i++;
				} while ($row = $result->fetch_assoc());

				if($i == 0) $mysqli->query("INSERT INTO `ec_page_views` VALUES (NULL, '$type', '$id', '$adress')");
				
			}
		}
	}

	function getViews($mysqli, $id, $type) {
		if($type == 'post') $type = '1';
		elseif($type == 'page') $type = '2';
		elseif($type == 'blog') $type = '3';
		if($id > 0) {
			if($result = $mysqli->query("SELECT * FROM `ec_page_views` ORDER BY `id`")) {
				$i = 0;
				$adress = $_SERVER["REMOTE_ADDR"];
				do {
					if($row['object_id'] == $id && $row['type'] == $type && $row['ip'] == $adress) $i++;
				} while ($row = $result->fetch_assoc());

				return $i;
				
			}
		}
	}

	function getNewCateg($mysqli, $id) {
		if($result = $mysqli->query("SELECT * FROM `ec_categorys` WHERE `id` = '$id'")) {
			$row = $result->fetch_assoc();

			if($row['id']) return $row['name'];
			else return '#111';
			
		}
	}
	
	define('ecUpg', 'aHR0cDovL2Vjb29ieS5ydS9hcGkvdXBncmFkZS5waHA=');

	function getU($mysqli, $array) {
		$id = $array['id']; $option = $array['option'];
		if($result = $mysqli->query("SELECT * FROM `ec_users` WHERE `id` = '$id'")) {
			$row = $result->fetch_assoc();
			if($option != 'avatar') {
				if($row[$option]) return $row[$option];
				else return '#112';
			} else {
				if(strlen($row[$option]) == 0) {
					return 'http://ecooby.ru/api/no_user.jpg';
				} else return $row[$option];
			}
		}
	}

	function adminInfo($mysqli, $array) {
		$id = $array['id']; $option = $array['option'];
		if($result = $mysqli->query("SELECT * FROM `ec_admins` WHERE `user_id` = '$id'")) {
			$row = $result->fetch_assoc();

			if($row[$option]) return $row[$option];
			else return '#112';
			
		}
	}

	function setLink($link) {
		return str_replace('#', '%23', $link);
	}

	function getCheck($i) {
		if($i == '1') $t = 'checked';
		else $t = '';
		return $t;
	}

	function isAdmin($mysqli, $id) {
		if($result = $mysqli->query("SELECT * FROM `ec_admins` WHERE `user_id` = '$id'")) {
			$row = $result->fetch_assoc();

			if($row['id'] > 0) {

				return $row['level'];

			}
			
		}
	}

	function new_tag($mysqli, $tag, $time, $type) {
		$result = $mysqli->query("SELECT * FROM `ec_news` WHERE `time` = '$time'");
		$row = $result->fetch_assoc();
		if($row['id'] > 0) {
			$post_id = $row['id'];
			$tag = '#'.$tag;
			$result = $mysqli->query("SELECT * FROM `ec_tags` WHERE `tag` = '$tag' AND `post_id` = '$post_id'");
			$row = $result->fetch_assoc();
			if(!$row['id'] > 0) {
				$mysqli->query("INSERT INTO `ec_tags` VALUES (NULL, '$type', '$post_id', '$tag')");
			}
		}
	}

	function isHash($mysqli, $hash) {
		$result = $mysqli->query("SELECT * FROM `ec_users` ORDER BY `id`");
		unset($h);
		do {
			if(md5($row['id'].'-'.$row['name'].'-'.$row['password']) == $hash) return 'success';
			else $h++;
		} while ($row = $result->fetch_assoc());
		if($h > 0) return 'error';
	}
