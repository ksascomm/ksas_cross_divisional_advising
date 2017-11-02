<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

	<?php if ( ! is_page_template( 'template-parent-page.php' ) ) :?>
		<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
			<header class="featured-hero" role="banner" data-interchange="[<?php echo the_post_thumbnail_url('featured-small'); ?>, small], [<?php echo the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php echo the_post_thumbnail_url('featured-large'); ?>, large], [<?php echo the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="<?php the_title(); ?> Banner">	
			</header>
		<?php endif;?>
					
		<h1 class="page-title"><?php the_title(); ?></h1>
	<?php endif;?>						
    <div class="entry-content" itemprop="articleBody">
	    <?php the_content(); ?>
	    <?php wp_link_pages(); ?>
	</div> <!-- end article section -->
						
</article> <!-- end article -->