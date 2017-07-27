<div class="main-wrapper">
  <div class="container">
    <div class="row">
      %{ec_admin content navbar}%
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="tabs">
              <ul class="tabs-nav">
                <li class="active"><a href="#panel1" data-toggle="tab">Основные</a></li>
                <li><a href="#panel2" data-toggle="tab">Пользователей</a></li>
                <li><a href="#panel3" data-toggle="tab">Активации</a></li>
                <li><a href="#panel4" data-toggle="tab">Блога</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="panel1">
                  <p>
                    <p class="relative">
                      Название: 
                      <input type="text" id="title" value="%{ec_admin settings title}%" onchange="setOption('title', '1')" placeholder="Your Website Name"><span id="inp_load" class="inp_1"></span>
                    </p>
                    <p class="relative">
                      Теги: 
                      <input type="text" id="webtags" value="%{ec_admin settings webtags}%" onchange="setOption('webtags', '2')" placeholder="Your Website Tags"><span id="inp_load" class="inp_2"></span>
                    </p>
                    <p class="relative">
                      Шаблон(Выбран:  <font color="#0cde70"><span class="tpl">%{ec_admin settings template}%</span></font>): 
                      <select id="template" onchange="setOption('template', '3')">
                        %{ec_admin settings tpls}%
                      </select><span id="inp_load" class="inp_3"></span>
                    </p>
                    <p class="relative">
                      <input type="checkbox" title="Для включения, нужен модуль пользователей" disabled id="access_registration" onchange="setOption('access_registration', '4')" style="height: 15px; width: 15px; padding-top: 5px;"></input> Разрешить регистрацию <span id="inp_load" class="inp_4"></span>
                    </p>
                    <p class="relative">
                      <input type="checkbox" title="Для включения, нужен модуль пользователей" disabled id="open_news" onchange="setOption('open_news', '5')" style="height: 15px; width: 15px; padding-top: 5px;"></input> Открытые новости <span class="inp_5" id="inp_load"></span>
                    </p> 
                    <p class="relative">
                      <input type="checkbox" id="site_open" onchange="setOption('site_open', '6')" style="height: 15px; width: 15px; padding-top: 5px;"></input> Открытый доступ к сайту <span id="inp_load" class="inp_6"></span>
                    </p>
                  </p>
                </div>
                <div class="tab-pane fade" id="panel2">
                  <p>
                    Подключите модуль пользователей.
                  </p>
                </div>
                <div class="tab-pane fade" id="panel3">
                  <p>
                    <p class="relative">
                      Лицензия: 
                      <input type="text" id="license" onchange="setOption('license', '7')" class="input-password-js" placeholder="000-000-000-000" value="%{ec_admin settings license}%"><span id="inp_load" class="inp_7"></span>
                    </p>
                  </p>
                </div>
                <div class="tab-pane fade" id="panel4">
                  <p>
                    <p class="relative">
                      <input type="checkbox" id="reg_comment" onchange="setOption('reg_comment', '8')"  %{ec_admin settings reg_comment_check}% style="height: 15px; width: 15px; padding-top: 5px;"></input> Открытые комментарии<span id="inp_load" class="inp_8"></span>
                    </p>
                    <p class="relative">
                      <input type="checkbox" onchange="setOption('check_comments', '9')" style="height: 15px; width: 15px; padding-top: 5px;"></input> Проверка комментариев<span id="inp_load" class="inp_9"></span>
                    </p>
                    <p class="relative">
                      <input type="checkbox" onchange="setOption('avatars_on', '10')" title="Для включения, нужен модуль пользователей" disabled style="height: 15px; width: 15px; padding-top: 5px;"></input> Аватары в комментариях<span id="inp_load" class="inp_10"></span>
                    </p>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>