var debug = false;

var mapApiKey = '';
var isMobile, isIpad, isIOS, isAndroid, isIE, isOldBrowser;
var docW, docH;

var myUtils = new MyUtils();

$(document).ready(function(e) {
  var md = new MobileDetect(window.navigator.userAgent);

  head.ready(function () {

    if(md.tablet() != null){
      isIpad = true;
      $('html').addClass('ipad-device');
    }

    if(md.phone() != null){
      isMobile = true;
      $('html').addClass('mobile-device');
      if(md.os() == 'AndroidOS'){
        isAndroid = true;
        $('html').addClass('AndroidOS');
      }
      if(md.os() == 'iOS'){
        isIOS = true;
        $('html').addClass('IOS');
      }
    }

    if(head.browser.ie && head.browser.version < 11){
			isIE = true;
      $('html').addClass('old-browser');
		}

    myUtils.replaceSvgImgs();

    $.event.trigger({
      type : 'pageReady'
    });

    setPage();
  });
});

$(window).on('load', function (e) {

});


function setPage(){
  console.log('page ready');
}

function sendAnalytics( category, action, label ){
  ga('send', 'event', category, action, label);
}
