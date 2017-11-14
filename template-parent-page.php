<?php
/*
Template Name: Parent Page
*/
?>

<?php get_header(); ?>

	<?php $buckets = array(
		'parent' => $post->ID,
		'post_type' => 'page',
		'post_status' => 'publish',
		'sort_column' => 'menu_order',
	    'sort_order' => 'asc',
		);
		$pages = get_pages($buckets); ?>

	<?php get_template_part( 'parts/featured-image' ); ?>			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="small-12 large-9 large-push-1 columns" role="main">

				<?php if (is_page('Student Roadmap') ) : ?>
					
						<div class="expanded button-group roadmap" id="parent-menu">
							<?php foreach ( $pages as $page ) { ?>
							  <a class="button" href="<?php echo  get_permalink($page->ID); ?>" rel="bookmark" title="<?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a>
							<?php } ?>
						</div>
					
				<?php elseif (is_page('Make an Appointment') || is_page('Coursework Help') ) : ?>
					<?php foreach ( $pages as $page ) { ?>
						<div class="row appointments">
							<div class="small-12 large-3 columns">
								<a class="appointment button" href="<?php echo get_permalink($page->ID); ?>" rel="bookmark" title="<?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a>
							</div>
							<div class="small-12 large-8 columns">
								<p class="excerpt post-<?php echo $page->ID;?>"><?php echo $page->post_excerpt; ?></p>

							</div>
						</div>
					<?php } ?>
				<?php endif;?>	
				<?php if (have_posts() ) : while (have_posts() ) : the_post(); ?>

					<?php get_template_part( 'parts/loop', 'page' ); ?>
					
				<?php endwhile; endif; ?>							


			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
