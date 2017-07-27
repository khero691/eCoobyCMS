<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Информация о новости</h4><span>#%{ec_admin s}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Добавлено:</label>
                <input type="text" value="%{ec_admin post info date}%" disabled>
                <br>
                <label>Добавил:</label>
                <input type="text" value="%{ec_admin post info author_name}%" disabled>
                <br>
                <label>Просмотров:</label>
                <input type="text" value="%{ec_admin post info views}%" disabled>
                <br>
                <label>Категория:</label>
                <input type="text" value="%{ec_admin post info category}%" disabled>
                <br>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>