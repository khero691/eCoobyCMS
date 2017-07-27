/* Base
------------------------------------------------------------ */
(function($) {
  'use strict';
  $(document).ready(function() {


    $('#upgrade').click(function(event){
      function clean() {
        $("#load")
          .animate({opacity: 100, top: '45%'}, 200,
          function(){ 
            $("#load").html('');
            $("#load").css('opacity','0');
          }
        );
      }
      function install(i) {
        var text = 'Установка обновлений';
        for (var i = i; i >= 0; i--) {
          text += '.';
        };
        $("#load").html(text);
      }
      $("#load")
        .animate({opacity: 100, top: '45%'}, 200,
        function(){ 
          $("#load").html('<img src="./application/assets/images/preload.gif">');
        }
      );
      $.ajax({
        url: "./include/version.php", 
        cache: false,   
        success: function(data) {   
          if(data == 'INSTALLSUCCESS') { 
            $("#load")
              .animate({opacity: 100, top: '45%'}, 200,
              function(){ 
                $("#load").html('Обновления успешно установлены.');
                setTimeout(function(){
                  location.reload();
                }, 3000);
              }
            );
          } else if(data == 'NO_UPDATES') {
            $("#load")
              .animate({opacity: 100, top: '45%'}, 200,
              function(){ 
                $("#load").html('Обновлений не найдено.');
              }
            );
            setTimeout(clean, 5000);
          } else if(data == 'NO_CONNECT') {
            $("#load")
              .animate({opacity: 100, top: '45%'}, 200,
              function(){ 
                $("#load").html('Соединение не установлено.');
              }
            );
            setTimeout(clean, 5000);
          } else if(data == 'FILE_NOT_EXIST') {
            $("#load")
              .animate({opacity: 100, top: '45%'}, 200,
              function(){ 
                $("#load").html('Ошибка при загрузке данных.');
              }
            );
            setTimeout(clean, 5000);
          } else if(data == 'INSTALL') { 
            $("#load")
              .animate({opacity: 100, top: '45%'}, 200,
              function(){ 
                $("#load").html('<img src="./application/assets/images/preload.gif"><br>Установка обновлений...<br><font color="grey">Не закрывайте эту страницу до окончания.');
              }
            );
          }
        }
      });
    });

    $(window).scroll(function() {
      if($(window).width() < 960) $('.navbar').css('left', -$(this).scrollLeft() + 'px');
      else if($(window).width() >= 960) $('.navbar').css('left', '0');
    });

    $('.disabled').on('click', function(e) { e.preventDefault(); });

    $('.tabs ul.tabs-nav li a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    var inputPassword = document.querySelector('.input-password-js'), buttonShowPassword = document.querySelector('.btn-show-password-js');
    function showPassword() {
      var attrType = inputPassword.getAttribute('type');
      if(attrType === 'password') { inputPassword.setAttribute('type', 'text'); buttonShowPassword.textContent = 'Hide'; }
      else { inputPassword.setAttribute('type', 'password'); buttonShowPassword.textContent = 'Show'; }
    }
    //buttonShowPassword.addEventListener('click', showPassword);

    $('.widget .list-group a[data-menu]').on('click', function(e) {
      e.preventDefault();
      var dataMenu = $(this).data('menu');
      $('.widget .list-group span.' + dataMenu).slideToggle('fast', function() {
        if($(this).is(':visible')) {
          $(this).css('display', 'block');
        }
      });
    });

  });
}(jQuery));

function setOption(id, inp) {
  var val = $("#" + id).val();
  function clean() {
    $(".inp_" + inp)
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $(".inp_" + inp).html('');
        $(".inp_" + inp).css('opacity','100');
      }
    );
  }
  $(".inp_" + inp).html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
  $.ajax({
    url: "./include/update.php?s=" + val + "&id=" + id + "&op=setting", 
    cache: false,   
    success: function(data) {   
      //location.reload();
      if(data == 'error') $(".inp_" + inp).html("<i class='fa fa-close'></i>");
      else { 
        $(".inp_" + inp).html("<i class='fa fa-check'></i>");
        if(id == 'template') {
          $("span.tpl").html(val);
        }
      }
      setTimeout(clean, 1000);
    }

  });
}

