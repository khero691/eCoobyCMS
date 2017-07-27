function search(search) {
	var val = $("#" + search).val();
	function clean() {
		$('.message')
			.animate({opacity: 0, top: '45%'}, 200,
			function(){ 
				
			}
		);
	}
	if(val.length > 0) {
		$("#load").html("<center><img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\"></center>");
		val = val.replace('#', '%23');
		$.ajax({
			url: "../ec-inc/search-engine.php?s=" + val, 
			cache: false,   
			success: function(data) {   
				//location.reload();
				$("#result").html(data);
			}

		}); 
	} else {
		$('.message')
			.animate({opacity: 100, top: '45%'}, 400,
			function(){ 
				
			}
		);
		setTimeout(clean, 2000);
	}
}

function check_mail(mail){
    mail = (mail != undefined) ? mail : '';
    var reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
    if (!mail.match(reg)) return false;
    
    return true;
}

function comment(post_id, email_i, name_i, message_i, type) {
	function clean() {
		$('.message')
			.animate({opacity: 0, top: '45%'}, 200,
			function(){ 
				$('.message').html('');
			}
		);
	}
	var email = $('#' + email_i).val();
	var name = $('#' + name_i).val();
	var message = $('#' + message_i).val();
	var check = $('#' + email_i).val();
	if(post_id.length > 0 && email.length > 0 && name.length > 0 && message.length > 0) {
    	if(check_mail(check)) {
			$('#btn_com').prop('disabled',true);
			$('#cbox').prepend("<div id=\"load_comment\"><center><img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\"></center>");
			$('#' + email_i).val('');
			$('#' + name_i).val('');
			$('#' + message_i).val('');
			$.ajax({
				url: "../ec-inc/comments.php?func=new&post_id=" + post_id + "&email=" + email + "&name=" + name + "&message=" + message + "&type=" + type, 
				cache: false,   
				success: function(data) {
					$('#cbox').prepend(data);
					$('#btn_com').prop('disabled',false);
					$('div#load_comment').remove();
					$('#nocomments').remove();
					$('#comments')
						.animate({opacity: 0, top: '45%'}, 400,
						function(){ 
							$('.form').remove();
							$('#comments')
								.animate({opacity: 100, top: '45%'}, 400,
								function(){ 
									$('#comments').html('<div id="send_mess"><center><p>Спасибо за ответ! <a href="javascript:new_comment()">Написать ещё</a>.</p></center></div>');
								}
							);
						}
					);
				}

			}); 
		} else {
			$('.message')
				.animate({opacity: 100, top: '45%'}, 400,
				function(){ 
					$('.message').html('<center><font color="#ed4845">Email введен не верно!</font></center><br>');
				}
			);
			setTimeout(clean, 3000);
		}
	} else {
		$('.message')
			.animate({opacity: 100, top: '45%'}, 400,
			function(){ 
				$('.message').html('<center><font color="#ed4845">Заполните все поля для ввода!</font></center><br>');
			}
		);
		setTimeout(clean, 3000);
	}
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function new_comment() {
	$('#comments')
		.animate({opacity: 0, top: '45%'}, 400,
		function() { 
			$('#send_mess').remove();
			$('#comments')
				.animate({opacity: 100, top: '45%'}, 400,
				function() { 
					var id = getUrlVars()['id'].replace('#', '');
					id = id.replace('+', '');
					id = id.replace('-', '');
					id = id.replace('?', '');
					id = id.replace('&', '');
					$('#comments').html('<div class="form"><span class="message"></span><input type="text" id="name" name="yourname" class="halfinput" placeholder="Ваше имя"><input type="email" id="email" name="email" class="halfinput" placeholder="Ваш email адрес"><textarea cols="20" name="message" id="comment" rows="5" class="halfinput" placeholder="Сообщение"></textarea><button type="button" id="btn_com" onclick="comment(\'' + id + '\', \'email\', \'name\', \'comment\', \'1\');" class="btn btn-main">Ответить</button></div>');
				}
			);
		}
	);
}

$(document).ready(function() {
	var menuOpen = 0;
    var ww = document.body.clientWidth;
    $(".header-nav li a").each(function() {
        if ($(this).next().length > 0) {
            $(this).addClass("parent");
        };
    });
    if (ww < 800) {
        $(".toggleMenu").css("display", "inline-block");
        $(".header-nav").css("display", "none");
        $(".toggleMenu").click(function() {
        	if(menuOpen == 0) {
        		$(".deviceNav").css("display", "block");
        		menuOpen = 1;
        	} else {
        		$(".deviceNav").css("display", "none");
        		menuOpen = 0;
        	}
	    });
    } else {
        $(".toggleMenu").css("display", "none");
        $(".header-nav").css("display", "block");
    }
});