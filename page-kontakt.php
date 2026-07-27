<?php
/**
 * Szablon strony „Kontakt” (slug: kontakt).
 * Dane kontaktowe, godziny otwarcia i mapa dojazdu.
 *
 * @package autoserwis
 */

get_header();

$tel_mob  = autoserwis_get( 'phone_mobile', '509 499 101' );
$tel_land = autoserwis_get( 'phone_landline', '91 812 11 92' );
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

	<!-- Dane kontaktowe -->
	<section class="section contact-page">
		<div class="container">
			<div class="contact-page__grid">

				<div class="contact-card contact-card--phones reveal">
					<span class="contact-item__num">01</span>
					<h2><?php esc_html_e( 'Zadzwoń do nas', 'autoserwis' ); ?></h2>
					<p class="contact-card__note"><?php esc_html_e( 'Najszybsza droga — od razu ustalimy, co dalej.', 'autoserwis' ); ?></p>
					<div class="contact-card__phones">
						<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
							<small><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></small>
							<strong><?php echo esc_html( $tel_mob ); ?></strong>
						</a>
						<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
							<small><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></small>
							<strong><?php echo esc_html( $tel_land ); ?></strong>
						</a>
					</div>
					<a class="button button--primary" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
						<?php esc_html_e( 'Zadzwoń teraz', 'autoserwis' ); ?> <span aria-hidden="true">→</span>
					</a>
				</div>

				<div class="contact-card reveal" style="--d:.08s">
					<span class="contact-item__num">02</span>
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
					<span class="contact-item__num">03</span>
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
		</div>
	</section>

	<!-- Dojazd i przygotowanie do wizyty -->
	<section class="section section--alt visit">
		<div class="container visit__grid">

			<div class="reveal">
				<header class="section-head section-head--left">
					<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Dojazd', 'autoserwis' ); ?></p>
					<h2 class="section-head__title"><?php esc_html_e( 'Jak do nas trafić', 'autoserwis' ); ?></h2>
				</header>
				<div class="visit__text">
					<p>
						<?php esc_html_e( 'Warsztat znajdziesz przy ulicy Sowińskiego 26 w Szczecinie, na Nowym Mieście, tuż przy skrzyżowaniu z Kusocińskiego. To kilka minut od centrum i dogodny dojazd zarówno od strony Potulickiej, jak i alei Piastów.', 'autoserwis' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Przed budynkiem jest miejsce na pozostawienie auta — nie musisz szukać parkingu w okolicy. Jeśli przyjeżdżasz komunikacją miejską, najbliższe przystanki tramwajowe i autobusowe znajdują się przy Sowińskiego, kilkadziesiąt metrów od wjazdu.', 'autoserwis' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Auto po kolizji, którym nie da się jechać? Zadzwoń — podpowiemy, jak zorganizować transport i co zrobić, żeby nie stracić prawa do odszkodowania.', 'autoserwis' ); ?>
					</p>
				</div>
			</div>

			<div class="reveal reveal--delay">
				<header class="section-head section-head--left">
					<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Przed wizytą', 'autoserwis' ); ?></p>
					<h2 class="section-head__title"><?php esc_html_e( 'Co warto przygotować', 'autoserwis' ); ?></h2>
				</header>
				<ul class="visit__list">
					<li>
						<strong><?php esc_html_e( 'Dowód rejestracyjny', 'autoserwis' ); ?></strong>
						<?php esc_html_e( 'Potrzebny do identyfikacji pojazdu i dokumentacji naprawy.', 'autoserwis' ); ?>
					</li>
					<li>
						<strong><?php esc_html_e( 'Opis objawów', 'autoserwis' ); ?></strong>
						<?php esc_html_e( 'Kiedy problem się pojawia, przy jakiej prędkości, czy słychać hałas — to skraca diagnozę.', 'autoserwis' ); ?>
					</li>
					<li>
						<strong><?php esc_html_e( 'Numer szkody', 'autoserwis' ); ?></strong>
						<?php esc_html_e( 'Przy naprawie powypadkowej — jeśli zgłosiłeś już sprawę ubezpieczycielowi.', 'autoserwis' ); ?>
					</li>
					<li>
						<strong><?php esc_html_e( 'Historia serwisowa', 'autoserwis' ); ?></strong>
						<?php esc_html_e( 'Jeśli ją masz. Pomaga ocenić, co wymieniano wcześniej i kiedy.', 'autoserwis' ); ?>
					</li>
				</ul>

				<p class="visit__note">
					<?php esc_html_e( 'Obsługujemy wszystkie marki samochodów osobowych i dostawczych — od aut kilkuletnich na gwarancji po pojazdy z długim przebiegiem. Nie odsyłamy do autoryzowanych stacji: diagnostykę komputerową, naprawy mechaniczne, blacharkę i lakiernictwo wykonujemy na miejscu, w jednym warsztacie.', 'autoserwis' ); ?>
				</p>
			</div>

		</div>
	</section>

	<!-- Mapa -->
	<section class="map" id="mapa" aria-label="<?php esc_attr_e( 'Mapa dojazdu', 'autoserwis' ); ?>">
		<iframe
			src="<?php echo esc_url( autoserwis_get( 'map_embed', 'https://www.google.com/maps?q=ul.+Sowi%C5%84skiego+26,+Szczecin&z=15&output=embed' ) ); ?>"
			title="<?php esc_attr_e( 'Mapa — Auto Sikora, ul. Sowińskiego 26, Szczecin', 'autoserwis' ); ?>"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"
			allowfullscreen></iframe>
		<a class="map__external" href="https://www.google.com/maps/search/?api=1&query=ul.+Sowi%C5%84skiego+26,+Szczecin" target="_blank" rel="noopener">
			<?php esc_html_e( 'Otwórz w Google Maps', 'autoserwis' ); ?> <span aria-hidden="true">↗</span>
		</a>
	</section>

</main>

<?php get_footer(); ?>