function setCogs(id, inp) {
  var val = $("#" + id).val();
  function clean() {
    $(".inp_" + inp)
      .animate({opacity: 0}, 200,
      function(){ 
        $(".inp_" + inp).html('');
        $(".inp_" + inp).css('opacity','100');
      }
    );
  }
  $(".inp_" + inp).html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
  $.ajax({
    url: "./include/update.php?s=" + val + "&id=" + id + "&op=cogs", 
    cache: false,   
    success: function(data) {   
      //location.reload();
      if(data == 'error') $(".inp_" + inp).html("<i class='fa fa-close'></i>");
      else { 
        $(".inp_" + inp).html("<i class='fa fa-check'></i>");
      }
      setTimeout(clean, 1000);
    }

  });
}

function delModule(module, btn) {
  function clean() {
    $("#tr_" + btn)
      .animate({opacity: 0}, 200,
      function(){ 
        $("#tr_" + btn).html("");
      }
    );
  }
  
  $("#btn_" + btn).attr('disabled','disabled');
  $("#btn_" + btn).html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
  $.ajax({
    url: "./include/update.php?s=" + module + "&op=delModule", 
    cache: false,   
    success: function(data) {   
      //location.reload();
      if(data == 'success') {
        setTimeout(clean, 1000);
      } else {
        $("#btn_" + btn).removeAttr('disabled');
        $("#btn_" + btn).html("Удалить");
      }
    }

  });
}

