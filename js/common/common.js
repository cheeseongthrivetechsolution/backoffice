//Common use function declaration
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
      if (code == "500" || code == "401")
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
      if ($('#contentIframe').length) {
        $('#contentIframe').contents().find('.translation').each(function(){
          var element = $(this);
          if( element.is('input') || element.is('textarea')) {
              $(this).attr("placeholder",language[lang][$(this).attr('key')]);
            } else {
              $(this).text(language[lang][$(this).attr('key')]);
            }
        });
      }

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
    skipIndex: function (data) {
      if(data.code == 401) {
		    localStorage.clear();
        alert(data.msg)
        parent.location.href = "../index.html";
      }
    },
    getToken: function () {
	    return window.localStorage.token == undefined ? "" : window.localStorage.token;
    },
};
