<?php
/* Template Name: Home */
get_header(); ?>

<div id="home">

  <div id="home-slider">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide1">
          <div class="content">
            <img class="svg" src="<?php echo get_template_directory_uri() ?>/assets/images/hooligans-logo.svg" alt="" />
            <div class="diamond"></div>
            <div class="en">Full-Stack Creative Agency</div>
          </div>
        </div>
        <div class="swiper-slide slide2">
          <div class="content">
            <div class="en t1">We create advertising<br />people choose and enjoy<br />engaging with</div>
            <div class="diamond"></div>
            <div class="t2">
              אנחנו מאמינים שאנשים ממש אוהבים פרסום.<br />
              התפקיד שלנו הוא להזכיר להם את זה.
            </div>
          </div>
        </div>
        <div class="swiper-slide slide3">
          <div class="content">
            <div class="en t1">
              <span>Digital Products</span>
              <div class="diamond"></div>
              <span>Kickass Content</span>
            </div>
            <div class="diamond"></div>
            <div class="t2">
              מברנד יוטיליטיז ממכרים ועד לממתקי תוכן מבדרים.<br />
              אנחנו יוצרים אותם, ואז אנחנו משווקים אותם.
            </div>
          </div>
        </div>
        <div class="swiper-slide slide4">

          <div class="content">

            <div class="block-side">

              <div class="block">
                <div class="en t1">Strategy</div>
                <div class="t2">
                  אסטרטגיה שמתבססת על העולם<br />
                  הדיגיטלי ועל דפוסי ההתנהגות<br />
                  של העידן החדש
                </div>
              </div>

              <div class="diamond"></div>

              <div class="block">
                <div class="en t1">Ideation</div>
                <div class="t2">
                  רעיונאות שמתכתבת עם התרבות<br />
                  הדיגיטלית ועם עולם התוכן והפלטפורמות<br />
                  של קהל היעד
                </div>
              </div>

            </div>

            <div class="diamonds-holder">
                <div class="diamond"></div>
                <div class="diamond"></div>
                <div class="diamond"></div>
            </div>

            <div class="block-side">

              <div class="block">
                <div class="en t1">UX & Design</div>
                <div class="t2">
                  עיצוב וממשק אולטרה-מוקפדים,<br />
                  אסתטית ופונקציונלית, שנראים מדהים בכל מסך,<br />
                  מכשיר או מערכת הפעלה
                </div>
              </div>

              <div class="diamond"></div>

              <div class="block">
                <div class="en t1">Technology</div>
                <div class="t2">
                  טכנולוגיה שמספרת את סיפור המותג<br />
                  בדרך חדשנית ומפתיעה,<br />
                  ולא מהווה חסם
                </div>
              </div>

            </div>

          </div>

        </div>

        <div class="swiper-slide slide5">
          <div class="content">
            <div class="en t1">Well Chosen, Guys!</div>
            <?php if(get_field('client')): ?>
              <div class="logos-holder">
                <?php while( have_rows('client') ): the_row(); ?>
                  <div class="logo"><img src="<?php echo get_sub_field('logo')['url'] ?>" alt="" /></div>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="nav-btn next-btn"><span class="fa fa-angle-right"></span></div>
      <div class="nav-btn prev-btn"><span class="fa fa-angle-left"></span></div>

      <div class="pagination">
        <div class="bullet bullet-active" num="0" ng-click="bulletClick($event)"><span class="circ"></span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home-slider-icon-1.png" alt="" /><span class="number en">01</span></div>
        <div class="bullet" num="1" ng-click="bulletClick($event)"><span class="circ"></span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home-slider-icon-2.png" alt="" /><span class="number en">02</span></div>
        <div class="bullet" num="2" ng-click="bulletClick($event)"><span class="circ"></span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home-slider-icon-4.png" alt="" /><span class="number en">03</span></div>
        <div class="bullet" num="3" ng-click="bulletClick($event)"><span class="circ"></span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home-slider-icon-3.png" alt="" /><span class="number en">04</span></div>
        <div class="bullet" num="4" ng-click="bulletClick($event)"><span class="circ"></span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home-slider-icon-5.png" alt="" /><span class="number en">05</span></div>
      </div>

    </div>
  </div><!-- home-slider -->

  <ul class="categories">
    <?php
    $cat = '';
    $taxonomy =  'category';
    $taxonomy_name = $taxonomy;
    $terms = get_terms( $taxonomy , 'orderby=slug&hide_empty=0&parent=0' );
    if ( $terms && !is_wp_error( $terms ) ) :
      $i = 0;
      if($isDesktop){ ?>
        <button class="category en all">All</button>
        <?php foreach ( $terms as $term ):
          $category = str_replace(' ','-',$term->name); ?>
          <button class="category en <?php echo strtolower( $category ); ?>"><?php echo $term->name; ?></button>
        <?php endforeach;
      } else { ?>
        <div class="select-holder">
          <select class="category-select">
            <option>All</option>
            <?php foreach ( $terms as $term ):
              $category = strtolower( $term->name ); ?>
              <option><?php echo $term->name; ?></option>
            <?php endforeach; ?>
          </select>
          <span class="arrow fa fa-chevron-down"></span>
        </div>
        <?php }
      endif; ?>
    </ul><!-- categories -->

  <?php include 'case-study-list.php'; ?>


</div><!-- home -->


<script>

$(document).on('pageReady',function(){
  setSlider();
  setScroll();
  $('.category.all').addClass('active');
});

$(window).on('load', function (e) {

})

function setScroll(){
  $(document).bind('scroll', function() {
    //console.log( 'header height :: ' + $('header').height() );
    if( $(document).scrollTop() > ( $('#home-slider').height() - $('header').height() ) ){
      $('body').addClass('sticky-categories');
    }else{
      $('body').removeClass('sticky-categories');
    }
  });
}

function setSlider(){
  var homeSlider = new Swiper('#home-slider .swiper-container', {
    slidesPerView       : 'auto',
    nextButton          : '#home-slider .next-btn',
    prevButton          : '#home-slider .prev-btn',
    spaceBetween        : 0,
    autoplay            : 7000,
    autoplayDisableOnInteraction  : true,
    onSlideChangeStart  : function(homeSlider){
      //sendAnalytics('homepage', 'slide change', 'slide ' + homeSlider.activeIndex);
      $('#home-slider .bullet').removeClass('bullet-active');
      $('#home-slider .bullet').eq(homeSlider.activeIndex).addClass('bullet-active');
    }
  });

  $('#home-slider .bullet').on('click',function(){
    $('#home-slider .bullet').removeClass('bullet-active');
    $(this).addClass('bullet-active');
    homeSlider.slideTo( parseInt( $(this).attr('num') ) );
    sendAnalytics('homepage', 'slide pagination click', 'button ' + parseInt( $(this).attr('num') ));
  });
}

$('.category').on('click',function(){
  $('.category').removeClass('active');
  $(this).addClass('active');
  var cat = $(this).text().toLowerCase().replace(' ','-');
  $('#projects li').hide();
  $('#projects').find('.'+cat).show();
  sendAnalytics('homepage', 'category click desktop', $(this).text().toLowerCase());
})

$('.category-select').on('change',function(){
  var cat = $(this).val().toLowerCase();
  $('#projects li').hide();
  $('#projects').find('.'+cat).show();
  sendAnalytics('homepage', 'category select mobile', $(this).val().toLowerCase());
})

</script>

<?php get_footer(); ?>
