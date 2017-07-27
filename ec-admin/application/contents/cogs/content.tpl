<div class="main-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="tabs">
              <ul class="tabs-nav">
                <li class="active"><a href="#panel1" data-toggle="tab">Основное</a></li>
                <li><a href="#panel2" data-toggle="tab">Безопасность</a></li>
                <li><a href="#panel3" data-toggle="tab">О себе</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="panel1">
                  <p>
                    <p class="relative">
                      Соц. сети: 
                      <input type="text" id="vk_id" value="%{ec_admin cogs vk_id}%" onchange="setCogs('vk_id', '1')" title="Your id VK"><span id="inp_load" class="inp_1"></span>
                    </p>
                    <p class="relative">
                      Почтовый адрес: 
                      <input type="text" id="email" value="%{ec_admin cogs email}%" onchange="setCogs('email', '2')" title="Your email"><span id="inp_load" class="inp_2"></span>
                    </p>
                    <p class="relative">
                      Специализация: 
                      <input type="text" id="specialization" value="%{ec_admin cogs specialization}%" onchange="setCogs('specialization', '3')" title="Your specialization"><span id="inp_load" class="inp_3"></span>
                    </p>
                    <p class="relative">
                      Страна, город проживания: 
                      <input type="text" id="country" value="%{ec_admin cogs country}%" onchange="setCogs('country', '4')" title="Your country"><span id="inp_load" class="inp_4"></span>
                    </p>
                  </p>
                </div>
                <div class="tab-pane fade" id="panel2">
                  <p>
                    <div id="echomessage" align="center">
                      
                    </div>
                    <p class="relative">
                      Введите свой пароль: 
                      <input type="password" id="oldPass" title="Your password">
                    </p>
                    <p class="relative">
                      Введите новый пароль: 
                      <input type="password" id="newPass" title="Your new password">
                    </p>
                    <p class="relative">
                      Подтвердите новый пароль: 
                      <input type="password" id="reNewPass" title="Your new password">
                    </p>
                    <center><br><div id="click_send"><a href="javascript:setPass('oldPass', 'newPass', 'reNewPass', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a></div></center>
                  </p>
                </div>
                <div class="tab-pane fade" id="panel3">
                  <p>
                    <p class="relative">
                      О себе: <span id="inp_load" class="inp_5"></span>
                      <textarea placeholder="Максимально опишите себя" id="about" onchange="setCogs('about', '5')">%{ec_admin cogs about}%</textarea>
                      <p class="help-text">В описании можно использовать HTML теги!</p>
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