<div class="navbar-wrapper">
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/ec-admin/">eCooby Controle</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Главная</a></li>
          <li><a href="/ec-admin/console">Консоль</a></li>
          <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Добавить</a>
            <ul class="dropdown-menu">
              <li><a href="/ec-admin/posts&id=new">Новость</a></li>
              <li><a href="/ec-admin/pages&id=new">Страницу</a></li>
              <li><a href="/ec-admin/nav&id=new">Пункт меню</a></li>
            </ul>
          </li>
          <li><a href="/ec-admin/mods">Модули</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="user dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="%{ec_admin profile avatar}%" alt=""></a>
            <ul class="dropdown-menu">
              <li><a href="/ec-admin/profile&id=%{ec_admin profile login}%">Профиль</a></li>
              <li><a href="/ec-admin/cogs">Настройки</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="javascript:endsession();">Выйти</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>