function setPass(oldp, newp, rep, btn) {
  var o_cols = $("#" + oldp).val();
  var n_cols = $("#" + newp).val();
  var r_cols = $("#" + rep).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(o_cols.length > 0) {
    if(n_cols.length > 0) {
      if(r_cols.length > 0) {
        $.ajax({
          url: "./include/update.php?s=" + o_cols + "&op=getPass", 
          cache: false,   
          success: function(data) {   
            if(data == 'success') {
              if(n_cols == r_cols) {
                if(n_cols != o_cols) {
                  if(n_cols.length > 5) {
                    $.ajax({
                      url: "./include/update.php?s=" + n_cols + "&op=setPass", 
                      cache: false,   
                      success: function(data) {  
                        if(data == 'success') {
                            $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>Пароль успешно изменен!</div>');
                            $("#click_send")
                            .animate({opacity: 0, top: '45%'}, 200,
                            function(){ 
                              $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
                              $("#click_send").css('opacity','100');
                            }
                          );
                        }
                      }

                    });
                  } else {
                    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> пароль должен содержать не менее 6 символов!</div>');
                    $("#click_send")
                      .animate({opacity: 0, top: '45%'}, 200,
                      function(){ 
                        $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
                        $("#click_send").css('opacity','100');
                      }
                    );
                  }
                } else {
                  $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Новые пароль такой же как старый!</div>');
                  $("#click_send")
                    .animate({opacity: 0, top: '45%'}, 200,
                    function(){ 
                      $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
                      $("#click_send").css('opacity','100');
                    }
                  );
                }
              } else {
                $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Новые пароли не совпадают!</div>');
                $("#click_send")
                  .animate({opacity: 0, top: '45%'}, 200,
                  function(){ 
                    $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
                    $("#click_send").css('opacity','100');
                  }
                );
              }
            } else {
              $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Старый пароль введен не верно!</div>');
              $("#click_send")
                .animate({opacity: 0, top: '45%'}, 200,
                function(){ 
                  $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
                  $("#click_send").css('opacity','100');
                }
              );
            }
          }

        });
      } else {
        $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Повторите новый пароль!</div>');
        $("#click_send")
          .animate({opacity: 0, top: '45%'}, 200,
          function(){ 
            $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
            $("#click_send").css('opacity','100');
          }
        );
      }
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите новый пароль!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите свой пароль!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:setPass(\'oldPass\', \'newPass\', \'reNewPass\', this)" class="btn btn-success" id="btn" style="width: 40%;">Сменить пароль</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function addPost(title, sdesc, fdesc, tags, categ) {
  var t_cols = $("#" + title).val();
  var s_cols = $("#" + sdesc).val();
  var f_cols = $("#" + fdesc).val();
  var ta_cols = $("#" + tags).val();
  var ca_cols = $("#" + categ).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length > 5) {
    if(s_cols.length < 501 && s_cols.length > 20) {
      if(ca_cols.length > 0) {
        var array = t_cols + "/*/*/" + s_cols + "/*/*/" + f_cols + "/*/*/" + ta_cols + "/*/*/" + ca_cols;
        var arr = $.base64Encode(array);
        $.ajax({
          url: "./include/update.php?s=" + arr + "&op=addPost", 
          cache: false,   
          success: function(data) {   
            //location.reload();
            $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
            $("#click_send")
              .animate({opacity: 0, top: '45%'}, 200,
              function(){ 
                $("#click_send").html('<a href="javascript:addPost(\'title\', \'sdesc\', \'fdesc\', \'tags\', \'category\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
                $("#click_send").css('opacity','100');
              }
            );
          }

        });
      } else {
        $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Выберите категорию!</div>');
        $("#click_send")
          .animate({opacity: 0, top: '45%'}, 200,
          function(){ 
            $("#click_send").html('<a href="javascript:addPost(\'title\', \'sdesc\', \'fdesc\', \'tags\', \'category\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
            $("#click_send").css('opacity','100');
          }
        );
      }
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В кратком описании должно быть не более 500 символов!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:addPost(\'title\', \'sdesc\', \'fdesc\', \'tags\', \'category\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В заголовке должно быть не менее 6 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:addPost(\'title\', \'sdesc\', \'fdesc\', \'tags\', \'category\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function addPage(title, content, url) {
  var t_cols = $("#" + title).val();
  var c_cols = $("#" + content).val();
  var u_cols = $("#" + url).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length > 5) {
    if(c_cols.length > 20) {
      if(u_cols.length > 0) {
        var array = t_cols + "/*/*/" + c_cols + "/*/*/" + u_cols;
        var arr = $.base64Encode(array);
        $.ajax({
          url: "./include/update.php?op=getPage&s=" + u_cols, 
          cache: false,   
          success: function(data) {   
            //location.reload();
            if(data == 'null') {
              $.ajax({
                url: "./include/update.php?s=" + arr + "&op=addPage", 
                cache: false,   
                success: function(data) {   
                  //location.reload();
                  $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
                  $("#click_send")
                    .animate({opacity: 0, top: '45%'}, 200,
                    function(){ 
                      $("#click_send").html('<a href="javascript:addPage(\'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
                      $("#click_send").css('opacity','100');
                    }
                  );
                }

              });
            } else {
              $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Идентификатор страницы занят!</div>');
              $("#click_send")
                .animate({opacity: 0, top: '45%'}, 200,
                function(){ 
                  $("#click_send").html('<a href="javascript:addPage(\'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
                  $("#click_send").css('opacity','100');
                }
              );
            }
          }

        });
      } else {
        $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите идентификатор страницы!</div>');
        $("#click_send")
          .animate({opacity: 0, top: '45%'}, 200,
          function(){ 
            $("#click_send").html('<a href="javascript:addPage(\'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
            $("#click_send").css('opacity','100');
          }
        );
      }
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В содержимом страницы должно быть не менее 20 символов!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:addPage(\'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В заголовке должно быть не менее 6 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:addPage(\'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function addNav(title, url) {
  var t_cols = $("#" + title).val();
  var u_cols = $("#" + url).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length < 18 && t_cols.length > 0 ) {
    if(u_cols.length > 0) {
      var array = t_cols + "/*/*/" + u_cols;
      var arr = $.base64Encode(array);
      $.ajax({
        url: "./include/update.php?s=" + arr + "&op=addNav", 
        cache: false,   
        success: function(data) {   
          //location.reload();
          $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
          $("#click_send")
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              $("#click_send").html('<a href="javascript:addNav(\'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
              $("#click_send").css('opacity','100');
            }
          );
        }

      });
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите ссылку!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:addNav(\'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В названии должно быть не более 17 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:addNav(\'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Опубликовать</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function setCont(url, id) {
  var val = $("#" + url).val();
  if(val.length > 0) $("#" + id).html(val);
  else $("#" + id).html('(содержимое поля для ввода)');
}

function setImage(login, id) {
  var u_login = $(login).val();
  var hash = $.base64Encode(u_login);
  $.ajax({
    url: "./include/update.php?s=" + hash + "&op=getAvatar", 
    cache: false,   
    success: function(data) { 
      //location.reload();
      if(data != 'error') {
        if(data != $("#" + id).attr('src')) {
          $("#" + id)
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              $("#" + id).attr('src', data);
              $("#" + id).css('opacity','100');
            }
          );
        }
      } else if($("#" + id).attr('src') != '../../ec-tpl/default/images/load.png') {
        $("#" + id)
          .animate({opacity: 0, top: '45%'}, 200,
          function(){ 
            $("#" + id).attr('src', '../../ec-tpl/default/images/load.png');
            $("#" + id).css('opacity','100');
          }
        );
      }
    }
  });

}

function setDis(inp_p, inp_l, id) {
  var tp = $(inp_p).val();
  var tl = $('#' + inp_l).val();
  if(tp.length > 0 && tl.length > 0 ) $('#' + id).removeAttr('disabled');
  else $('#' + id).attr('disabled','disabled');
}

function auth_admin(btn, inp_l, inp_p, img) {
  var inp__p = $('#' + inp_p).val();
  var inp__l = $('#' + inp_l).val();
  var iimg = $('#' + img);
  function clean() {
    $("#result")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#result").html('');
        $("#result").css('opacity','100');
      }
    );
  }
  if(inp__p.length > 0 && inp__l.length > 0) {
    $(btn).attr('disabled','disabled');
    $(iimg)
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        iimg.attr('class','load-image');
        iimg.css('opacity','100');
      }
    );
    $.ajax({
      url: "./include/update.php?login=" + inp__l + "&password=" + inp__p + "&op=admin_auth", 
      cache: false,   
      success: function(data) { 
        if(data != 'error' && data != 'error_pass') {
          $(".widget-body")
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              $(".widget-body").html('<center><br><br><font size="16" color="#4eac6c"><i class="fa fa-check"></i><br>Success</font><br><br><br><br><br></center>');
              $(".widget-body").css('opacity','100');
            }
          );
          var md_pass = md5(inp__p);
          var hash = md5(data + '-' + inp__l + '-' + md_pass);
          var date = new Date(0);
          document.cookie = "userId=" + data + "; path=/; expires=" + date.toUTCString()*30;
          document.cookie = "access_hash=" + hash + "; path=/; expires=" + date.toUTCString()*30;
          setTimeout(location.reload(), 4000);
        } else {
          if(data == 'error_pass') {
            $('#result')
              .animate({opacity: 0, top: '45%'}, 200,
              function(){ 
                $('#result').html('<center><font color="#ed4845">Логин или пароль введен не верно!</font><br></center>');
                $('#result').css('opacity','100');
              }
            );
            setTimeout(clean, 3000);
          } else {
            $('#result')
              .animate({opacity: 0, top: '45%'}, 200,
              function(){ 
                $('#result').html('<center><font color="#ed4845">Ошибка при обработке данных...</font><br></center>');
                $('#result').css('opacity','100');
              }
            );
            setTimeout(clean, 3000);
          }
          $(btn).removeAttr('disabled');
          $(iimg)
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              iimg.attr('class','signin-image');
              iimg.css('opacity','100');
            }
          );
        }
      }
    });

  }
}

function endsession() {
  var date = new Date(0);
  document.cookie = "userId=; path=/; expires=" + date.toUTCString();
  document.cookie = "access_hash=; path=/; expires=" + date.toUTCString();
  location.reload();
}

function editPost(id, title, sdesc, fdesc) {
  var t_cols = $("#" + title).val();
  var s_cols = $("#" + sdesc).val();
  var f_cols = $("#" + fdesc).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length > 5) {
    if(s_cols.length < 501 && s_cols.length > 20) {
      var array = t_cols + "/*/*/" + s_cols + "/*/*/" + f_cols + "/*/*/" + id;
      var arr = $.base64Encode(array);
      $.ajax({
        url: "./include/update.php?s=" + arr + "&op=editPost", 
        cache: false,   
        success: function(data) {   
          //location.reload();
          $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
          $("#click_send")
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              $("#click_send").html('<a href="javascript:editPost(' + id + ', \'title\', \'sdesc\', \'fdesc\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
              $("#click_send").css('opacity','100');
            }
          );
        }

      });
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В кратком описании должно быть не более 500 символов!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:editPost(' + id + ', \'title\', \'sdesc\', \'fdesc\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В заголовке должно быть не менее 6 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:editPost(' + id + ', \'title\', \'sdesc\', \'fdesc\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function editNav(id, title, url) {
  var t_cols = $("#" + title).val();
  var u_cols = $("#" + url).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length < 18 && t_cols.length > 0 ) {
    if(u_cols.length > 0) {
      var array = t_cols + "/*/*/" + u_cols + "/*/*/" + id;
      var arr = $.base64Encode(array);
      $.ajax({
        url: "./include/update.php?s=" + arr + "&op=editNav", 
        cache: false,   
        success: function(data) {   
          //location.reload();
          $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
          $("#click_send")
            .animate({opacity: 0, top: '45%'}, 200,
            function(){ 
              $("#click_send").html('<a href="javascript:editNav(' + id + ', \'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
              $("#click_send").css('opacity','100');
            }
          );
        }

      });
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите ссылку!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:editNav(' + id + ', \'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В названии должно быть не более 17 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:editNav(' + id + ', \'title\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function editPage(id, title, content, url) {
  var t_cols = $("#" + title).val();
  var c_cols = $("#" + content).val();
  var u_cols = $("#" + url).val();
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  if(t_cols.length > 5) {
    if(c_cols.length > 20) {
      if(u_cols.length > 0) {
        c_cols = $.base64Encode(c_cols);
        var array = t_cols + "/*/*/" + c_cols + "/*/*/" + u_cols + "/*/*/" + id;
        var arr = $.base64Encode(array);
        $.ajax({
          url: "./include/update.php?op=getPage&s=" + u_cols, 
          cache: false,   
          success: function(data) {   
            //location.reload();
            if(data == 'null' || data == id) {
              $.ajax({
                url: "./include/update.php?s=" + arr + "&op=editPage", 
                cache: false,   
                success: function(data) {   
                  //location.reload();
                  $("#echomessage").html('<div class="alert alert-info"><button data-dismiss="alert" class="close" type="button">×</button>' + data + '</div>');
                  $("#click_send")
                    .animate({opacity: 0, top: '45%'}, 200,
                    function(){ 
                      $("#click_send").html('<a href="javascript:editPage(' + id + ', \'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
                      $("#click_send").css('opacity','100');
                    }
                  );
                }

              });
            } else {
              $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Идентификатор страницы занят!</div>');
              $("#click_send")
                .animate({opacity: 0, top: '45%'}, 200,
                function(){ 
                  $("#click_send").html('<a href="javascript:editPage(' + id + ', \'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
                  $("#click_send").css('opacity','100');
                }
              );
            }
          }

        });
      } else {
        $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Введите идентификатор страницы!</div>');
        $("#click_send")
          .animate({opacity: 0, top: '45%'}, 200,
          function(){ 
            $("#click_send").html('<a href="javascript:editPage(' + id + ', \'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
            $("#click_send").css('opacity','100');
          }
        );
      }
    } else {
      $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В содержимом страницы должно быть не менее 20 символов!</div>');
      $("#click_send")
        .animate({opacity: 0, top: '45%'}, 200,
        function(){ 
          $("#click_send").html('<a href="javascript:editPage(' + id + ', \'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
          $("#click_send").css('opacity','100');
        }
      );
    }
  } else {
    $("#echomessage").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> В заголовке должно быть не менее 6 символов!</div>');
    $("#click_send")
      .animate({opacity: 0, top: '45%'}, 200,
      function(){ 
        $("#click_send").html('<a href="javascript:editPage(' + id + ', \'title\', \'content\', \'url\')" class="btn btn-primary" style="width: 60%;">Сохранить</a>');
        $("#click_send").css('opacity','100');
      }
    );
  }
}

function delPost(id) {
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  $.ajax({
    url: "./include/update.php?op=delPost&id=" + id, 
    cache: false,   
    success: function(data) {   
      if(data == 'success') { 
        location.reload();
      } else {
        $("#echomessage").html('<div class="alert alert-warning"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Обновите страницу.</div>');
      }
    }

  });
}
function delPage(id) {
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  $.ajax({
    url: "./include/update.php?op=delPage&id=" + id, 
    cache: false,   
    success: function(data) {   
      if(data == 'success') { 
        location.reload();
      } else {
        $("#echomessage").html('<div class="alert alert-warning"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Обновите страницу.</div>');
      }
    }

  });
}
function delNav(id) {
  $("#click_send")
    .animate({opacity: 0, top: '45%'}, 200,
    function(){ 
      $("#click_send").html("<img src=\"../ec-tpl/default/images/load.png\" class=\"load-image\">");
      $("#click_send").css('opacity','100');
    }
  );
  $.ajax({
    url: "./include/update.php?op=delNav&id=" + id, 
    cache: false,   
    success: function(data) {   
      if(data == 'success') { 
        location.reload();
      } else {
        $("#echomessage").html('<div class="alert alert-warning"><button data-dismiss="alert" class="close" type="button">×</button><strong>Ошибка!</strong> Обновите страницу.</div>');
      }
    }

  });
}