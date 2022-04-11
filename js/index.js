//Login Submit callback from recaptcha
function onSubmit(token) {
  $(".errorMsg").hide();
  let username = document.loginForm.username;
  let password = document.loginForm.password;
  if( username.value.trim() == "" ) {
     username.focus();
     $(".usernameErr").show();
     return false;
  }
  if( password.value.trim() == "" ) {
     password.focus();
     $(".passwordErr").show();
     return false;
  }
  var postData = {
    username: username.value.trim(),
    password: password.value.trim(),
    recaptcha: token,
    lang: config.lang,
  }
  //Login
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

$(function() {
  //Define actions
  $("#zh_translator").on("click", function() {
  	Language.setLanguage("ZH");
  });
  $("#en_translator").on("click", function() {
  	Language.setLanguage("EN");
  });
});
