<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Редактировать страницу</h4><span>%{ec_admin profile login}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Заголовок</label>
                <input type="text" id="title" value="%{ec_admin page edit title}%">
                <p class="help-text">Заголовок должен содержать не менее 6 символов!</p>
                <br>
                <label>Идентификатор страницы</label>
                <input type="text" id="url" onchange="setCont('url', 'pageId');" value="%{ec_admin page edit url}%">
                <p class="help-text">Используйте только буквы и цифры. (пример: "test-page", "my_page1" или "home")</p>
                <p class="help-text"><code>Потом это будет выглядеть так: %{ec_admin domain}%/page&id=<span id="pageId">(содержимое поля для ввода)</span></code></p>
                <br>
                <textarea placeholder="Содержимое" id="content">%{ec_admin page edit content}%</textarea>
                <p class="help-text">В содержимом можно использовать HTML теги!</p>
                <center><br><div id="click_send"><a href="javascript:editPage('%{ec_admin page edit id}%', 'title', 'content', 'url')" class="btn btn-primary" style="width: 60%;">Сохранить</a></div></center>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>