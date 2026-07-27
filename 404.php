<?php
/**
 * Strona błędu 404.
 *
 * @package autoserwis
 */

get_header();
?>

<main id="main">
	<section class="section page-hero">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Błąd 404', 'autoserwis' ); ?></p>
				<h1 class="section-head__title">
					<?php esc_html_e( 'Tej strony', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'nie znaleźliśmy.', 'autoserwis' ); ?></span>
				</h1>
				<p class="section-head__lead">
					<?php esc_html_e( 'Adres mógł się zmienić albo zawiera literówkę. Wróć na stronę główną lub sprawdź, co robimy.', 'autoserwis' ); ?>
				</p>
			</header>

			<div class="services-cta__actions reveal">
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Strona główna', 'autoserwis' ); ?>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<?php esc_html_e( 'Zobacz usługi', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
