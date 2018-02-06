<?php get_header(); $theme_option = flagship_sub_get_global_options(); ?>
	<div id="content">
		<div id="inner-content" class="padding-top-zero">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<?php
					// If a featured image is set, insert into layout and use Interchange
					// to select the optimal image size per named media query.
					if ( has_post_thumbnail( $post->ID ) ) : ?>
						<header class="featured-hero parent front-page" role="banner" data-interchange="[<?php echo the_post_thumbnail_url('featured-small'); ?>, small], [<?php echo the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php echo the_post_thumbnail_url('featured-large'); ?>, large], [<?php echo the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]">
							<div class="orbit-caption">
								<div class="row">
									<h1 class="headline"><?php the_field( 'task_finder' ); ?></h1>
								</div>
							</div>								
						</header>
					<?php endif;?>

					<div class="home-intro" aria-label="Introduction">
						<div class="row">	
							<?php if ( is_active_sidebar( 'sidebar1' ) || is_active_sidebar('homepage0')  ) : ?>
								<div class="small-12 large-8 columns introduction">
									<?php the_content(); ?>	
								</div>	
								<aside class="sidebar small-12 large-3 columns hide-for-print" id="sidebar1"> 
									<?php dynamic_sidebar( 'sidebar1' ); ?>
									<?php dynamic_sidebar( 'homepage0' ); ?>
								</aside>
							<?php else: ?>
							<div class="small-12 large-9 large-push-2 columns introduction">
								<?php the_content(); ?>	
							</div>	
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; endif; ?>	
				<div class="hp-buckets">
					<div class="row">
						<div class="small-12 columns">
							<?php if ( have_rows( 'upcoming_deadlines' ) ) : ?>
								<h2 class="deadlines-heading">
									<?php $field_name = "upcoming_deadlines";
									$field = get_field_object($field_name);
									echo $field['label'];?>
								</h2>
								<div class="row">
									<?php while ( have_rows( 'upcoming_deadlines' ) ) : the_row(); ?>
									<div class="dates small-12 large-4 columns">
										<div class="date">
											<h3><?php the_sub_field( 'font_awesome_icon' ); ?></h3>
											<h4><?php the_sub_field( 'deadline_date' ); ?></h4>
											<p><?php the_sub_field( 'deadline_information' ); ?></p>
										</div>
									</div>
									<?php endwhile; ?>
								</div>	
							<?php endif;?>
						</div>	
					</div>	
				</div>	
		    <main id="main" role="main" class="row">
			
				<div class="small-12 large-8 columns">
				   
				    <?php  //News Query		
						$news_quantity = $theme_option['flagship_sub_news_quantity']; 
						if ( false === ( $news_query = get_transient( 'news_mainpage_query' ) ) ) {
								$news_query = new WP_Query(array(
									'post_type' => 'post',
									'posts_per_page' => $news_quantity)); 
						set_transient( 'news_mainpage_query', $news_query, 2592000 );
						} 	
					if ( $news_query->have_posts() ) : ?>

					<div class="news-feed">

						<h3><?php echo $theme_option['flagship_sub_feed_name']; ?></h3>

						<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
							
								<?php get_template_part( 'parts/loop', 'news' ); ?>
								
						<?php endwhile; ?>

						 <div class="row">
							<h5 class="black">
								<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
									View <?php echo $theme_option['flagship_sub_feed_name']; ?> Archive
								</a>
							</h5>
						</div>
					</div>
					<?php endif; ?>
					<div class="news-feed">
						<?php get_template_part( 'parts/hub-news' ); ?>
					</div>
					<?php if ( is_active_sidebar( 'homepage1' ) && is_active_sidebar( 'homepage2' )  ) : ?>
					    <div class="row" id="hp-buckets">
					    	<div class="small-6 columns hide-for-print" role="complementary">
					    		<div class="primary callout">
					    			<?php dynamic_sidebar('homepage1'); ?>
					    		</div> 
							</div>
							<div class="small-6 columns hide-for-print" role="complementary">
								<div class="primary callout">
					    			<?php dynamic_sidebar('homepage2'); ?>
					    		</div> 
							</div>
					    </div>
					<?php endif;?>

				</div>

			</main> <!-- end #main -->	

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>