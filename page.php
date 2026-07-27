<?php
/**
 * Domyślny szablon strony.
 *
 * Obsługuje strony tworzone w edytorze — zarówno blokowym (Gutenberg),
 * jak i przez kreatory typu Elementor. Treść dostaje klasę .entry-content,
 * dzięki czemu bloki dziedziczą typografię motywu.
 *
 * @package autoserwis
 */

get_header();
?>

<main id="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( ! autoserwis_is_page_builder() ) : ?>
			<section class="section page-hero">
				<div class="container">
					<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Okruszki', 'autoserwis' ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'autoserwis' ); ?></a>
						<span aria-hidden="true">/</span>
						<span><?php the_title(); ?></span>
					</nav>

					<header class="section-head reveal">
						<h1 class="section-head__title"><?php the_title(); ?></h1>
					</header>
				</div>
			</section>
		<?php endif; ?>

		<section class="section page-content<?php echo autoserwis_is_page_builder() ? ' page-content--builder' : ''; ?>">
			<div class="container">
				<?php if ( has_post_thumbnail() && ! autoserwis_is_page_builder() ) : ?>
					<figure class="page-content__thumb reveal">
						<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
					</figure>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<nav class="page-links">',
						'after'  => '</nav>',
					) );
					?>
				</div>
			</div>
		</section>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>
