<div class="main-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="profile-wrapper">
            <div class="profile-body">
              <div class="profile-image">
                <div class="image-span"><a href="mailto:%{ec_admin profile_view email}%" title="Скопировать email адрес" class="icon"><i class="fa fa-envelope-o"></i></a></div>
                <div class="image-span"><div class="image"><img src="%{ec_admin profile_view avatar}%" alt=""></div></div>
                <div class="image-span"><a href="//vk.com/id%{ec_admin profile_view vk_id}%" target="_blank" class="icon"><i class="fa fa-vk"></i></a></div>
              </div>
              <div class="profile-title"><h4><a href="#">%{ec_admin profile_view name}%</a></h4></div>
              <div class="profile-title-span">
                <ul>
                  <li><i class="fa fa-bolt"></i> %{ec_admin profile_view specialization}%</li>
                  <li><i class="fa fa-map-marker"></i> %{ec_admin profile_view country}%</li>
                </ul>
              </div>
            </div>
            <div class="profile-footer">
              <div class="row no-gutter">
                <div class="item col-md-2 col-sm-offset-3">
                  <span>Дата регистрации</span>
                  <h4>%{ec_admin profile_view reg_date}%</h4>
                </div>
                <div class="item col-md-2">
                  <span>Регистрационный адрес</span>
                  <h4>%{ec_admin profile_view reg_ip}%</h4>
                </div>
                <div class="item col-md-2">
                  <span>Уровень доступа</span>
                  <h4>%{ec_admin profile_view level}%</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="widget"><b>О себе:</b><br><br>%{ec_admin profile_view about}%</div>
        </div>
      </div>
    </div>
  </div>