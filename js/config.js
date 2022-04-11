//Environment Setting productionEnv or stagingEnv  or developmentEnv
var env = "developmentEnv";

//Page Language
const Language = {
    getLanguage: function () {
      localStorage.getItem('language') == null ? Language.setLanguage('ZH') : false;
    	return localStorage.getItem('language');
    },
    setLanguage: function (lang) {
      	localStorage.setItem('language', lang);
        location.reload();
    },
};

//Site settings
var config = {
  apiUrl: "production-api-path-here",
  imgUrl: "production-image-path-here",
  pageSizenum: 30,
  lang : Language.getLanguage(),
}

if (env == "stagingEnv") {
	config.apiUrl = 'staging-api-path-here';
	config.imgUrl = "staging-image-path-here";
} else if (env == "developmentEnv") {
	config.apiUrl = '//ultraflex.api/';
	config.imgUrl = "development-image-path-here";
}

const API_ENDPOINT = config.apiUrl;

$(function() {
	Common.translation(); //common/common.js
});
