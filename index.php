<?php
/**
 * Szablon awaryjny – przekierowuje na stronę główną (landing).
 *
 * @package autoserwis
 */

get_header();
?>

<main id="main" class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<h1><?php esc_html_e( 'Nic tu nie ma', 'autoserwis' ); ?></h1>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Wróć na stronę główną', 'autoserwis' ); ?> →</a></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
