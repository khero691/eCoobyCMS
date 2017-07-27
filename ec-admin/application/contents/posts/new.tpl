<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-header"><h4 class="widget-title">Добавить новость</h4><span>%{ec_admin profile login}%</span></div>
              <div class="widget-separator"></div>
              <div id="echomessage" align="center">
                
              </div>
              <div class="widget-body">
                <label>Заголовок</label>
                <input type="text" id="title">
                <p class="help-text">Заголовок должен содержать не менее 8 символов!</p>
                <br>
                <textarea placeholder="Краткое описание" id="sdesc"></textarea>
                <p class="help-text">Краткое описание должно содержать не более 500 символов!</p>
                <textarea placeholder="Полное описание" id="fdesc"></textarea>
                <p class="help-text">В полном описании можно использовать HTML теги!</p>
                <label>Категория</label>
                <select type="text" id="category">
                  %{ec_admin categorys select}%
                </select>
                <div class="input icon left">
                  <input type="text" placeholder="Теги" id="tags">
                  <i class="icon fa fa-tag"></i>
                </div>
                <p class="help-text">Для разделения используйте запятые. (пример: Тест,Новость,описание,Админ)</p>
                <center><br><div id="click_send"><a href="javascript:addPost('title', 'sdesc', 'fdesc', 'tags', 'category')" class="btn btn-primary" style="width: 60%;">Опубликовать</a></div></center>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>