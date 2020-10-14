<?php

/* Template Name: Lista */

get_header();

?>



<div class="section-inner">
  <header class="page-header section-inner thin<?php if ( has_post_thumbnail() ) echo ' fade-block'; ?>">

    <div>

      <?php

      the_title( '<h1 class="title entry-title">', '</h1>' );
      ?>
    </div>
  </header>
      <div class="posts" id="posts">

<?php

$args = array(
    'post_parent' => get_the_ID(),
    'post_type' => 'page',
    'orderby' => 'menu_order'
);

$child_query = new WP_Query( $args );

// if ( is_page() && count( $children ) > 0 ) : )  :

	while ( $child_query->have_posts() ) :

    $child_query->the_post();
		get_template_part( 'content' );

	endwhile;

wp_reset_postdata();
// endif;
?>
</div>
</div>

<?php
get_footer(); ?>
