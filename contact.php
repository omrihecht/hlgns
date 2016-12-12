<?php
/* Template Name: Contact */
get_header(); ?>

<div id="contact">

  <div class="info-holder">
    <div class="inner">

      <div class="contact-details">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/contact-icon.jpg" alt="" />
        <div class="contact-info">
          <p class="address">שד' רוטשילד 9, תל אביב</p>
          <!--<a class="mail-address en" href="mailto:info@hooligans.co.il">info@hooligans.co.il</a>
          <a class="phone en" href="tel:036200488">03-6200488</a>-->
        </div>
      </div><!-- contact-details -->

      <form class="contact-form">
        <div class="form-field name">
          <input id="name" type="text" name="name" value="" />
          <label for="name">שם</label>
        </div>
        <div class="form-field email">
          <input id="email" type="email" name="email" value="" />
          <label for="email">דוא"ל</label>
        </div>
        <div class="form-field msg">
          <textarea id="msg" type="text" name="msg" value="" /></textarea>
          <label for="msg">דברו אלינו. קדימה. אפשר גם מלוכלך</label>
        </div>
        <button class="send-btn">שלח</button>
        <span class="error"></span>

        <div class="loading"><img class="svg" src="<?php echo get_template_directory_uri() ?>/assets/images/spinning-circles.svg" alt="שולח"></div>

        <div class="thanks">תודה, הטופס נשלח</div>

      </form><!--contact-form -->

    </div>
  </div><!-- info-holder -->

  <div class="maps">
    <div id="map"></div>
    <div id="pano"></div>
  </div>

</div>

<script>

var contactMapObj = {
  init        : false,
  rotchield_9 : {lat: 32.063079, lng: 34.770086},
  map         : {},
  mapOptions  : {},
  pano        : {},
  panoOptions : {}
}

$(document).on('pageReady',function(){
  setMaps();
  myUtils.setFormFields();
});

function setMaps(){

  contactMapObj.init = true;
  contactMapObj.mapOptions = {
    center      : contactMapObj.rotchield_9,
    zoom        : 14
  }
  contactMapObj.map = new google.maps.Map(document.getElementById('map'), contactMapObj.mapOptions );

  contactMapObj.panoramaOptions = {
    position    : contactMapObj.rotchield_9,
    pov: {
      heading   : 355,
      pitch     : 20
    }
  }

  contactMapObj.panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'),contactMapObj.panoramaOptions);
  contactMapObj.map.setStreetView(contactMapObj.panorama);

}

$('.contact-form .send-btn').on('click',function(e){
  e.preventDefault();

  if( !formValid() ) return;

  $('.contact-form .send-btn').hide();
  $('.contact-form .loading').show();
  setTimeout(function(){
    $('.contact-form').addClass('loading');
  });

  $.ajax({
    type:"post",
    url:"/wp-content/themes/hooligans/send-contact-form.php",
    data : {
      name: $('#name').val(),
      email: $('#email').val(),
      msg: $('#msg').val()
    },
    cache:false,
    success:function(html){
      sendAnalytics('contact','form','form sent success');
      console.log('form return :: ' + html);
      setTimeout(function(){
        $('.contact-form').removeClass('loading');
        $('.contact-form .loading').hide();
        $('.contact-form .thanks').show();
        $('.contact-form .thanks').text('תודה, הטופס נשלח');
        setTimeout(function(){
          $('.contact-form').addClass('thanks');
        },50);
      },800);
    },
    error: function() {
      sendAnalytics('contact','form','form sent error');
      setTimeout(function(){
        $('.contact-form').removeClass('loading');
        $('.contact-form .loading').hide();
        $('.contact-form .thanks').show();
        $('.contact-form .thanks').text('יש בעייה במערכת, אנא נסו שוב מאוחר יותר');
        setTimeout(function(){
          $('.contact-form').addClass('thanks');
        },50);
      },800);
    }
  });
});

function formValid(){
  $('.contact-form .error').text('');
  $('.contact-form input').removeClass('required');

  if( $('#name').val() == '' ){
    showErr( $('#name'), 'יש להזין שם' );
    return false;
  }

  if( $('#email').val() == '' ){
    showErr( $('#email'), 'יש להזין מייל' );
    return false;
  } else if( !myUtils.isEmail( $('#email').val() ) ){
    showErr( $('#email'), 'כתובת המייל אינה תקינה' );
    return false;
  }

  if( $('#msg').val() == '' ){
    showErr( $('#msg'), 'יש להזין את תוכן ההודעה' );
    return false;
  }

  return true;
}

function showErr(el,str){
  $(el).addClass('required');
  $(el).focus();
  $('.contact-form .error').text(str);
}



</script>

<?php get_footer(); ?>
