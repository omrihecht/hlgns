<?php get_header(); ?>


<article id="case-study">

  <?php if( get_field('big_image') ):
    if ($isDesktop) {
      $the_image_url = getDeviceImage( get_field('big_image') );
    }else{
      if( get_field('big_image_mobile') ){
        $the_image_url = get_field('big_image_mobile')['url'];
      }else{
        $the_image_url = getDeviceImage( get_field('big_image') );
      }
    }
  endif; ?>

  <div class="header-img">
    <img class="header-img" src="<?php echo $the_image_url ?>" alt="" />
  </div>

  <div class="title">
    <?php if(get_field('logo_dark')) { ?>
      <img class="client-logo" src="<?php echo get_field('logo_dark')['url']; ?>" alt="" />
    <?php } ?>
    <h1><?php the_title(); ?></h1>
    <?php if( get_field('subtitle') ){ ?>
      <h2><?php echo get_field('subtitle'); ?></h2>
    <?php } ?>
  </div><!-- title -->


  <?php if( get_the_category() ): ?>
    <ul class="categories">
    <?php foreach( (get_the_category()) as $category) { ?>
        <span class="category en"><?php echo $category->cat_name; ?></span>
    <?php } ?>
    </ul>
  <?php endif; ?>


  <?php if( get_field('link') ){ ?>
    <a class="launch-site en" href="<?php echo get_field('link'); ?>" target="_blank" onclick="sendAnalytics('case study','go to project','<?php the_title(); ?>')"><span>Go to Project</span> <img src="<?php echo get_template_directory_uri() ?>/assets/images/project-link-arrow.png" alt="" /></a>
  <?php } ?>

  <div class="social">
    <button class="social-btn share-fb"><span class="fa fa-facebook-square"></span> <span>SHARE</span></button>
    <button class="social-btn share-twitter"><span class="fa fa-twitter-square"></span> <span>TWEET</span></button>
    <button class="social-btn share-ggl"><span class="fa fa-google-plus-square"></span> <span>SHARE</span></button>
  </div>


  <!--  FLEXIBLE CONTENT  -->


  <?php if( have_rows('case_study_content') ){

    while ( have_rows('case_study_content') ) : the_row();

      if( get_row_layout() == 'content_block' ){ ?>

        <div class="content-block">
          <?php if( get_sub_field('text_table') ) : ?>
            <div class="block-text">
              <?php while( have_rows('text_table') ): the_row(); ?>
                <div class="text-row">
                  <?php $count = count( get_sub_field('colums') );
                  if( have_rows('colums') ):
                    while( have_rows('colums') ): the_row(); ?>
                    <div class="text-col col-<?php echo $count; ?>">
                      <?php echo get_sub_field('text'); ?>
                    </div>
                  <?php endwhile;
                endif;
                ?>
              </div><!-- text-row -->
            <?php endwhile; ?>
          </div><!-- block-text -->
        <?php endif; ?>

        <?php if( get_sub_field('image') ) { ?>
          <img class="block-img" src="<?php echo getDeviceImage( get_sub_field('image') );?>" alt=""/>
          <?php } ?>
        </div><!-- content-block -->

      <?php } elseif( get_row_layout() == 'video_gallery' ){

        $count = count( get_sub_field('video_element') ); ?>

        <div class="video-gallery">
          <div class="video-holder">
            <div class="inner">
              <iframe class='yt_iframe' title="YouTube video player" class="youtube-player" type="text/html" src="<?php echo get_sub_field('video_element')[0]['url']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
          </div><!-- video-holder -->

          <?php if($count > 1): ?>
            <div class="thumb-holder swiper-container">
              <div class="swiper-wrapper">
                <?php while( have_rows('video_element') ): the_row(); ?>
                  <div class="swiper-slide" style="background-image:url('<?php echo get_sub_field('thumbnail')['url'] ?>');" data-url="<?php the_sub_field('url') ?>" >
                    <div class="play-btn"><span class="fa fa-play-circle"></span></div>
                  </div><!-- swiper-slide -->
                <?php endwhile; ?>
              </div>

              <button class="video-nav-btn next-btn"><span class="fa fa-angle-left"></span></button>
              <button class="video-nav-btn prev-btn"><span class="fa fa-angle-right"></span></button>

            </div>
          <?php endif; ?>

        </div><!-- video-gallery -->

        <?php } elseif( get_row_layout() == 'gallery' ){ ?>
          <div class="gallery">
            <div class="gallery-holder swiper-container">
              <div class="swiper-wrapper">
                <?php while( have_rows('gallery_slide') ): the_row(); ?>
                  <div class="swiper-slide">
                    <img class="thumb-img" src="<?php echo get_sub_field('gallery_image')['url'] ?>" alt="" />
                  </div>
                <?php endwhile; ?>
              </div>
              <div class="swiper-nav swiper-button-next"><span class="fa fa-angle-right"></span></div>
              <div class="swiper-nav swiper-button-prev"><span class="fa fa-angle-left"></span></div>
            </div>
            <div class="pagination"></div>
          </div><!-- gallery -->
      <?php }

    endwhile;

  }else{

  } ?>



  <!--  FLEXIBLE CONTENT END  -->


