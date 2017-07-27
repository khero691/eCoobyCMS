<?php
	if($ec_page == 'index') {

		function setPosition($i) {
			if($i == '1') $set = 'left';
			elseif($i == '2') $set = 'left';
			elseif($i == '3') $set = 'right';
			return $set;
		}

		if($result = $mysqli->query("SELECT * FROM `ec_news` ORDER BY `id` DESC")) {
			
			$itemNum = 0;

			do {

				if($row['id'] > 0 && $row['hide'] == 0) {

					if($itemNum < 3) $itemNum++;
					else $itemNum = 1;

					$ec_n_item_f = file_get_contents("./ec-tpl/{$template}/contents/index/new.item.tpl");

					$ec_n_item_f = str_replace('%{ec_content news position}%', setPosition($itemNum), $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news id}%', $row['id'], $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news title}%', $row['title'], $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news img}%', $row['image_url'], $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news sdesc}%', $row['sdesc'], $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news time}%', getCreateTime($row['time']), $ec_n_item_f);
					$ec_n_item_f = str_replace('%{ec_content news category}%', getNewCateg($mysqli, $row['category']), $ec_n_item_f);

					if($query = $mysqli->query("SELECT * FROM `ec_tags` ORDER BY `id`")) {
						unset($ec_tag_item);
						do {

							if($is['id'] > 0 && $is['post_id'] == $row['id']) {
								$ec_tag_item_f = file_get_contents("./ec-tpl/{$template}/contents/overall/tag.li.tpl");
								$ec_tag_item_f = str_replace('%{ec_tag item}%', $is['tag'], $ec_tag_item_f);
								$ec_tag_item_f = str_replace('%{ec_tag link}%', setLink($is['tag']), $ec_tag_item_f);
								$ec_tag_item .= $ec_tag_item_f;
							}

						} while ($is = $query->fetch_assoc());
					}
					$ec_n_item_f = str_replace('%{ec_content news tags}%', $ec_tag_item, $ec_n_item_f);

					unset($ec_tag_item_f);

					$ec_news .= $ec_n_item_f;

				}

			} while ($row = $result->fetch_assoc());

		}

		$ec_file = str_replace('%{ec_content news}%', $ec_news, $ec_file);
	}
?>