$(document).ready(function(){i18next.use(window.i18nextXHRBackend).init({debug:!0,lng:"en",fallbackLng:!1,backend:{loadPath:"robust-assets/locales/{{lng}}/{{ns}}.json"},returnObjects:!0},function(a,b){jqueryI18next.init(i18next,$)}),$("#lng-onit").on("click",".lng-nav li a",function(){var a=$(this),b=a.data("lng");i18next.changeLanguage(b,function(a,b){$(".main-menu").localize()}),a.parent("li").siblings("li").children("a").removeClass("active"),a.addClass("active"),$("#lng-onit").find(".lng-dropdown .dropdown-menu a").removeClass("active");var c=$("#lng-onit").find('.lng-dropdown .dropdown-menu a[data-lng="'+b+'"]').addClass("active");$("#lng-onit #dropdown-active-item").html(c.html())}),$("#lng-onit").on("click",".lng-dropdown .dropdown-menu a",function(){var a=$(this),b=a.data("lng");i18next.changeLanguage(b,function(a,b){$(".main-menu").localize()}),$("#lng-onit .lng-nav li a").removeClass("active"),$('#lng-onit .lng-nav li a[data-lng="'+b+'"]').addClass("active"),$("#lng-onit").find(".lng-dropdown .dropdown-menu a").removeClass("active"),a.addClass("active"),$("#lng-onit #dropdown-active-item").html(a.html())})});