</article>

<div id="more-projects">
  <h3 class="en">Even More Work</h3>

  <?php include 'case-study-list.php'; ?>

</div>

<script>

$(document).on('pageReady',function(){
  setSliders();
});

$(window).on('load', function (e) {
  myUtils.replaceSvgImgs();
})

function setSliders(){

  $('.gallery').each(function(){
    if( $(this).find('.swiper-slide').length == 1 ){
      $(this).find('.pagination , .swiper-button-next , .swiper-button-prev').remove();
      $(this).find('.swiper-slide').addClass('swiper-slide-active');
    } else {
      var gallerySwiper = new Swiper( $(this).find('.swiper-container'), {
        pagination            : $(this).find('.pagination'),
        paginationClickable   : true,
        nextButton            : $(this).find('.swiper-button-next'),
        prevButton            : $(this).find('.swiper-button-prev'),
        effect                : 'coverflow',
        centeredSlides        : true,
        slidesPerView         : 'auto',
        spaceBetween          : -40,
        coverflow: {
          rotate    : 20,
          stretch   : 0,
          depth     : 100,
          modifier  : 3
        },
        onSlideChangeStart     : function(){
          sendAnalytics('case-study','gallery','change slide ' + $('h1').text());
        }
      });
    }
  });

  $('.video-gallery').each(function(){

    if( $(this).find('.swiper-slide').length > 1 ){
      var videoSwiper = new Swiper( $(this).find('.swiper-container'), {
        slidesPerView        : 'auto',
        nextButton           : $(this).find('.next-btn'),
        prevButton           : $(this).find('.prev-btn'),
        spaceBetween         : 0
      });

      if( $(this).find('.swiper-button-disabled').length == 2 ){
        $(this).addClass('no-swiper');
      } else {
        $(this).find('.swiper-container').addClass('swiper-active');
      }
    }
  });

}

$('.video-gallery .swiper-slide').on('click',function(){
  sendAnalytics('case-study','video gallery','video thumb click ' + $('h1').text());
  $(this).closest('.video-gallery').find('.yt_iframe').attr('src', $(this).attr('data-url') );
  $(this).closest('.video-gallery').find('.yt_iframe').load();
});

$('.share-fb').on('click',function(){
  sendAnalytics('case-study','share facebbok',$('h1').text());
  share_url = 'http://www.facebook.com/sharer.php?u=' + window.location.href;
  sharePage();
});

$('.share-twitter').on('click',function(){
  sendAnalytics('case-study','share twitter',$('h1').text());
  if(isMobile){
    share_url = 'https://mobile.twitter.com/compose/tweet?status=' + encodeURIComponent($('h1').text()) + ' ' + window.location.href;
  }else{
    share_url = 'http://twitter.com/home?status=' + encodeURIComponent($('h1').text()) + ' ' + window.location.href;
  }
  sharePage();
});

$('.share-ggl').on('click',function(){
  sendAnalytics('case-study','share ggl',$('h1').text());
  share_url = 'http://plus.google.com/share?url=' + window.location.href;
  sharePage();
});

function sharePage(){
  window_features = 'status=no,resizable=yes,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,width=580,height=325';
  window.open(share_url, 'sharer', window_features);
}


</script>

<?php get_footer(); ?>
