<?php
/**
 * Szablon strony „Kontakt” (slug: kontakt).
 * Dane kontaktowe, godziny otwarcia i mapa dojazdu.
 *
 * @package autoserwis
 */

get_header();

?>

<main id="main">

	<!-- Nagłówek podstrony -->
	<section class="section page-hero">
		<div class="container">
			<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Okruszki', 'autoserwis' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'autoserwis' ); ?></a>
				<span aria-hidden="true">/</span>
				<span><?php esc_html_e( 'Kontakt', 'autoserwis' ); ?></span>
			</nav>

			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Kontakt', 'autoserwis' ); ?></p>
				<h1 class="section-head__title">
					<?php esc_html_e( 'Znajdziesz nas', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'tutaj.', 'autoserwis' ); ?></span>
				</h1>
				<p class="section-head__lead">
					<?php esc_html_e( 'Opowiedz nam, co dzieje się z samochodem. Ustalimy, co należy zrobić i umówimy dogodny termin wizyty.', 'autoserwis' ); ?>
				</p>
			</header>
		</div>
	</section>

	<!-- Dane kontaktowe i mapa -->
	<section class="section contact-page">
		<div class="container contact-page__grid">

			<div class="contact-page__cards">
				<div class="contact-card contact-card--phones reveal">
					<span class="contact-item__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="22" height="22"><path d="M21.5 16.9v2.6a1.8 1.8 0 0 1-2 1.8 18.6 18.6 0 0 1-8.1-2.9 18.3 18.3 0 0 1-5.6-5.6A18.6 18.6 0 0 1 2.9 4.6a1.8 1.8 0 0 1 1.8-2h2.6a1.8 1.8 0 0 1 1.8 1.6c.1.9.3 1.8.6 2.7a1.8 1.8 0 0 1-.4 1.9L8.1 10a15 15 0 0 0 5.6 5.6l1.2-1.2a1.8 1.8 0 0 1 1.9-.4c.9.3 1.8.5 2.7.6a1.8 1.8 0 0 1 1.6 1.8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					<h2><?php esc_html_e( 'Zadzwoń do nas', 'autoserwis' ); ?></h2>
					<p class="contact-card__note"><?php esc_html_e( 'Najszybsza droga — od razu ustalimy, co dalej.', 'autoserwis' ); ?></p>
					<?php
					get_template_part( 'template-parts/call-menu', null, array(
						'label' => __( 'Zadzwoń teraz', 'autoserwis' ),
						'class' => 'contact-card__call',
						'icon'  => false,
					) );
					?>
				</div>

				<div class="contact-card reveal" style="--d:.08s">
					<span class="contact-item__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="22" height="22"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					<h2><?php esc_html_e( 'Adres', 'autoserwis' ); ?></h2>
					<p>
						<?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?><br>
						<small><?php echo esc_html( autoserwis_get( 'address_hint', 'skrzyżowanie ulic Sowińskiego i Kusocińskiego' ) ); ?></small>
					</p>
					<a class="contact-card__link" href="https://www.google.com/maps/search/?api=1&query=ul.+Sowi%C5%84skiego+26,+Szczecin" target="_blank" rel="noopener">
						<?php esc_html_e( 'Nawiguj w Google Maps', 'autoserwis' ); ?> <span aria-hidden="true">↗</span>
					</a>
				</div>

				<div class="contact-card reveal" style="--d:.16s">
					<span class="contact-item__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="22" height="22"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 7v5l3.5 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					<h2><?php esc_html_e( 'Godziny otwarcia', 'autoserwis' ); ?></h2>
					<dl class="contact-card__hours">
						<div>
							<dt><?php esc_html_e( 'Poniedziałek – Piątek', 'autoserwis' ); ?></dt>
							<dd><?php echo esc_html( autoserwis_get( 'hours_week', '09:00 – 17:00' ) ); ?></dd>
						</div>
						<div>
							<dt><?php esc_html_e( 'Sobota', 'autoserwis' ); ?></dt>
							<dd><?php echo esc_html( autoserwis_get( 'hours_saturday', '09:00 – 14:00' ) ); ?></dd>
						</div>
						<div>
							<dt><?php esc_html_e( 'Niedziela', 'autoserwis' ); ?></dt>
							<dd><?php esc_html_e( 'nieczynne', 'autoserwis' ); ?></dd>
						</div>
					</dl>
				</div>
			</div>

			<div class="contact-page__map reveal reveal--delay" id="mapa">
				<iframe
					src="<?php echo esc_url( autoserwis_get( 'map_embed', 'https://www.google.com/maps?q=ul.+Sowi%C5%84skiego+26,+Szczecin&z=15&output=embed' ) ); ?>"
					title="<?php esc_attr_e( 'Mapa — Auto Sikora, ul. Sowińskiego 26, Szczecin', 'autoserwis' ); ?>"
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
					allowfullscreen></iframe>
				<a class="map__external" href="https://www.google.com/maps/search/?api=1&amp;query=ul.+Sowi%C5%84skiego+26,+Szczecin" target="_blank" rel="noopener">
					<?php esc_html_e( 'Otwórz w Google Maps', 'autoserwis' ); ?> <span aria-hidden="true">↗</span>
				</a>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
