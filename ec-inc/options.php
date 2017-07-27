<?php 
	function ec_get($mysqli, $section, $op_name) {
		if($section == 'settings') {
			if($result = $mysqli->query("SELECT * FROM `ec_settings` WHERE `op_name` = '$op_name'")) {
				$row = $result->fetch_assoc();
				if(strlen($row['id']) > 0) return $row['value'];
			}
		} elseif($section == 'title') {
			if($result = $mysqli->query("SELECT * FROM `ec_pages_title` WHERE `url` = '$op_name' AND `type` = '0'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) return $row['title'];
				else return 'error';
			}
		} elseif($section == 'title_page') {
			if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `url` = '$op_name' AND `hide` = '0'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) return $row['title'];
				else return 'Error';
			}
		} elseif($section == 'title_post') {
			if($result = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$op_name' AND `hide` = '0'")) {
				$row = $result->fetch_assoc();
				if($row['id'] > 0) return $row['title'];
				else return 'Error';
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

	function setLink($link) {
		return str_replace('#', '%23', $link);
	}