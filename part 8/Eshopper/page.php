<?php get_header(); ?>


	<section>
		<div class="container">
			<div class="row">
			<?php if ( wc_get_page_id( 'cart' ) != get_the_ID()): ?>
			<?php if ( wc_get_page_id( 'checkout' ) != get_the_ID()): ?>
				<div class="col-sm-3">
					<div class="left-sidebar">
						<?php if ( is_active_sidebar( 'page-product' ) ) : ?>
	
							<?php dynamic_sidebar( 'page-product' ); ?>
	
						<?php endif; ?>
					</div>
				</div>
				
				<?php endif; ?>
				<?php endif; ?>
				<div class="  <?php if( wc_get_page_id( 'cart' ) == get_the_ID()){ echo ' ';  }elseif(wc_get_page_id( 'checkout' ) == get_the_ID()){ echo ' '; }else{ echo 'col-sm-9'; }   ?>">
					<div class="blog-post-area">
						<h2 class="title text-center"><?php the_title(); ?></h2>
						<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			?><div class="single-blog-post"> 
			
			
							<?php if ( wc_get_page_id( 'cart' ) != get_the_ID()): ?>
							<?php if ( wc_get_page_id( 'checkout' ) != get_the_ID()): ?>
								<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
									<li><i class="fa fa-clock-o"></i><?php echo get_post_time( 'g:i a', true, get_the_Id(), true ); ?> </li>
									<li><i class="fa fa-calendar"></i> <?php echo get_post_time( 'F j, Y', true, get_the_Id(), true ); ?></li>
								</ul>
								
								</div>
								<a href="<?php echo $feat_image; ?>">
								
								<img src="<?php echo $feat_image; ?>" alt="">
								</a>
								<?php endif; ?>
								<?php endif; ?>
								
							<?php 	the_content(); ?>
							`
							
			<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?> <?php 
			// End of the loop.
		endwhile;
		?>
								
						
						
						
					</div>
				</div>
			</div>
		</div>
	</section>
	

<?php get_footer(); ?>