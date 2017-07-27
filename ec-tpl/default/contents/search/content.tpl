<div class="box">
	<div class="box-title">Поиск по сайту</div>
	<div class="box-divider"></div>
	<div class="box-body">
		<div class="form" style="text-align: center;">
			<p class="message" style="opacity: 0;">Вы не ввели запрос!</p>
			<input type="text" id="sQuery" class="halfinput" value="%{search get}%" placeholder="Введите запрос">
			<button type="button" id="button" onclick="search('sQuery');" class="btn btn-main">Найти</button>
		</div>
	</div>
</div>
<div id="result">
</div>