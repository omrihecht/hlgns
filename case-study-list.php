<?php
$case_studies_arr = array( 'post_type'=>'case-study' , 'posts_per_page'=>'-1' );
$case_studies = new WP_Query($case_studies_arr);

if ($case_studies->have_posts()): ?>

  <ul id="projects">
    <?php while ($case_studies->have_posts()):
      $case_studies->the_post();
      $status = get_post_status();
      $categories = 'all';
      if( get_the_category() ):
        foreach( (get_the_category()) as $category) {
          $categories = $categories.' '.str_replace(' ','-',$category->cat_name);
        }
      endif; ?>
      <li class="<?php echo strtolower( $categories ).' '.strtolower( $status); ?> <?php get_post_status(); ?>">
        <a href="<?php echo get_permalink($case_studies->ID); ?>">
          <div class="sizer" style="background-image:url('<?php echo get_field('square_image')['url']; ?>');"></div>
          <div class="inner">
            <div class="info">
                <h3><?php echo get_the_title(); ?></h3>
                <?php if( get_field('subtitle') ){ echo '<h4>'.get_field('subtitle_projects_page').'</h4>'; } ?>
            </div>
            <div class="logo"><img src="<?php echo get_field('logo')['url']; ?>" alt="" /></div>
          </div>
        </a>
      </li>

    <?php endwhile ?>
  </ul><!-- projects -->
<?php endif;
wp_reset_postdata();
?>
