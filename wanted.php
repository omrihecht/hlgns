<?php
/* Template Name: Wanted */
get_header(); ?>

<div id="wanted">

<?php if( have_rows('job_spec') ):

  while ( have_rows('job_spec') ) : the_row(); ?>

  <div class="job-category" job-title="<?php echo get_sub_field('job_title'); ?>" >

    <div class="image-holder">
      <img src="<?php echo get_sub_field('job_image')['url']; ?>" alt="" />
    </div>

    <div class="job-content">

      <div class="job-description">
        <?php echo get_sub_field('job_description'); ?>
      </div>

      <a  class="send-cv-btn"
          href="mailto:jobs@hooligans.co.il?subject=<?php echo get_sub_field('job_title'); ?> CV, Hooligans.co.il"
          onclick="sendAnalytics('wanted','email cv','<?php echo get_sub_field('job_title'); ?>')" >
        <span>קו"ח לפה</span>
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/jobs-link-arrow.png" alt="" />
      </a>

      <div class="social">
        <button class="social-btn share-fb"><span class="fa fa-facebook-square"></span> <span>SHARE</span></button>
        <button class="social-btn share-twitter"><span class="fa fa-twitter-square"></span> <span>TWEET</span></button>
        <button class="social-btn share-ggl"><span class="fa fa-google-plus-square"></span> <span>SHARE</span></button>
      </div>

    </div>

  </div>

  <?php endwhile;

endif; ?>


</div>

<script>

var shareObj = {};

$(document).on('pageReady',function(){

});


$('.share-fb').on('click',function(){
  sendAnalytics('wanted', 'share job', 'facebook ' + $(this).closest('.job-category').attr('job-title') );

  updateShareObj( $(this) );

  FB.ui({
    method      : 'feed',
    name        : shareObj.share_title,
    link        : shareObj.share_url,
    picture     : shareObj.share_image,
    description : shareObj.share_desc,
    caption     : 'Hooligans'
  }, function(response) {
    if (response !== null && typeof response.post_id !== 'undefined') {
      debugger
    }

  });
  return;
});

$('.share-twitter').on('click',function(){
  sendAnalytics('wanted', 'share job', 'twitter ' + $(this).closest('.job-category').attr('job-title') );

  updateShareObj( $(this) );
  var share_txt = trim( shareObj.share_title );

  window_features = 'status=no,resizable=yes,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,width=580,height=325';

  if(isMobile){
    var share_url = 'https://mobile.twitter.com/compose/tweet?status=' + encodeURIComponent(share_txt) + ' ' + shareObj.share_url;
  }else{
    var share_url = 'http://twitter.com/home?status=' + encodeURIComponent(share_txt) + ' ' + shareObj.share_url;
  }
  window.open(share_url, 'sharer', window_features);
  return;

});

$('.share-ggl').on('click',function(){
  sendAnalytics('wanted', 'share job', 'ggl ' + $(this).closest('.job-category').attr('job-title') );

  updateShareObj( $(this) );

  $('meta[property="og:title"]').attr('content',shareObj.share_title);
  $('meta[property="og:image"]').attr('content',shareObj.share_image );
  $('meta[name="twitter:title"]').attr('content',shareObj.share_title);
  $('meta[name="twitter:image"]').attr('content',shareObj.share_image );
  window_features = 'status=no,resizable=yes,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,width=580,height=325';

  share_url = 'http://plus.google.com/share?url='+shareObj.share_url;
  window.open(share_url, 'sharer', window_features);
  return;
});

function updateShareObj( $shareBtn ){
  shareObj.share_url = window.location.href;
  shareObj.share_title = $shareBtn.closest('.job-category').find('.job-description h2').text();
  shareObj.share_image = $shareBtn.closest('.job-category').find('.image-holder img').attr('src');
  shareObj.share_desc = $shareBtn.closest('.job-category').find('.job-description').text();
}

function trim(str) {
  return str.replace(/^\s+|\s+$/g, "");
}


</script>

<?php get_footer(); ?>
