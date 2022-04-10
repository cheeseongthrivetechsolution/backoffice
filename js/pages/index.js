//Form submit
$(function() {
  Common.getIndexInfo();
  $( "#logout" ).click(function() {
    Common.logout();
  });
  $( "#speaker" ).click(function() {
    Common.speaker();
  });
  $("#zh_translator").on("click", function() {
    Language.setLanguage("ZH");
  });
  $("#en_translator").on("click", function() {
    Language.setLanguage("EN");
  });

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });


  $('.iframePath').on('click', function () {
    window.localStorage.iframePath = $(this).attr('href');
  });

  if (window.localStorage.iframePath != "") {
    loadIframe(window.localStorage.iframePath);
  }
});

function loadIframe(url) {
    var $iframe = $('#contentIframe');
    if ($iframe.length) {
        $iframe.attr('src',url);
        return false;
    }
    return true;
}
