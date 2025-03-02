<?php
/**
 * Template Name: Full Width
 *
 * Template for displaying a full width content.
 */

get_header(); ?>

<div class="page-wrapper">
    
    <div id="content" class="container">
        
		<main id="full-width" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
						<header class="entry-header">
						
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						
						</header><!-- .entry-header -->
						
						<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?>

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'srdolil' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">

						<?php //edit_post_link( __( 'Edit', 'dolil' ), '<span class="edit-link">', '</span>' ); ?>

					</footer><!-- .entry-footer -->

				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
        
	</div><!-- .container -->
    
</div><!-- .page-wrapper -->

<?php get_footer(); ?>