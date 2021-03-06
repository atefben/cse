!function(a,b,c){"use strict";c.robust=c.robust||{};var d=c("body"),e=c(a),f=c('div[data-menu="menu-wrapper"]').html(),g=c('div[data-menu="menu-wrapper"]').attr("class");c.robust.menu={expanded:null,collapsed:null,hidden:null,container:null,horizontalMenu:!1,manualScroller:{obj:null,init:function(){var a=c(".main-menu").hasClass("menu-dark")?"light":"dark";if(this.obj=c(".main-menu-content").perfectScrollbar({suppressScrollX:!0,theme:a}),c(".main-menu").data("scroll-to-active")===!0){var b;b=c(".main-menu-content").find("li.active").parents("li").length>0?c(".main-menu-content").find("li.active").parents("li").last().position():c(".main-menu-content").find("li.active").position(),c.robust.menu.container.scrollTop(b.top),this.update()}},update:function(){this.obj&&c(".main-menu-content").perfectScrollbar("update")},enable:function(){this.init()},disable:function(){this.obj&&c(".main-menu-content").perfectScrollbar("destroy")},updateHeight:function(){"vertical-menu"!=d.data("menu")&&"vertical-overlay-menu"!=d.data("menu")||!c(".main-menu").hasClass("menu-fixed")||(c(".main-menu-content").css("height",c(a).height()-c(".header-navbar").height()-c(".main-menu-header").outerHeight()-c(".main-menu-footer").outerHeight()),this.update())}},mMenu:{obj:null,init:function(){c(".main-menu").mmenu({slidingSubmenus:!0,offCanvas:!1,counters:!1,navbar:{title:""},navbars:[{position:"top",content:["searchfield"]}],searchfield:{resultsPanel:!0},setSelected:{parent:!0}},{classNames:{divider:"navigation-header",selected:"active"},searchfield:{clear:!0}}),c("a.mm-next").addClass("mm-fullsubopen"),this.obj=c(".main-menu").data("mmenu")},enable:function(){this.init()},disable:function(){}},init:function(){if(c(".main-menu-content").length>0){this.container=c(".main-menu-content");this.change()}else this.drillDownMenu()},drillDownMenu:function(a){c(".drilldown-menu").length&&("sm"==a||"xs"==a?"true"==c("#navbar-mobile").attr("aria-expanded")&&c(".drilldown-menu").slidingMenu({backLabel:!0}):c(".drilldown-menu").slidingMenu({backLabel:!0}))},change:function(){function a(a){var b=c(".menu-search");c(b).change(function(){var b=c(this).val();if(b){c(".navigation-header").hide(),c(a).find("li a:not(:Contains("+b+"))").hide().parent().hide();var d=c(a).find("li a:Contains("+b+")");d.parent().hasClass("has-sub")?(d.show().parents("li").show().addClass("open").closest("li").children("a").show().children("li").show(),d.siblings("ul").length>0&&d.siblings("ul").children("li").show().children("a").show()):d.show().parents("li").show().addClass("open").closest("li").children("a").show()}else c(".navigation-header").show(),c(a).find("li a").show().parent().show().removeClass("open");return c.robust.menu.manualScroller.update(),!1}).keyup(function(){c(this).change()})}var b=Unison.fetch.now();this.reset();var e=d.data("menu");if(b)switch(b.name){case"xl":case"lg":"vertical-overlay-menu"===e?this.hide():"vertical-compact-menu"===e?this.open():this.expand();break;case"md":"vertical-overlay-menu"===e||"vertical-mmenu"===e?this.hide():"vertical-compact-menu"===e?this.open():this.collapse();break;case"sm":this.hide();break;case"xs":this.hide()}"vertical-menu"!==e&&"vertical-compact-menu"!==e&&"vertical-content-menu"!==e||this.toOverlayMenu(b.name),d.is(".horizontal-layout")&&!d.hasClass(".horizontal-menu-demo")&&(this.changeMenu(b.name),c(".menu-toggle").removeClass("is-active")),"horizontal-menu"!=e&&"horizontal-top-icon-menu"!=e&&this.drillDownMenu(b.name),"xl"==b.name&&c('body[data-open="hover"] .dropdown').on("mouseenter",function(){c(this).hasClass("open")?c(this).removeClass("open"):c(this).addClass("open")}).on("mouseleave",function(a){c(this).removeClass("open")}),c(".header-navbar").hasClass("navbar-brand-center")&&c(".header-navbar").attr("data-nav","brand-center"),"sm"==b.name||"xs"==b.name?c(".header-navbar[data-nav=brand-center]").removeClass("navbar-brand-center"):c(".header-navbar[data-nav=brand-center]").addClass("navbar-brand-center"),c("ul.dropdown-menu [data-toggle=dropdown]").on("click",function(a){c(this).siblings("ul.dropdown-menu").length>0&&a.preventDefault(),a.stopPropagation(),c(this).parent().siblings().removeClass("open"),c(this).parent().toggleClass("open")}),"horizontal-menu"!=e&&"horizontal-top-icon-menu"!=e||("sm"==b.name||"xs"==b.name?c(".menu-fixed").length&&c(".menu-fixed").unstick():c(".navbar-fixed").length&&c(".navbar-fixed").sticky()),"vertical-menu"!==e&&"vertical-overlay-menu"!==e&&"vertical-content-menu"!==e||(jQuery.expr[":"].Contains=function(a,b,c){return(a.textContent||a.innerText||"").toUpperCase().indexOf(c[3].toUpperCase())>=0},a(c("#main-menu-navigation")))},changeLogo:function(a){var b=c(".brand-logo");"expand"==a?b.attr("src",b.data("expand")):b.attr("src",b.data("collapse"))},transit:function(a,b){var e=this;d.addClass("changing-menu"),a.call(e),d.hasClass("vertical-layout")&&(d.hasClass("menu-open")||d.hasClass("menu-expanded")?(c(".menu-toggle").addClass("is-active"),"vertical-menu"!==d.data("menu")&&"vertical-content-menu"!==d.data("menu")||c(".main-menu-header")&&c(".main-menu-header").show()):(c(".menu-toggle").removeClass("is-active"),"vertical-menu"!==d.data("menu")&&"vertical-content-menu"!==d.data("menu")||c(".main-menu-header")&&c(".main-menu-header").hide())),setTimeout(function(){b.call(e),d.removeClass("changing-menu"),e.update()},500)},open:function(){d.is(".vertical-mmenu")&&this.mMenu.enable(),this.transit(function(){d.removeClass("menu-hide menu-collapsed").addClass("menu-open"),this.hidden=!1,this.expanded=!0},function(){c(".main-menu").hasClass("menu-native-scroll")||d.is(".vertical-mmenu")||!c(".main-menu").hasClass("menu-fixed")||(this.manualScroller.enable(),c(".main-menu-content").css("height",c(a).height()-c(".header-navbar").height()-c(".main-menu-header").outerHeight()-c(".main-menu-footer").outerHeight()),this.manualScroller.update())})},hide:function(){d.is(".vertical-mmenu")&&this.mMenu.disable(),this.transit(function(){d.removeClass("menu-open menu-expanded").addClass("menu-hide"),this.hidden=!0,this.expanded=!1},function(){c(".main-menu").hasClass("menu-native-scroll")||d.is(".vertical-mmenu")||!c(".main-menu").hasClass("menu-fixed")||this.manualScroller.enable()})},expand:function(){this.expanded===!1&&("vertical-menu"==d.data("menu")&&this.changeLogo("expand"),this.transit(function(){d.removeClass("menu-collapsed").addClass("menu-expanded"),this.collapsed=!1,this.expanded=!0},function(){d.is(".vertical-mmenu")?this.mMenu.enable():c(".main-menu").hasClass("menu-native-scroll")||"vertical-mmenu"==d.data("menu")||"horizontal-menu"==d.data("menu")||"horizontal-top-icon-menu"==d.data("menu")?this.manualScroller.disable():c(".main-menu").hasClass("menu-fixed")&&this.manualScroller.enable(),"vertical-menu"==d.data("menu")&&c(".main-menu").hasClass("menu-fixed")&&(c(".main-menu-content").css("height",c(a).height()-c(".header-navbar").height()-c(".main-menu-header").outerHeight()-c(".main-menu-footer").outerHeight()),this.manualScroller.update())}))},collapse:function(){this.collapsed===!1&&("vertical-menu"==d.data("menu")&&this.changeLogo("collapse"),this.transit(function(){d.removeClass("menu-expanded").addClass("menu-collapsed"),this.collapsed=!0,this.expanded=!1},function(){"vertical-content-menu"==d.data("menu")&&this.manualScroller.disable(),"horizontal-menu"!=d.data("menu")&&"horizontal-top-icon-menu"!=d.data("menu")||!d.hasClass("vertical-overlay-menu")||c(".main-menu").hasClass("menu-fixed")&&this.manualScroller.enable(),"vertical-menu"==d.data("menu")&&c(".main-menu").hasClass("menu-fixed")&&(c(".main-menu-content").css("height",c(a).height()-c(".header-navbar").height()),this.manualScroller.update())}))},toOverlayMenu:function(a){var b=d.data("menu");"sm"==a||"xs"==a?(d.hasClass(b)&&d.removeClass(b).addClass("vertical-overlay-menu"),"vertical-content-menu"==b&&c(".main-menu").addClass("menu-fixed")):(d.hasClass("vertical-overlay-menu")&&d.removeClass("vertical-overlay-menu").addClass(b),"vertical-content-menu"==b&&c(".main-menu").removeClass("menu-fixed"))},changeMenu:function(a){c('div[data-menu="menu-wrapper"]').html(""),c('div[data-menu="menu-wrapper"]').html(f);var b=c('div[data-menu="menu-wrapper"]'),e=(c('div[data-menu="menu-container"]'),c('ul[data-menu="menu-navigation"]')),h=c('li[data-menu="megamenu"]'),i=c("li[data-mega-col]"),j=c('li[data-menu="dropdown"]'),k=c('li[data-menu="dropdown-submenu"]');"sm"==a||"xs"==a?(d.removeClass(d.data("menu")).addClass("vertical-layout vertical-overlay-menu fixed-navbar"),c("nav.header-navbar").addClass("navbar-fixed-top"),b.removeClass().addClass("main-menu menu-light menu-fixed menu-shadow"),e.removeClass().addClass("navigation navigation-main"),h.removeClass("dropdown mega-dropdown").addClass("has-sub"),h.children("ul").removeClass(),i.each(function(a,b){var d=c(b).find(".mega-menu-sub");d.find("li").has("ul").addClass("has-sub");var e=c(b).children().first(),f="";e.is("h6")&&(f=e.html(),e.remove(),c(b).prepend('<a href="#">'+f+"</a>").addClass("has-sub mega-menu-title"))}),h.find("a").removeClass("dropdown-toggle"),h.find("a").removeClass("dropdown-item"),j.removeClass("dropdown").addClass("has-sub"),j.find("a").removeClass("dropdown-toggle nav-link"),j.children("ul").find("a").removeClass("dropdown-item"),j.find("ul").removeClass("dropdown-menu"),k.removeClass().addClass("has-sub"),c.robust.nav.init(),c("ul.dropdown-menu [data-toggle=dropdown]").on("click",function(a){a.preventDefault(),a.stopPropagation(),c(this).parent().siblings().removeClass("open"),c(this).parent().toggleClass("open")})):(d.removeClass("vertical-layout vertical-overlay-menu fixed-navbar").addClass(d.data("menu")),c("nav.header-navbar").removeClass("navbar-fixed-top"),b.removeClass().addClass(g),this.drillDownMenu(a),c("a.dropdown-item.nav-has-children").on("click",function(){event.preventDefault(),event.stopPropagation()}),c("a.dropdown-item.nav-has-parent").on("click",function(){event.preventDefault(),event.stopPropagation()}))},toggle:function(){var a=Unison.fetch.now(),b=(this.collapsed,this.expanded),c=this.hidden,e=d.data("menu");switch(a.name){case"xl":case"lg":case"md":b===!0?"vertical-compact-menu"==e||"vertical-mmenu"==e||"vertical-overlay-menu"==e?this.hide():this.collapse():"vertical-compact-menu"==e||"vertical-mmenu"==e||"vertical-overlay-menu"==e?this.open():this.expand();break;case"sm":c===!0?this.open():this.hide();break;case"xs":c===!0?this.open():this.hide()}this.drillDownMenu(a.name)},update:function(){this.manualScroller.update()},reset:function(){this.expanded=!1,this.collapsed=!1,this.hidden=!1,d.removeClass("menu-hide menu-open menu-collapsed menu-expanded")}},c.robust.nav={container:c(".navigation-main"),initialized:!1,navItem:c(".navigation-main").find("li").not(".navigation-category"),config:{speed:300},init:function(a){this.initialized=!0,c.extend(this.config,a),d.is(".vertical-mmenu")||this.bind_events()},bind_events:function(){var a=this;c(".navigation-main").on("mouseenter.robust.menu","li",function(){var b=c(this);if(c(".hover",".navigation-main").removeClass("hover"),d.hasClass("menu-collapsed")||"vertical-compact-menu"==d.data("menu")&&!d.hasClass("vertical-overlay-menu")){c(".main-menu-content").children("span.menu-title").remove(),c(".main-menu-content").children("a.menu-title").remove(),c(".main-menu-content").children("ul.menu-content").remove();var e,f,g=b.find("span.menu-title").clone();b.hasClass("has-sub")||(e=b.find("span.menu-title").text(),f=b.children("a").attr("href"),""!==e&&(g=c("<a>"),g.attr("href",f),g.attr("title",e),g.text(e),g.addClass("menu-title")));var h;if(h=b.css("border-top")?b.position().top+parseInt(b.css("border-top"),10):b.position().top,"vertical-compact-menu"!==d.data("menu")&&g.appendTo(".main-menu-content").css({position:"fixed",top:h}),b.hasClass("has-sub")&&b.hasClass("nav-item")){b.children("ul:first");a.adjustSubmenu(b)}}b.addClass("hover")}).on("mouseleave.robust.menu","li",function(){}).on("active.robust.menu","li",function(a){c(this).addClass("active"),a.stopPropagation()}).on("deactive.robust.menu","li.active",function(a){c(this).removeClass("active"),a.stopPropagation()}).on("open.robust.menu","li",function(b){var d=c(this);return d.addClass("open"),a.expand(d),!c(".main-menu").hasClass("menu-collapsible")&&(d.siblings(".open").find("li.open").trigger("close.robust.menu"),d.siblings(".open").trigger("close.robust.menu"),void b.stopPropagation())}).on("close.robust.menu","li.open",function(b){var d=c(this);d.removeClass("open"),a.collapse(d),b.stopPropagation()}).on("click.robust.menu","li",function(a){var b=c(this);b.is(".disabled")?a.preventDefault():d.hasClass("menu-collapsed")||"vertical-compact-menu"==d.data("menu")&&!d.hasClass("vertical-overlay-menu")?a.preventDefault():b.has("ul")?b.is(".open")?b.trigger("close.robust.menu"):b.trigger("open.robust.menu"):b.is(".active")||(b.siblings(".active").trigger("deactive.robust.menu"),b.trigger("active.robust.menu")),a.stopPropagation()}),c(".main-menu-content").on("mouseleave",function(){(d.hasClass("menu-collapsed")||"vertical-compact-menu"==d.data("menu"))&&(c(".main-menu-content").children("span.menu-title").remove(),c(".main-menu-content").children("a.menu-title").remove(),c(".main-menu-content").children("ul.menu-content").remove()),c(".hover",".navigation-main").removeClass("hover")}),c(".navigation-main li.has-sub > a").on("click",function(a){a.preventDefault()}),c("ul.menu-content").on("click","li",function(b){var d=c(this);if(d.is(".disabled"))b.preventDefault();else if(d.has("ul"))if(d.is(".open"))d.removeClass("open"),a.collapse(d);else{if(d.addClass("open"),a.expand(d),c(".main-menu").hasClass("menu-collapsible"))return!1;d.siblings(".open").find("li.open").trigger("close.robust.menu"),d.siblings(".open").trigger("close.robust.menu"),b.stopPropagation()}else d.is(".active")||(d.siblings(".active").trigger("deactive.robust.menu"),d.trigger("active.robust.menu"));b.stopPropagation()})},adjustSubmenu:function(a){var b,f,g,h,i,j,k,l,m=a.children("ul:first"),n=m.clone(!0);b=c(".main-menu-header").height(),f=a.position().top,h=e.height()-c(".header-navbar").height(),k=0,i=m.height(),parseInt(a.css("border-top"),10)>0&&(k=parseInt(a.css("border-top"),10)),j=h-f-a.height()-30,l=c(".main-menu").hasClass("menu-dark")?"light":"dark","vertical-compact-menu"===d.data("menu")?(g=f+k,j=h-f-30):"vertical-content-menu"===d.data("menu")?(g=f+a.height()+k,j=h-c(".content-header").height()-a.height()-f-60):g=f+a.height()+k,"vertical-content-menu"==d.data("menu")?n.addClass("menu-popout").appendTo(".main-menu-content").css({top:g,position:"fixed"}):(n.addClass("menu-popout").appendTo(".main-menu-content").css({top:g,position:"fixed","max-height":j}),c(".main-menu-content > ul.menu-content").perfectScrollbar({theme:l}))},collapse:function(a,b){var d=a.children("ul");d.show().slideUp(c.robust.nav.config.speed,function(){c(this).css("display",""),c(this).find("> li").removeClass("is-shown"),b&&b(),c.robust.nav.container.trigger("collapsed.robust.menu")})},expand:function(a,b){var d=a.children("ul"),e=d.children("li").addClass("is-hidden");d.hide().slideDown(c.robust.nav.config.speed,function(){c(this).css("display",""),b&&b(),c.robust.nav.container.trigger("expanded.robust.menu")}),setTimeout(function(){e.addClass("is-shown"),e.removeClass("is-hidden")},0)},refresh:function(){c.robust.nav.container.find(".open").removeClass("open")}}}(window,document,jQuery);
!function(a,b,c){"use strict";var d=c("html"),e=c("body");c(a).on("load",function(){function a(){var a=c(".main-menu").height(),b=c(".content-body").height();b<a&&c(".content-body").css("height",a)}var b;"RTL"==c("html").data("textdirection")&&(b=!0),setTimeout(function(){d.removeClass("loading").addClass("loaded")},1200),c.robust.menu.init();var f={speed:300};if(c.robust.nav.initialized===!1&&c.robust.nav.init(f),Unison.on("change",function(a){c.robust.menu.change()}),c('[data-toggle="tooltip"]').tooltip({container:"body"}),c(".navbar-hide-on-scroll").length>0&&(c(".navbar-hide-on-scroll.navbar-fixed-top").headroom({offset:205,tolerance:5,classes:{initial:"headroom",pinned:"headroom--pinned-top",unpinned:"headroom--unpinned-top"}}),c(".navbar-hide-on-scroll.navbar-fixed-bottom").headroom({offset:205,tolerance:5,classes:{initial:"headroom",pinned:"headroom--pinned-bottom",unpinned:"headroom--unpinned-bottom"}})),setTimeout(function(){c("body").hasClass("vertical-content-menu")&&a()},500),c(".responsive-slick").length>0){var g=c(".responsive-slick");g.slick({rtl:b,dots:!1,arrows:!1,infinite:!0,autoplay:!0,autoplaySpeed:2e3,slidesToShow:1,slidesToScroll:1})}c('a[data-action="collapse"]').on("click",function(a){a.preventDefault(),c(this).closest(".card").children(".card-body").collapse("toggle"),c(this).closest(".card").find('[data-action="collapse"] i').toggleClass("icon-minus4 icon-plus4")}),c('a[data-action="expand"]').on("click",function(a){a.preventDefault(),c(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-expand2 icon-contract"),c(this).closest(".card").toggleClass("card-fullscreen")}),c(".scrollable-container").length>0&&c(".scrollable-container").perfectScrollbar({theme:"dark"}),c('a[data-action="reload"]').on("click",function(){var a=c(this).closest(".card");a.block({message:'<div class="icon-spinner9 icon-spin icon-lg"></div>',timeout:2e3,overlayCSS:{backgroundColor:"#FFF",cursor:"wait"},css:{border:0,padding:0,backgroundColor:"none"}})}),c('a[data-action="close"]').on("click",function(){c(this).closest(".card").removeClass().slideUp("fast")}),setTimeout(function(){c(".row.match-height").each(function(){c(this).find(".card").not(".card .card").matchHeight()})},500),c('.card .heading-elements a[data-action="collapse"]').on("click",function(){var a,b=c(this),d=b.closest(".card");console.log(parseInt(d[0].style.height,10)),parseInt(d[0].style.height,10)>0?(a=d.css("height"),d.css("height","").attr("data-height",a)):d.data("height")&&(a=d.data("height"),d.css("height",a).attr("data-height",""))});var h=e.data("menu");"vertical-compact-menu"!=h&&"horizontal-menu"!=h&&"horizontal-top-icon-menu"!=h&&c(".main-menu-content").find("li.active").parents("li").addClass("open"),c(".heading-elements-toggle").on("click",function(){c(this).parent().children(".heading-elements").toggleClass("visible")});var i=c(".chartjs"),j=i.children("canvas").attr("height");if(i.css("height",j),c("body").hasClass("boxed-layout")&&(c("body").hasClass("vertical-overlay-menu")||c("body").hasClass("vertical-compact-menu"))){var k=c(".main-menu").width(),l=c(".robust-content").position().left,m=l-k;c("body").hasClass("menu-flipped")?c(".main-menu").css("right",m+"px"):c(".main-menu").css("left",m+"px")}}),c(b).on("click",".menu-toggle",function(a){return a.preventDefault(),c.robust.menu.toggle(),!1}),c(b).on("click",".open-navbar-container",function(a){var b=Unison.fetch.now();c.robust.menu.drillDownMenu(b.name)}),c(b).on("click",".main-menu-footer .footer-toggle",function(a){return a.preventDefault(),c(this).find("i").toggleClass("pe-is-i-angle-down pe-is-i-angle-up"),c(".main-menu-footer").toggleClass("footer-close footer-open"),!1}),c(".navigation").find("li").has("ul").addClass("has-sub"),c(".carousel").carousel({interval:2e3}),c(".nav-link-expand").on("click",function(a){"undefined"!=typeof screenfull&&screenfull.enabled&&screenfull.toggle()}),"undefined"!=typeof screenfull&&screenfull.enabled&&c(b).on(screenfull.raw.fullscreenchange,function(){screenfull.isFullscreen?c(".nav-link-expand").find("i").toggleClass("icon-contract icon-expand2"):c(".nav-link-expand").find("i").toggleClass("icon-expand2 icon-contract")}),c(b).on("click",".mega-dropdown-menu",function(a){a.stopPropagation()}),c(b).ready(function(){c(".step-icon").each(function(){var a=c(this);a.siblings("span.step").length>0&&(a.siblings("span.step").empty(),c(this).appendTo(c(this).siblings("span.step")))})}),c(a).resize(function(){c.robust.menu.manualScroller.updateHeight()}),c(".nav.nav-tabs a.dropdown-item",".nav.nav-tabs a.dropdown-item").on("click",function(){var a=c(this),b=a.attr("href"),d=a.closest(".nav");d.find(".nav-link").removeClass("active"),a.closest(".nav-item").find(".nav-link").addClass("active"),a.closest(".dropdown-menu").find(".dropdown-item").removeClass("active"),a.addClass("active"),d.next().find(b).siblings(".tab-pane").removeClass("active in").attr("aria-expanded",!1),c(b).addClass("active in").attr("aria-expanded","true")}),c("#sidebar-page-navigation").on("click","a.nav-link",function(a){a.preventDefault();var b=c(this),d=b.attr("href"),e=c(d).offset(),f=e.top-80;c("html, body").animate({scrollTop:f},0)})}(window,document,jQuery);
!function(){var a=$("#fullscreen-search"),b=$("body"),c=$(".fullscreen-search-input"),d=$(".fullscreen-search-btn"),e=a.find("span.fullscreen-search-close"),f=isAnimating=!1,g=function(d){if("focus"===d.type.toLowerCase()&&f)return!1;a[0].getBoundingClientRect();f?(a.removeClass("open"),b.removeClass("search-open"),""!==c.value&&setTimeout(function(){a.addClass("hideInput"),setTimeout(function(){a.removeClass("hideInput"),c.value=""},300)},500),c.blur()):(a.addClass("open"),b.addClass("search-open")),f=!f};$(d).on("click",function(a){g(a)}),$(c).on("focus",function(a){g(a)}),$(e).on("click",function(a){g(a)}),document.addEventListener("keydown",function(a){if(($(a.target).is("input")||$(a.target).is("textarea")||$(a.target).hasClass("ql-editor"))&&"fullscreen-search-input"!=a.target.className)return!1;var b=a.keyCode||a.which;27===b&&f&&g(a),(a.keyCode>=48&&a.keyCode<=57||a.keyCode>=65&&a.keyCode<=90&&!(a.shiftKey||a.ctrlKey||a.altKey||a.metaKey))&&(f=!1,g(a),$(".fullscreen-search-input").focus())}),a.find('button[type="submit"]').on("click",function(a){a.preventDefault()})}();


   // setup an "add a tag" link

    var $addTagLink = $('<a href="#" class="add_tag_link"><i class="icon-android-add-circle"></i></a>');
    var $newLinkLi = $('<div class="form-group"></div>').append($addTagLink);



jQuery(document).ready(function() {



	//$('#appbundle_survey_collaborateur').combobox();

	var $sigdiv = $("#signature").jSignature();


	$("#signature").bind('change', function(e){ var data = $sigdiv.jSignature('getData', e.target.value)
		$('#appbundle_survey_signatureClient').val(data);
	})



    // Get the ul that holds the collection of tags
   var $collectionHolder = $('div.criterias');
   var $collectionHolderscores = $('div.scores');
   var $collectionHoldercoefficients = $('div.coefficients');
    
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    for(var i = 0; i < 5; i++) {
    	addTagForm($collectionHolder, $newLinkLi, $collectionHolderscores, $collectionHoldercoefficients, false);
    }
 
    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        
        // add a new tag form (see code block below)
        addTagForm($collectionHolder, $newLinkLi, $collectionHolderscores, $collectionHoldercoefficients, true);
    });
    
    
});

function addTagForm($collectionHolder, $newLinkLi, $collectionHolderScore, $collectionHolderCoef, $deletelink) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    var prototypeScore = $collectionHolderScore.data('prototype');
    var prototypeCoef = $collectionHolderCoef.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    var newFormScore = prototypeScore.replace(/__name__/g, index);
    var newFormCoef = prototypeCoef.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a tag" link li
    var N = index +1;
    var FC = '<h5 class="form-section" style="text-align:center">Critère '+N+'</h5><div class="col-md-3"><div class="form-group"><label for="">Critère</label>'+newForm+'</div></div>';
    var FS = '<div class="col-md-3"><div class="form-group"><label for="">Score</label>'+newFormScore+'</div></div>';
    var FCo = '<div class="col-md-3"><div class="form-group"><label for="">coefficient</label>'+newFormCoef+'</div></div>';

    var $newFormLi = $('<div class="row"></div>').append(FC+ FS+FCo+'<div></div>');
    
    // also add a remove button, just for this example
    if($deletelink == true)
    {
    	$newFormLi.append('<h5><a href="#" class="remove-tag"><i class="icon-android-cancel"></i></a></h5>');
    }
    
    $newLinkLi.before($newFormLi);
    
    // handle the removal, just for this example
    $('.remove-tag').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });












/* ** */
$( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#appbundle_survey_collaborateur" ).combobox();
    /*$( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });*/
  } );
}
