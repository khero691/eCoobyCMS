<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Удалить новость</h4><span>%{ec_admin profile login}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Вы уверенны что хотите удалить новость - <a href="/post?id=%{ec_admin post del id}%"><font color="#4a6199"><b>%{ec_admin post del title}%(#%{ec_admin post del id}%)</b></font></a>?</label>
                <p class="help-text">Без возможности восстановления.</p>
                <center><br><div id="click_send"><a href="javascript:delPost('%{ec_admin post del id}%')" class="btn btn-danger" style="width: 30%;">Удалить</a><a href="javascript:history.back()" class="btn btn-warning" style="width: 30%;">Назад</a></div></center>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>