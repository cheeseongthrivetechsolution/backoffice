const API_ENDPOINT = config.apiUrl;

const Message = {
    popSnack: function (cls) {
      var x = document.getElementById("snackbar");
      x.className = "show "+cls;
      setTimeout(function(){
         x.className = x.className.replace("show", "");
       }, 3000);
    },
    addAlert: function (message,code) {
      if ($('#snackbar').length > 0) {
        $('#snackbar').remove();
      }
      var cls = "success";
      if (code == "500")
        cls = "danger";
      var snackbar = '<div id="snackbar">'+message+'</div>';
      $('body').append(snackbar);
      Message.popSnack(cls);
    },
};

const Common = {
    translation: function () {
      var lang = config.lang.toLowerCase();
      $('.translation').each(function(index,element){
        var element = $(this);
        if( element.is('input') || element.is('textarea')) {
            $(this).attr("placeholder",language[lang][$(this).attr('key')]);
          } else {
            $(this).text(language[lang][$(this).attr('key')]);
          }
      });
    },
    parseObj: function (jsondata) {
      var data = null;
      if(typeof jsondata != "object") {
          data = JSON.parse(jsondata);
      } else {
          data = JSON.stringify(jsondata);
          data = JSON.parse(data);
      }
      return data;
    },
    getIndexInfo: function () {
      var params = {
        lang: config.lang,
        token: Common.getToken()
      };
      $.ajax({
          url: API_ENDPOINT + "user/getIndexInfo.php",
          type: "GET",
          data: params,
          success: function(data) {
              data = Common.parseObj(data);
              Common.skipIndex(data);
              if (data.code == 200){
                $(".profileImage").attr('src', data.row.avatar);
                $("#profileName").text(data.row.name);
                if (data.row.sound == 0) {
                  $("#speaker i").removeClass("mdi-music");
                  $("#speaker i").addClass("mdi-music-off");
                }

              } else {
                Message.addAlert(data.msg,data.code);
              }
          },
          error: function(data) {
              console.log(data);
          }
      });
    },
    speaker: function () {
      var params = {
        lang: config.lang,
        token: Common.getToken()
      };
      $.ajax({
          url: API_ENDPOINT + "user/soundSwitch.php",
          type: "PUT",
          data: params,
          success: function(data) {
              data = Common.parseObj(data);
              Common.skipIndex(data);
              if (data.code == 200){
                if ($("#speaker i").hasClass("fa-volume-up")) {
                  $("#speaker i").removeClass("fa-volume-up");
                  $("#speaker i").addClass("fa-volume-mute");
                } else {
                  $("#speaker i").addClass("fa-volume-up");
                  $("#speaker i").removeClass("fa-volume-mute");
                }
              } else {
                Message.addAlert(data.msg,data.code);
              }
          },
          error: function(data) {
              console.log(data);
          }
      });
    },
    skipIndex: function (data) {
      if(data.code == 401) {
  		    localStorage.clear();
          alert(data.msg)
          window.location.href = "../index.html";
          return;
      }
    },
    getToken: function () {
	    return window.localStorage.token == undefined ? "" : window.localStorage.token;
    },
    logout: function () {
      var params = {
        lang: config.lang,
        token: Common.getToken()
      };
      $.ajax({
          url: API_ENDPOINT + "user/logout.php",
          type: "GET",
          data: params,
          success: function(data) {
              data = Common.parseObj(data);
              if(data.code == 200 || data.code == 401) {
  		          localStorage.clear();
                window.location.href = "../index.html";
              } else {
                Message.addAlert(data.msg,data.code);
              }
          },
          error: function(data) {
              console.log("data error");
          }
      });
    },
    login: function (postData) {
      $.ajax({
        url: API_ENDPOINT + "user/login.php",
        dataType: "json",
        type: "POST",
        data: postData,
        success: function(data) {
          data = Common.parseObj(data);
          if(data.code == 200) {
            window.localStorage.token = data.token;
            window.localStorage.username = postData.username;
            window.location.replace("pages/index.html");
          } else {
            Message.addAlert(data.msg,data.code)
          }
        },
        error: function(data) {
          console.log("data error");
        }
      });
    }
};
