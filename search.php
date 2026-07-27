<?php
/**
 * Wyniki wyszukiwania.
 *
 * @package autoserwis
 */

get_header();
?>

<main id="main">
	<section class="section page-hero">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Wyszukiwanie', 'autoserwis' ); ?></p>
				<h1 class="section-head__title">
					<?php
					printf(
						/* translators: %s: szukana fraza. */
						esc_html__( 'Wyniki dla: %s', 'autoserwis' ),
						'<span class="accent">' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			</header>
			<?php get_search_form(); ?>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="entry-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="entry-card reveal">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination( array( 'class' => 'page-links' ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Nic nie znaleźliśmy. Spróbuj innego hasła albo zadzwoń — chętnie pomożemy.', 'autoserwis' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
