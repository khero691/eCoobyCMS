<div class="box">
		<div class="box-category"><a href="#">%{ec_post category}%</a></div>
		<div class="box-date"><a href="#">%{ec_post time}%</a></div>
		<div class="box-title"><div style="float: right; font-size: 13px; color: #acadb6; font-weight: 400;"><span title="Автор"><i class="fa fa-user"></i> %{ec_post author_name}%</span> | <span title="Просмотров"><i class="fa fa-eye"></i> %{ec_post views}%</span></div>%{ec_post title}%</div>
		<div class="box-divider"></div>
		<div class="box-body">
			<p>%{ec_post fdesc}%</p>
		</div>
		<div class="box-footer post-footer">
			<div class="box-tag">
				<ul>
					%{ec_post tags}%
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="box-divider"></div>
		<div class="box-comments">
			<p class="comments" id="comments">
				<div class="form">
					<span class="message"></span>
					<input type="text" id="name" name="yourname" class="halfinput" placeholder="Ваше имя">
					<input type="email" id="email" name="email" class="halfinput" placeholder="Ваш email адрес">
					<textarea cols="20" name="message" id="comment" rows="5" class="halfinput" placeholder="Сообщение"></textarea>
					<button type="button" id="btn_com" onclick="comment('%{ec_post id}%', 'email', 'name', 'comment', '1');" class="btn btn-main">Ответить</button>
				</div>
			</p>
			<div id="cbox">
				%{ec_post comments}%
			</div>
		</div>
	</div>
</div>