<?php
	if(isset($_GET['s'])) {
		require('load.php');
		$s = clear($mysqli, $_GET['s']);
		if($result = $mysqli->query("SELECT * FROM `ec_news` ORDER BY `id` DESC")) {
			unset($i);
			unset($x);
			do {
				$y = strlen($s);
				if($row['id'] > 0 && (preg_match("/".$s."/i", $row['sdesc']) || preg_match("/".$s."/i", $row['fdesc']) || preg_match("/".$s."/i", $row['title']))) {
					if(strlen($i) > 0) $i .= ','.$row['id'];
					else $i .= $row['id'];
					$x++;
				}

			} while ($row = $result->fetch_assoc());
			if($x == 0) {
				if($res = $mysqli->query("SELECT * FROM `ec_tags` ORDER BY `id` DESC")) {
					unset($i);
					unset($x);
					do {
						$s = str_replace('%23', '#', $s);
						if($r['id'] > 0 && $r['tag'] == $s) {
							if(strlen($x) > 0) $x .= ','.$r['id'];
							else $x .= $r['post_id'];
						}

					} while ($r = $res->fetch_assoc());
				}
			}
			if(strlen($i) > 0) $array = explode(',', $i);
			else if(strlen($x) > 0) $array = explode(',', $x);

			$template = ec_get($mysqli, 'settings', 'template');
			unset($res);
			if($array[0] > 0) {
				for ($i=0; $i < count($array); $i++) {
					$cont_file = file_get_contents("../ec-tpl/{$template}/contents/index/new.item.tpl");
					$post_id = $array[$i];
					if($query = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$post_id'")) {
						$row1 = $query->fetch_assoc();
						$cont_file = str_replace('%{ec_content news id}%', $row1['id'], $cont_file);
						$cont_file = str_replace('%{ec_content news title}%', $row1['title'], $cont_file);
						$cont_file = str_replace('%{ec_content news img}%', $row1['image_url'], $cont_file);
						$cont_file = str_replace('%{ec_content news sdesc}%', $row1['sdesc'], $cont_file);
						$cont_file = str_replace('%{ec_content news time}%', getCreateTime($row1['time']), $cont_file);
						$cont_file = str_replace('%{ec_content news category}%', getNewCateg($mysqli, $row1['category']), $cont_file);

						if($query = $mysqli->query("SELECT * FROM `ec_tags` ORDER BY `id`")) {
							do {

								if($is['post_id'] == $row1['id']) {
									$ec_tag_item_f = file_get_contents("../ec-tpl/{$template}/contents/overall/tag.li.tpl");
									$ec_tag_item_f = str_replace('%{ec_tag item}%', $is['tag'], $ec_tag_item_f);
									$ec_tag_item_f = str_replace('%{ec_tag link}%', setLink($is['tag']), $ec_tag_item_f);
									$ec_tag_item .= $ec_tag_item_f;
								}

							} while ($is = $query->fetch_assoc());
						}
						$cont_file = str_replace('%{ec_content news tags}%', $ec_tag_item, $cont_file);
						unset($ec_tag_item_f);
					} $res .= $cont_file;
				}
			} else $res = '<div class="box"><center><p>Ничего не найдено!</p><p></p></center></div>';
			
			echo $res;

		} 
	}