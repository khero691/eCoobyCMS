<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Редактировать пункт навигации</h4><span>%{ec_admin profile login}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Название</label>
                <input type="text" id="title" value="%{ec_admin nav edit title}%">
                <p class="help-text">Не более 17 символов!</p>
                <br>
                <label>Ссылка</label>
                <input type="text" id="url" value="%{ec_admin nav edit url}%">
                <br>
                <center><br><div id="click_send"><a href="javascript:editNav('%{ec_admin nav edit id}%', 'title', 'url')" class="btn btn-primary" style="width: 60%;">Сохранить</a></div></center>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>