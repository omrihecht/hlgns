
function MyUtils(){

  this.setFormFields = function(){
    $('input , textarea').each(function(){
      $(this).on('change',function(){
        if($(this).val() != '') $(this).addClass('not-empty');
        if($(this).val() == '') $(this).removeClass('not-empty');
      });
      if($(this).val() != '') $(this).addClass('not-empty');
      if($(this).val() == '') $(this).removeClass('not-empty');
    });

    $('input[type="tel"] , input[name="postcode"] , input[name="housenum"] , input[name="floornum"] , input[name="aptnum"]').keydown(function (e) {
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
      (e.keyCode == 65 && e.ctrlKey === true) ||
      (e.keyCode >= 35 && e.keyCode <= 40)) {
        return;
      }
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
      }
    });
  }

  this.replaceSvgImgs = function(){
    //console.log( 'img.svg length :: ' + $('img.svg').length );
    $('img.svg').each(function(){
      //console.log( $(this).attr('class') );
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');

      jQuery.get(imgURL, function(data) {
        var $svg = jQuery(data).find('svg');
        if(typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }
        if(typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass+' replaced-svg');
        }
        $svg = $svg.removeAttr('xmlns:a');
        $img.replaceWith($svg);
      }, 'xml');
    });
    setTimeout(function(){ $('path').removeClass('cls-1'); } , 10);

  }

  this.checkObjEmpty = function( obj ){
    if (obj == null) return true;
    if (obj.length > 0)    return false;
    if (obj.length === 0)  return true;
    for (var key in obj) {
      if (hasOwnProperty.call(obj, key)) return false;
    }
    return true;
  }

  this.formatTime = function( time ){
    var sec_num = parseInt(time, 10); // don't forget the second param
    var minutes = Math.floor( sec_num / 60 );
    var seconds = sec_num - (minutes * 60);

    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time = minutes + ':' + seconds;
    return time;
  }

  this.isPhone = function( str ) {
    var reg = /^0([50|52|53|54|57|58|72|74|76|77]{2}|[2|3|4|8|9]{1})-{0,1}?[0-9]{7}$/;
    return reg.test(str);
  }

  this.isEmail = function( str ) {
    var reg = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return reg.test(str);
  }

  this.trim = function( str ) {
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
  }

  this.preloadImages = function(array) {
    var preloadImages = {};
    if (!preloadImages.list) {
      preloadImages.list = [];
    }
    var list = preloadImages.list;
    for (var i = 0; i < array.length; i++) {
      var img = new Image();
      img.onload = function() {
        var index = list.indexOf(this);
        if (index !== -1) {
          // remove image from the array once it's loaded
          // for memory consumption reasons
          list.splice(index, 1);
        }
      }
      list.push(img);
      img.src = array[i];
    }
  }

  this.generateChar = function(){
    _chars = [ '$', '%', '&', '*', '~', '#', '@', '[', ']', '$' ]
    var str = '';
    for(var i=0; i<15; i++){
      str += _chars[ Math.floor(Math.random()*_chars.length) ];
    }
    return str;
  }

}
