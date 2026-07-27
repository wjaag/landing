<?php
/**
 * Strona błędu 404.
 *
 * Zamiast ślepego zaułka — duży komunikat, telefon pod ręką
 * i skróty do najważniejszych miejsc w serwisie.
 *
 * @package autoserwis
 */

get_header();

$img = get_template_directory_uri() . '/assets/images';

/**
 * Skróty pokazywane pod komunikatem. Ikona dobrana do celu,
 * żeby lista czytała się jednym rzutem oka.
 */
$error_links = array(
	array(
		'url'   => home_url( '/uslugi/' ),
		'title' => __( 'Zakres usług', 'autoserwis' ),
		'desc'  => __( 'Mechanika, blacharstwo, lakiernictwo i pomoc po kolizji.', 'autoserwis' ),
		'icon'  => '<path d="M15.5 3.8a5 5 0 0 0-6.1 6.6L3.6 16.2a2 2 0 0 0 2.8 2.8l5.8-5.8a5 5 0 0 0 6.6-6.1l-2.9 2.9-2.8-.7-.7-2.8 2.9-2.9Z"/>',
	),
	array(
		'url'   => home_url( '/jak-dzialamy/' ),
		'title' => __( 'Jak działamy', 'autoserwis' ),
		'desc'  => __( 'Od pierwszego telefonu po odbiór gotowego auta.', 'autoserwis' ),
		'icon'  => '<circle cx="10.5" cy="10.5" r="6.5"/><path d="m20.5 20.5-4.8-4.8"/><path d="M7.5 11h1.6l1.2-2.2 1.4 4 1.1-1.8h1.7"/>',
	),
	array(
		'url'   => home_url( '/kontakt/' ),
		'title' => __( 'Kontakt i dojazd', 'autoserwis' ),
		'desc'  => __( 'Adres, godziny otwarcia i mapa dojazdu do warsztatu.', 'autoserwis' ),
		'icon'  => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
	),
);
?>

<main id="main">

	<section class="section error-page">
		<div class="container error-page__grid">

			<div class="error-page__content reveal">
				<p class="eyebrow">
					<span class="eyebrow__dot" aria-hidden="true"></span>
					<?php esc_html_e( 'Błąd 404', 'autoserwis' ); ?>
				</p>

				<p class="error-page__code" aria-hidden="true">404</p>

				<h1 class="error-page__title">
					<?php esc_html_e( 'Tej strony', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'nie znaleźliśmy.', 'autoserwis' ); ?></span>
				</h1>

				<p class="error-page__lead">
					<?php esc_html_e( 'Adres mógł się zmienić albo zawiera literówkę. Nic straconego — poniżej znajdziesz to, czego zwykle szukają nasi klienci.', 'autoserwis' ); ?>
				</p>

				<div class="error-page__actions">
					<a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Wróć na stronę główną', 'autoserwis' ); ?>
						<span aria-hidden="true">→</span>
					</a>
					<?php
					get_template_part(
						'template-parts/call-menu',
						null,
						array(
							'label' => __( 'Zadzwoń teraz', 'autoserwis' ),
							'class' => 'button--secondary error-page__call',
							'icon'  => true,
						)
					);
					?>
				</div>

				<ul class="error-page__links">
					<?php foreach ( $error_links as $i => $link ) : ?>
						<li>
							<a class="error-link" href="<?php echo esc_url( $link['url'] ); ?>" style="--d:<?php echo esc_attr( $i * 0.06 ); ?>s">
								<span class="error-link__icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="22" height="22">
										<?php echo $link['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
									</svg>
								</span>
								<span class="error-link__body">
									<strong><?php echo esc_html( $link['title'] ); ?></strong>
									<?php echo esc_html( $link['desc'] ); ?>
								</span>
								<span class="error-link__arrow" aria-hidden="true">↗</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<figure class="error-page__figure reveal reveal--delay">
				<picture>
					<source media="(max-width: 640px)" srcset="<?php echo esc_url( "$img/hero-workshop-sm.webp" ); ?>">
					<img src="<?php echo esc_url( "$img/hero-workshop.webp" ); ?>"
						alt="<?php esc_attr_e( 'Warsztat samochodowy Auto Sikora', 'autoserwis' ); ?>"
						width="1600" height="898" loading="lazy" decoding="async">
				</picture>
			</figure>

		</div>
	</section>

</main>

<?php get_footer(); ?>
