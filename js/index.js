//Form submit
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
  Common.login(postData); //common/common.js
}

$(function() {
  $("#zh_translator").on("click", function() {
  	Language.setLanguage("ZH");
  });
  $("#en_translator").on("click", function() {
  	Language.setLanguage("EN");
  });
});
