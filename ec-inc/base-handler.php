<?php
	function ec($mysqli) {

		$ec_page = clear($mysqli, $_GET['ec_page']);

		$template = ec_get($mysqli, 'settings', 'template');
		$vkLink = ec_get($mysqli, 'settings', 'vkLink');
		$fbLink = ec_get($mysqli, 'settings', 'fbLink');
		
		if(file_exists("./ec-tpl/{$template}/contents/{$ec_page}/content.tpl")) {
			$ec_file = file_get_contents("./ec-tpl/{$template}/template.tpl");
			$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/{$ec_page}/content.tpl");
			$ec_header_f = file_get_contents("./ec-tpl/{$template}/contents/overall/header.tpl");
		} else if($ec_page == 'page') {
			$ec_file = file_get_contents("./ec-tpl/{$template}/template.tpl");
			$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/page.tpl");
			$ec_header_f = file_get_contents("./ec-tpl/{$template}/contents/overall/header.tpl");
		} else {
			$ec_page = 'index';
			$ec_file = file_get_contents("./ec-tpl/{$template}/template.tpl");
			$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/{$ec_page}/content.tpl");
			$ec_header_f = file_get_contents("./ec-tpl/{$template}/contents/overall/header.tpl");
		}

		if($result = $mysqli->query("SELECT * FROM `ec_navigation_items` ORDER BY `id`")) {
			
			unset($headerItems);

			do {

				if($row['id'] > 0 && $row['hide'] == 0) {
					$ec_header_items_f = file_get_contents("./ec-tpl/{$template}/contents/overall/header.item.tpl");
					$ec_header_items_f = str_replace('%{header list ec_url}%', $row['url'], $ec_header_items_f);
					$ec_header_items_f = str_replace('%{header list ec_text}%', $row['text'], $ec_header_items_f);
					$headerItems .= $ec_header_items_f;
				}

			} while ($row = $result->fetch_assoc());
			
		}

		$ec_header_f = str_replace('%{header ec_items}%', $headerItems, $ec_header_f);

		$ec_file = str_replace('%{ec_header}%', $ec_header_f, $ec_file);

		$ec_slider_f = file_get_contents("./ec-tpl/{$template}/contents/overall/slider.tpl");

		$ec_footer_f = file_get_contents("./ec-tpl/{$template}/contents/overall/footer.tpl");

		$ec_cont_f = str_replace('%{ec_slider}%', $ec_slider_f, $ec_cont_f);

		if($ec_page == 'post') {
			$post_id = clear($mysqli, $_GET['id']);
			if(strlen($post_id) > 0) {
				if($result = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$post_id'")) {

					$row = $result->fetch_assoc();

					if($row['id'] > 0 && $row['hide'] == 0) {

						new_view($mysqli, $row['id'], 'post');

						$ec_cont_f = str_replace('%{ec_post id}%', $row['id'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post title}%', $row['title'], $ec_cont_f);

						if($query = $mysqli->query("SELECT * FROM `ec_tags` ORDER BY `id`")) {
							do {

								if($is['post_id'] == $row['id'] && $is['id'] > 0) {
									$ec_tag_item_f = file_get_contents("./ec-tpl/{$template}/contents/overall/tag.li.tpl");
									$ec_tag_item_f = str_replace('%{ec_tag item}%', $is['tag'], $ec_tag_item_f);
									$ec_tag_item_f = str_replace('%{ec_tag link}%', setLink($is['tag']), $ec_tag_item_f);
									$ec_tag_item .= $ec_tag_item_f;
								}

							} while ($is = $query->fetch_assoc());
						}
						$ec_cont_f = str_replace('%{ec_post tags}%', $ec_tag_item, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post image_url}%', $row['image_url'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post fdesc}%', $row['fdesc'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post author_name}%', getU($mysqli, array('id' => $row['author_id'], 'option' => 'name')), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post time}%', getCreateTime($row['time']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post category}%', getNewCateg($mysqli, $row['category']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_post views}%', getViews($mysqli, $row['id'], 'post'), $ec_cont_f);


						unset($ec_comments_f);
						unset($i);
						if($query = $mysqli->query("SELECT * FROM `ec_comments` ORDER BY `id` DESC")) {
							do {
								if($is['post_id'] == $post_id && $is['hide'] == 0 && $is['type'] == 1) {
									$i++; $ec_comment_f = file_get_contents("./ec-tpl/{$template}/contents/overall/comment.tpl");

									$ec_comment_f = str_replace('%{comment id}%', $is['id'], $ec_comment_f);
									$ec_comment_f = str_replace('%{comment text}%', $is['text'], $ec_comment_f);
									$ec_comment_f = str_replace('%{comment name}%', $is['name'], $ec_comment_f);
									$ec_comment_f = str_replace('%{comment email}%', $is['email'], $ec_comment_f);
									if(ec_get($mysqli, 'settings', 'reg_comment') == 1) {
										$ec_avatar_f = file_get_contents("./ec-tpl/{$template}/contents/overall/comment.avatar.tpl");
										$user_avatar = array('id' => $is['author_id'], 'option' => 'avatar');
										$ec_avatar_f = str_replace('%{comment avatar}%', getU($mysqli, $user_avatar), $ec_avatar_f);
										$ec_avatar_f = str_replace('%{comment link}%', '/users/'.$is['author_id'], $ec_avatar_f);
										$ec_comment_f = str_replace('%{comment link}%', '/users/'.$is['author_id'], $ec_comment_f);
									} else {
										$ec_avatar_f = '';
									}
									$ec_comment_f = str_replace('%{comment avatar}%', $ec_avatar_f, $ec_comment_f);
									$ec_comment_f = str_replace('%{comment link}%', '#', $ec_comment_f);

									$ec_comments_f .= $ec_comment_f;

								}
							} while ($is = $query->fetch_assoc());
							if($i == 0) $ec_comments_f = '<div id="nocomments"><div class="box-divider"></div><center>У этой новости пока нет ответов!</center></div>';
							$ec_cont_f = str_replace('%{ec_post comments}%', $ec_comments_f, $ec_cont_f);
						}

					} else {
						$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
						// open error 404
					}
				} else {
					$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
					// open error 404
				}
			} else {
				$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
				// open error 404
			}
		} else if($ec_page == 'page') {
			$page_id = clear($mysqli, $_GET['id']);
			if(strlen($page_id) > 0) {
				if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `url` = '$page_id'")) {

					$row = $result->fetch_assoc();

					if($row['id'] > 0 && $row['hide'] == 0) {

						new_view($mysqli, $row['id'], 'page');

						$ec_cont_f = str_replace('%{ec_page content}%', $row['content'], $ec_cont_f);

						$ec_cont_f = str_replace('%{ec_page title}%', $row['title'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_page url}%', $row['url'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_page author_name}%', $row['author_id'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_page time}%', getCreateTime($row['time']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_page template}%', $template, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_page views}%', getViews($mysqli, $row['id'], 'page'), $ec_cont_f);

					} else {
						$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
						// open error 404
					}
				} else {
					$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
					// open error 404
				}
			} else {
				$ec_cont_f = file_get_contents("./ec-tpl/{$template}/contents/overall/404.tpl");
				// open error 404
			}
		} else if($ec_page == 'search') {
			if($_GET['id']) {
				$search = clear($mysqli, $_GET['id']);
				$ec_cont_f = str_replace('%{search get}%', $search, $ec_cont_f);
			} else {
				$ec_cont_f = str_replace('%{search get}%', '', $ec_cont_f);
			}
		}

		$ec_file = str_replace('%{ec_content}%', $ec_cont_f, $ec_file);

		$ec_file = str_replace('%{ec_footer}%', $ec_footer_f, $ec_file);

		// inc modules

		if ($ecModules = opendir('ec-modules/')) {
		    while (false !== ($file = readdir($ecModules))) {
		    	if($file !== '.' && $file !== '..') {
	    			if(getFileExpansion($file) == 'php') include('ec-modules/'.$file);
		    	}
		    }
		    closedir($ecModules); 
		}

		if($ec_page != 'page' && $ec_page != 'post') {
			$ec_file = str_replace('%{ec_title}%', ec_get($mysqli, 'title', $ec_page).' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_page == 'page') {
			$ec_id = clear($mysqli, $_GET['id']);
			$ec_file = str_replace('%{ec_title}%', ec_get($mysqli, 'title_page', $ec_id).' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_page == 'post') {
			$ec_id = clear($mysqli, $_GET['id']);
			$ec_file = str_replace('%{ec_title}%', ec_get($mysqli, 'title_post', $ec_id).' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		}

		$ec_file = str_replace('%{ec_template}%', $template, $ec_file);
		$ec_file = str_replace('%{ec_vkLink}%', $vkLink, $ec_file);
		$ec_file = str_replace('%{ec_fbLink}%', $fbLink, $ec_file);

		print_r($ec_file);

	}