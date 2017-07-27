<?php 
	function admin_ec($mysqli) {

		$ec_page = clear($mysqli, $_GET['a_ec']);
		$ec_id = clear($mysqli, $_GET['id']);
		$ec_s = clear($mysqli, $_GET['s']);

		$template = ec_get($mysqli, 'settings', 'template');

		if($_COOKIE['userId'] && $_COOKIE['access_hash']) {
			if(isHash($mysqli, $_COOKIE['access_hash']) != 'success') {
				setcookie('access_hash', '', time()-24*3600, '/');
				setcookie('userId', '', time()-24*3600, '/');
				echo '<script>location.reload()</script>';
			}

			if(file_exists("./application/contents/{$ec_page}/content.tpl")) {
				$ec_file = file_get_contents("./application/template.tpl");
				if($ec_id == 'new' || $ec_id == 'show' || $ec_id == 'edit' || $ec_id == 'del') {
					if(file_exists("./application/contents/{$ec_page}/{$ec_id}.tpl")) $ec_cont_f = file_get_contents("./application/contents/{$ec_page}/{$ec_id}.tpl");
					else $ec_cont_f = file_get_contents("./application/contents/overall/404.tpl");
				} elseif($ec_id == 'info') {
					if(file_exists("./application/contents/{$ec_page}/{$ec_id}.tpl")) $ec_cont_f = file_get_contents("./application/contents/{$ec_page}/{$ec_id}.tpl");
					else $ec_cont_f = file_get_contents("./application/contents/overall/404.tpl");
				} else $ec_cont_f = file_get_contents("./application/contents/{$ec_page}/content.tpl");
				$ec_header_f = file_get_contents("./application/contents/overall/header.tpl");
				$ec_footer_f = file_get_contents("./application/contents/overall/footer.tpl");
				$ec_navbar_f = file_get_contents("./application/contents/overall/navbar.tpl");
			} else {
				$ec_page = 'index';
				$ec_file = file_get_contents("./application/template.tpl");
				$ec_cont_f = file_get_contents("./application/contents/{$ec_page}/content.tpl");
				$ec_header_f = file_get_contents("./application/contents/overall/header.tpl");
				$ec_footer_f = file_get_contents("./application/contents/overall/footer.tpl");
				$ec_navbar_f = file_get_contents("./application/contents/overall/navbar.tpl");
			}
		} else {
			$ec_page = 'auth';
			$ec_file = file_get_contents("./application/signin.tpl");
			$ec_cont_f = '';
			$ec_header_f = '';
			$ec_footer_f = '';
			$ec_navbar_f = '';
		}

		if($ec_page == 'posts') {
			if(!$ec_id) {
				if($result = $mysqli->query("SELECT * FROM `ec_news` ORDER BY `id`")) {
					unset($postsTr);
					do {

						if($row['id'] > 0 && $row['hide'] == 0) {
							$ec_posts_tr_f = file_get_contents("./application/contents/overall/tr.tpl");
							$ec_posts_tr_f = str_replace('%{ec_admin tr id}%', $row['id'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr title}%', $row['title'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr link_1}%', '/post&id='.$row['id'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr link_2}%', '/ec-admin/profile&id='.getU($mysqli, array('id' => $row['author_id'], 'option' => 'name')), $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr link_3}%', '/ec-admin/posts&id=edit&s='.$row['id'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr link_4}%', '/ec-admin/posts&id=del&s='.$row['id'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr link_5}%', '/ec-admin/posts&id=info&s='.$row['id'], $ec_posts_tr_f);
							$ec_posts_tr_f = str_replace('%{ec_admin tr desc}%', getU($mysqli, array('id' => $row['author_id'], 'option' => 'name')), $ec_posts_tr_f);
							$postsTr .= $ec_posts_tr_f;
						}

					} while ($row = $result->fetch_assoc());
					
				}
			} elseif($ec_id == 'new') {
				if($result = $mysqli->query("SELECT * FROM `ec_categorys` ORDER BY `id`")) {
					unset($ec_categorys);
					do {

						if($row['id'] > 0) {
							$ec_categorys .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
						}

					} while ($row = $result->fetch_assoc());
				}

			} elseif($ec_id == 'info') {
				if($result = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin post info date}%', date('j', $row['time']).'/'.date('m', $row['time']).'/'.date('Y', $row['time']).' '.date('H', $row['time']).':'.date('i', $row['time']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post info author_name}%', getU($mysqli, array('id' => $row['author_id'], 'option' => 'name')), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post info views}%', getViews($mysqli, $row['id'], 'post'), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post info category}%', getNewCateg($mysqli, $row['category']), $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			} elseif($ec_id == 'edit') {
				if($result = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin post edit id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post edit title}%', $row['title'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post edit sdesc}%', $row['sdesc'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post edit fdesc}%', $row['fdesc'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			} elseif($ec_id == 'del') {
				if($result = $mysqli->query("SELECT * FROM `ec_news` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin post del id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin post del title}%', $row['title'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			}
		} else if($ec_page == 'pages') {
			if(!$ec_id) {
				if($result = $mysqli->query("SELECT * FROM `ec_pages` ORDER BY `id`")) {
					unset($postsTr);
					do {

						if($row['id'] > 0 && $row['hide'] == 0) {
							$ec_pages_tr_f = file_get_contents("./application/contents/overall/tr.tpl");
							$ec_pages_tr_f = str_replace('%{ec_admin tr id}%', $row['id'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr title}%', $row['title'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr link_1}%', '/page&id='.$row['url'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr link_2}%', '/page&id='.$row['url'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr link_3}%', '/ec-admin/pages&id=edit&s='.$row['id'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr link_4}%', '/ec-admin/pages&id=del&s='.$row['id'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr link_5}%', '/ec-admin/pages&id=info&s='.$row['id'], $ec_pages_tr_f);
							$ec_pages_tr_f = str_replace('%{ec_admin tr desc}%', '/page&id='.$row['url'], $ec_pages_tr_f);
							$pagesTr .= $ec_pages_tr_f;
						}

					} while ($row = $result->fetch_assoc());
					
				}
			} elseif($ec_id == 'info') {
				if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin page info date}%', date('j', $row['time']).'/'.date('m', $row['time']).'/'.date('Y', $row['time']).' '.date('H', $row['time']).':'.date('i', $row['time']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page info author_name}%', getU($mysqli, array('id' => $row['author_id'], 'option' => 'name')), $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			} elseif($ec_id == 'edit') {
				if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin page edit id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page edit title}%', $row['title'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page edit content}%', htmlspecialchars($row['content']), $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page edit url}%', $row['url'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			} elseif($ec_id == 'del') {
				if($result = $mysqli->query("SELECT * FROM `ec_pages` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin page del id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page del title}%', $row['title'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin page del url}%', $row['url'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			}
		} else if($ec_page == 'nav') {
			if(!$ec_id) {
				if($result = $mysqli->query("SELECT * FROM `ec_navigation_items` ORDER BY `id` AND `hide` = '0'")) {
					unset($postsTr);
					do {

						if($row['id'] > 0 && $row['hide'] == 0) {
							$ec_nav_tr_f = file_get_contents("./application/contents/overall/tr.tpl");
							$ec_nav_tr_f = str_replace('%{ec_admin tr id}%', $row['id'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr title}%', $row['text'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr link_1}%', $row['url'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr link_2}%', $row['url'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr link_3}%', '/ec-admin/nav&id=edit&s='.$row['id'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr link_4}%', '/ec-admin/nav&id=del&s='.$row['id'], $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr link_5}%', '#', $ec_nav_tr_f);
							$ec_nav_tr_f = str_replace('%{ec_admin tr desc}%', $row['url'], $ec_nav_tr_f);
							$navTr .= $ec_nav_tr_f;
						}

					} while ($row = $result->fetch_assoc());
				}
			} elseif($ec_id == 'edit') {
				if($result = $mysqli->query("SELECT * FROM `ec_navigation_items` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin nav edit id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin nav edit title}%', $row['text'], $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin nav edit url}%', $row['url'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			} elseif($ec_id == 'del') {
				if($result = $mysqli->query("SELECT * FROM `ec_navigation_items` WHERE `id` = '$ec_s' AND `hide` = '0'")) {
					$row = $result->fetch_assoc();
					if($row['id'] > 0) {
						$ec_cont_f = str_replace('%{ec_admin nav del id}%', $ec_s, $ec_cont_f);
						$ec_cont_f = str_replace('%{ec_admin nav del title}%', $row['text'], $ec_cont_f);
					} else {
						echo '<script>history.back();</script>';
					}
				}
			}
		} else if($ec_page == 'mods') {
			if(!$ec_id) {
				unset($i);
				unset($modulesTr);
				if ($ecMods = opendir('../ec-modules/')) {
				    while (false !== ($file = readdir($ecMods))) {
				    	if($file !== '.' && $file !== '..') {
			    			if(getFileExpansion($file) == 'php') {
			    				$i++;
								$ec_module_tr_f = file_get_contents("./application/contents/overall/tr.module.tpl");
								$ec_module_tr_f = str_replace('%{ec_admin tr id}%', $i, $ec_module_tr_f);
								$ec_module_tr_f = str_replace('%{ec_admin tr module_name}%', $file, $ec_module_tr_f);
								$ec_module_tr_f = str_replace('%{ec_admin tr link_1}%', '#', $ec_module_tr_f);
								$ec_module_tr_f = str_replace('%{ec_admin tr link_2}%', 'javascript:delModule(\''.base64_encode($file).'\', \''.$i.'\')', $ec_module_tr_f);
								$ec_module_tr_f = str_replace('%{ec_admin tr id}%', $i, $ec_module_tr_f);
								$modulesTr .= $ec_module_tr_f;
			    			}
				    	}
				    }
				    closedir($ecMods); 
				}
			}
		} else if($ec_page == 'index') {
			if(!$ec_id) {
				unset($tpl_item);
				$path="../ec-tpl/";
				$dir = opendir($path);
				if(readdir($dir) != false) {
					foreach (scandir("../ec-tpl/") as $v) {
				   		if($v == '.' || $v == '..') continue;
				   		if($template != $v) $tpl_item .= '<option value="'.$v.'">'.$v.'</option>';
				   		else $tpl_item .= '<option value="'.$v.'" selected>'.$v.'</option>';
					} closedir($dir);
				}	
			} else header("Location: /ec-admin/");
		} else if($ec_page == 'profile') {
			if($ec_id) {
				if($result = $mysqli->query("SELECT * FROM `ec_users` ORDER BY `id`")) {
					unset($admin_page);
					do {
						if($row['id'] > 0 && strlen(isAdmin($mysqli, $row['id'])) > 0) {
							$ec_cont_f = str_replace('%{ec_admin profile_view name}%', $row['name'], $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view reg_ip}%', $row['registration_ip'], $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view avatar}%', getU($mysqli, array('id' => $row['id'], 'option' => 'avatar')), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view level}%', isAdmin($mysqli, $row['id']), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view reg_date}%', getCreateDate($row['registration_date']), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view country}%', adminInfo($mysqli, array('id' => $row['id'], 'option' => 'country')), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view specialization}%', adminInfo($mysqli, array('id' => $row['id'], 'option' => 'specialization')), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view about}%', adminInfo($mysqli, array('id' => $row['id'], 'option' => 'about')), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view email}%', adminInfo($mysqli, array('id' => $row['id'], 'option' => 'email')), $ec_cont_f);
							$ec_cont_f = str_replace('%{ec_admin profile_view vk_id}%', adminInfo($mysqli, array('id' => $row['id'], 'option' => 'vk_id')), $ec_cont_f);
						}

					} while ($row = $result->fetch_assoc());
				}	
			} else header("Location: /ec-admin/");
		}


		$ec_cont_f = str_replace('%{ec_admin settings tpls}%', $tpl_item, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin categorys select}%', $ec_categorys, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin posts tr}%', $postsTr, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin pages tr}%', $pagesTr, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin nav tr}%', $navTr, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin modules tr}%', $modulesTr, $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin content navbar}%', $ec_navbar_f, $ec_cont_f);

		$ec_cont_f = str_replace('%{ec_admin cogs vk_id}%', ec_get($mysqli, 'cogs', 'vk_id'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin cogs email}%', ec_get($mysqli, 'cogs', 'email'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin cogs country}%', ec_get($mysqli, 'cogs', 'country'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin cogs specialization}%', ec_get($mysqli, 'cogs', 'specialization'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin cogs about}%', ec_get($mysqli, 'cogs', 'about'), $ec_cont_f);

		$ec_cont_f = str_replace('%{ec_admin settings title}%', ec_get($mysqli, 'settings', 'title'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin settings webtags}%', ec_get($mysqli, 'settings', 'webtags'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin settings webtags}%', ec_get($mysqli, 'settings', 'webtags'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin settings template}%', ec_get($mysqli, 'settings', 'template'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin settings license}%', ec_get($mysqli, 'settings', 'license'), $ec_cont_f);
		$ec_cont_f = str_replace('%{ec_admin settings reg_comment_check}%', getCheck(ec_get($mysqli, 'settings', 'reg_comment')), $ec_cont_f);

		$ec_cont_f = str_replace('%{ec_admin s}%', $ec_s, $ec_cont_f);
		if(!$ec_id) {
			$ec_file = str_replace('%{ec_admin title}%', ec_get($mysqli, 'title', $ec_page).' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_id == 'new') {
			if($ec_page == 'posts') {
				$ec_ttext = 'Добавить новость';
			} elseif($ec_page == 'pages') {
				$ec_ttext = 'Добавить страницу';
			} elseif($ec_page == 'nav') {
				$ec_ttext = 'Добавить пункт';
			}
			$ec_file = str_replace('%{ec_admin title}%', $ec_ttext.' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_id == 'info') {
			if($ec_page == 'posts') {
				$ec_ttext = 'Информация о новости';
			} elseif($ec_page == 'pages') {
				$ec_ttext = 'Информация о странице';
			} elseif($ec_page == 'nav') {
				$ec_ttext = 'Информация о пункте';
			}
			$ec_file = str_replace('%{ec_admin title}%', $ec_ttext.' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_id == 'edit') {
			if($ec_page == 'posts') {
				$ec_ttext = 'Редактировать новость';
			} elseif($ec_page == 'pages') {
				$ec_ttext = 'Редактировать страницу';
			} elseif($ec_page == 'nav') {
				$ec_ttext = 'Редактировать пункт';
			}
			$ec_file = str_replace('%{ec_admin title}%', $ec_ttext.' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_page == 'profile') {
			$ec_file = str_replace('%{ec_admin title}%', 'Профиль '.$ec_id.' - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		} else if($ec_page == 'auth') {
			$ec_file = str_replace('%{ec_admin title}%', 'Авторизация - '.ec_get($mysqli, 'settings', 'title'), $ec_file);
		}
		$ec_file = str_replace('%{ec_admin header}%', $ec_header_f, $ec_file);
		$ec_file = str_replace('%{ec_admin content}%', $ec_cont_f, $ec_file);
		$ec_file = str_replace('%{ec_admin footer}%', $ec_footer_f, $ec_file);
		$ec_file = str_replace('%{ec_admin version}%', EC_VERSION, $ec_file);
		$ec_file = str_replace('%{ec_admin version category}%', EC_VERSION_CATEGORY, $ec_file);
		$ec_file = str_replace('%{ec_admin year}%', date('Y'), $ec_file);
		$ec_file = str_replace('%{ec_admin lastupdate}%', date('j', ec_get($mysqli, 'settings', 'update')).'/'.date('m', ec_get($mysqli, 'settings', 'update')).'/'.date('Y', ec_get($mysqli, 'settings', 'update')).' '.date('H', ec_get($mysqli, 'settings', 'update')).':'.date('i', ec_get($mysqli, 'settings', 'update')), $ec_file);
		$ec_file = str_replace('%{ec_admin domain}%', $_SERVER['SERVER_NAME'], $ec_file);
		$ec_file = str_replace('%{ec_admin license}%', ec_get($mysqli, 'settings', 'license'), $ec_file);
		$ec_file = str_replace('%{ec_admin profile login}%', getU($mysqli, array('id' => $_COOKIE['userId'], 'option' => 'name')), $ec_file);
		$ec_file = str_replace('%{ec_admin profile avatar}%', getU($mysqli, array('id' => $_COOKIE['userId'], 'option' => 'avatar')), $ec_file);

		echo $ec_file;
	}