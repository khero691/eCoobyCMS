<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Редактировать новость</h4><span>%{ec_admin profile login}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Заголовок</label>
                <input type="text" id="title" value="%{ec_admin post edit title}%">
                <p class="help-text">Заголовок должен содержать не менее 8 символов!</p>
                <br>
                <textarea placeholder="Краткое описание" id="sdesc">%{ec_admin post edit sdesc}%</textarea>
                <p class="help-text">Краткое описание должно содержать не более 500 символов!</p>
                <textarea placeholder="Полное описание" id="fdesc">%{ec_admin post edit fdesc}%</textarea>
                <p class="help-text">В полном описании можно использовать HTML теги!</p>
                <center><br><div id="click_send"><a href="javascript:editPost('%{ec_admin post edit id}%', 'title', 'sdesc', 'fdesc')" class="btn btn-primary" style="width: 60%;">Сохранить</a></div></center>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>