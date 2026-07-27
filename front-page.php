<?php
/**
 * Strona główna – landing page.
 *
 * @package autoserwis
 */

get_header();

$img       = get_template_directory_uri() . '/assets/images';
$tel_mob   = autoserwis_get( 'phone_mobile', '509 499 101' );
$tel_land  = autoserwis_get( 'phone_landline', '91 812 11 92' );
?>

<main id="main">

	<!-- ============================================================
	     HERO
	============================================================ -->
	<section class="section hero" id="start">
		<div class="container hero__grid">

			<div class="hero__content reveal">
				<p class="eyebrow">
					<span class="eyebrow__dot" aria-hidden="true"></span>
					<?php esc_html_e( 'Serwis samochodowy · Szczecin', 'autoserwis' ); ?>
				</p>

				<h1 class="hero__title">
					<?php esc_html_e( 'Masz problem z autem?', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Pomożemy.', 'autoserwis' ); ?></span>
				</h1>

				<p class="hero__lead">
					<?php esc_html_e( 'Kompleksowy serwis samochodowy, blacharstwo i lakiernictwo. Zajmiemy się Twoim autem od diagnozy aż po odbiór gotowego samochodu.', 'autoserwis' ); ?>
				</p>

				<div class="hero__cta">
					<div class="hero__phones">
						<span class="hero__phones-label"><?php esc_html_e( 'Zadzwoń', 'autoserwis' ); ?> <span aria-hidden="true">→</span></span>
						<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
							<small><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></small>
							<strong><?php echo esc_html( $tel_land ); ?></strong>
						</a>
						<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
							<small><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></small>
							<strong><?php echo esc_html( $tel_mob ); ?></strong>
						</a>
					</div>
				</div>

				<div class="hero__cases" id="uslugi">
					<p class="hero__cases-heading">
						<?php esc_html_e( 'Czego potrzebujesz?', 'autoserwis' ); ?>
						<span><?php esc_html_e( 'Najczęstsze przypadki', 'autoserwis' ); ?></span>
					</p>
					<div class="case-grid">
						<a class="case-card" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
							<span class="case-card__num">01</span>
							<span class="case-card__body">
								<strong><?php esc_html_e( 'Po kolizji', 'autoserwis' ); ?></strong>
								<?php esc_html_e( 'Pomoc po stłuczce lub wypadku.', 'autoserwis' ); ?>
							</span>
							<span class="case-card__arrow" aria-hidden="true">↗</span>
						</a>
						<a class="case-card" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
							<span class="case-card__num">02</span>
							<span class="case-card__body">
								<strong><?php esc_html_e( 'Naprawa auta', 'autoserwis' ); ?></strong>
								<?php esc_html_e( 'Diagnostyka i naprawy mechaniczne.', 'autoserwis' ); ?>
							</span>
							<span class="case-card__arrow" aria-hidden="true">↗</span>
						</a>
						<a class="case-card" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
							<span class="case-card__num">03</span>
							<span class="case-card__body">
								<strong><?php esc_html_e( 'Blacharka', 'autoserwis' ); ?></strong>
								<?php esc_html_e( 'Naprawy karoserii i elementów nadwozia.', 'autoserwis' ); ?>
							</span>
							<span class="case-card__arrow" aria-hidden="true">↗</span>
						</a>
						<a class="case-card" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
							<span class="case-card__num">04</span>
							<span class="case-card__body">
								<strong><?php esc_html_e( 'Lakierowanie', 'autoserwis' ); ?></strong>
								<?php esc_html_e( 'Precyzyjne lakierowanie elementów auta.', 'autoserwis' ); ?>
							</span>
							<span class="case-card__arrow" aria-hidden="true">↗</span>
						</a>
					</div>
				</div>
			</div>

			<div class="hero__media reveal reveal--delay">
				<figure class="hero__figure">
					<picture>
						<source media="(max-width: 640px)" srcset="<?php echo esc_url( "$img/hero-workshop-sm.webp" ); ?>">
						<img src="<?php echo esc_url( "$img/hero-workshop.webp" ); ?>"
							alt="<?php esc_attr_e( 'Auto Sikora — warsztat samochodowy w Szczecinie', 'autoserwis' ); ?>"
							width="1600" height="898" fetchpriority="high" decoding="async">
					</picture>
					<figcaption class="hero__badge">
						<strong>Auto Sikora</strong>
						<span><?php esc_html_e( 'Warsztat samochodowy', 'autoserwis' ); ?></span>
					</figcaption>
				</figure>

				<aside class="hero__info-card">
					<p class="hero__info-label"><?php esc_html_e( 'Zapraszamy', 'autoserwis' ); ?></p>
					<p class="hero__info-address">
						<?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?><br>
						<small><?php echo esc_html( autoserwis_get( 'address_hint', 'skrzyżowanie ulic Sowińskiego i Kusocińskiego' ) ); ?></small>
					</p>
					<dl class="hero__hours">
						<div>
							<dt><?php esc_html_e( 'Poniedziałek – Piątek', 'autoserwis' ); ?></dt>
							<dd><?php echo esc_html( autoserwis_get( 'hours_week', '09:00 – 17:00' ) ); ?></dd>
						</div>
						<div>
							<dt><?php esc_html_e( 'Sobota', 'autoserwis' ); ?></dt>
							<dd><?php echo esc_html( autoserwis_get( 'hours_saturday', '09:00 – 14:00' ) ); ?></dd>
						</div>
					</dl>
				</aside>
			</div>

		</div>
	</section>

	<!-- ============================================================
	     PROCES
	============================================================ -->
	<section class="section process" id="proces">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Jak działamy', 'autoserwis' ); ?></p>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Prosty proces.', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadowolony klient.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead">
					<?php esc_html_e( 'Bez zbędnych formalności. Kontaktujesz się z nami, ustalamy zakres prac, a my zajmujemy się resztą.', 'autoserwis' ); ?>
				</p>
			</header>

			<ol class="process-grid">
				<li class="process-step reveal">
					<span class="process-step__num">01</span>
					<h3><?php esc_html_e( 'Kontakt', 'autoserwis' ); ?></h3>
					<p><?php esc_html_e( 'Zadzwoń do nas i opowiedz, czego potrzebuje Twój samochód. Umówimy się na wizytę.', 'autoserwis' ); ?></p>
				</li>
				<li class="process-step reveal" style="--d:.08s">
					<span class="process-step__num">02</span>
					<h3><?php esc_html_e( 'Diagnoza', 'autoserwis' ); ?></h3>
					<p><?php esc_html_e( 'Oglądamy samochód, oceniamy zakres naprawy i przedstawiamy Ci konkretne rozwiązanie.', 'autoserwis' ); ?></p>
				</li>
				<li class="process-step reveal" style="--d:.16s">
					<span class="process-step__num">03</span>
					<h3><?php esc_html_e( 'Naprawa', 'autoserwis' ); ?></h3>
					<p><?php esc_html_e( 'Nasi fachowcy wykonują ustalone prace zgodnie ze sztuką i z dbałością o każdy detal.', 'autoserwis' ); ?></p>
				</li>
				<li class="process-step reveal" style="--d:.24s">
					<span class="process-step__num">04</span>
					<h3><?php esc_html_e( 'Odbiór auta', 'autoserwis' ); ?></h3>
					<p><?php esc_html_e( 'Odbierasz sprawny i gotowy do drogi samochód. Prosto, konkretnie i bez niepotrzebnych komplikacji.', 'autoserwis' ); ?></p>
				</li>
			</ol>
		</div>
	</section>

	<!-- ============================================================
	     ZAKRES USŁUG
	============================================================ -->
	<section class="section services" id="zakres">
		<div class="container">
			<div class="services__head reveal">
				<header class="section-head section-head--left">
					<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Zakres usług', 'autoserwis' ); ?></p>
					<h2 class="section-head__title">
						<?php esc_html_e( 'Pomożemy również', 'autoserwis' ); ?>
						<span class="accent"><?php esc_html_e( 'w innych sprawach', 'autoserwis' ); ?></span>
					</h2>
					<p class="section-head__lead">
						<?php esc_html_e( 'Świadczymy profesjonalne usługi. Wiedza poparta 30-letnim doświadczeniem pozwala nam zapewnić ich najwyższą jakość.', 'autoserwis' ); ?>
					</p>
				</header>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<?php esc_html_e( 'Sprawdź szczegóły', 'autoserwis' ); ?> <span aria-hidden="true">→</span>
				</a>
			</div>

			<div class="service-grid">
				<a class="service-card service-card--featured reveal" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<img src="<?php echo esc_url( "$img/extra-legal.webp" ); ?>" alt="<?php esc_attr_e( 'Dochodzenie odszkodowań po kolizji', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__tag"><?php esc_html_e( 'Najczęściej wybierane', 'autoserwis' ); ?></span>
					<span class="service-card__content">
						<span class="service-card__num">01</span>
						<strong><?php esc_html_e( 'Dochodzenie odszkodowań', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Otoczymy Cię pełną opieką prawną, abyś spokojnie mógł dochodzić swoich praw. Mamy na koncie ponad 100 wygranych spraw!', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>" style="--d:.06s">
					<img src="<?php echo esc_url( "$img/extra-ac.webp" ); ?>" alt="<?php esc_attr_e( 'Serwis klimatyzacji samochodowej', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">02</span>
						<strong><?php esc_html_e( 'Klimatyzacja', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Serwisujemy klimatyzacje od ręki w każdego rodzaju pojazdach.', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>" style="--d:.12s">
					<img src="<?php echo esc_url( "$img/extra-replacement.webp" ); ?>" alt="<?php esc_attr_e( 'Auto zastępcze na czas naprawy', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">03</span>
						<strong><?php esc_html_e( 'Auto zastępcze', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Na czas naprawy oferujemy auto zastępcze.', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>" style="--d:.18s">
					<img src="<?php echo esc_url( "$img/extra-buyout.webp" ); ?>" alt="<?php esc_attr_e( 'Skup pojazdów', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">04</span>
						<strong><?php esc_html_e( 'Skup pojazdów', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Chcesz sprzedać auto? Przyjedź, dogadamy się!', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>" style="--d:.24s">
					<img src="<?php echo esc_url( "$img/extra-maintenance.webp" ); ?>" alt="<?php esc_attr_e( 'Konserwacja pojazdów', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">05</span>
						<strong><?php esc_html_e( 'Konserwacja', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Przeprowadzamy pełną konserwację pojazdów.', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>
			</div>
		</div>
	</section>

	<!-- ============================================================
	     KONTAKT
	============================================================ -->
	<section class="section contact" id="kontakt">
		<div class="container contact__grid">

			<div class="contact__intro reveal">
				<p class="eyebrow eyebrow--light"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Kontakt', 'autoserwis' ); ?></p>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Znajdziesz nas', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'tutaj.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead">
					<?php esc_html_e( 'Opowiedz nam, co dzieje się z samochodem. Ustalimy, co należy zrobić i umówimy dogodny termin wizyty.', 'autoserwis' ); ?>
				</p>

				<div class="contact__calls">
					<a class="contact__call" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
						<span><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></span>
						<strong><?php echo esc_html( $tel_mob ); ?> <span aria-hidden="true">→</span></strong>
					</a>
					<a class="contact__call" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
						<span><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></span>
						<strong><?php echo esc_html( $tel_land ); ?> <span aria-hidden="true">→</span></strong>
					</a>
				</div>

				<ul class="contact__list">
					<li class="contact-item">
						<span class="contact-item__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="22" height="22"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/></svg></span>
						<div>
							<h3><?php esc_html_e( 'Adres', 'autoserwis' ); ?></h3>
							<p>
								<?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?><br>
								<small><?php echo esc_html( autoserwis_get( 'address_hint', 'skrzyżowanie ulic Sowińskiego i Kusocińskiego' ) ); ?></small>
							</p>
						</div>
					</li>
					<li class="contact-item">
						<span class="contact-item__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="22" height="22"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3.5 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
						<div>
							<h3><?php esc_html_e( 'Godziny otwarcia', 'autoserwis' ); ?></h3>
							<p>
								<?php esc_html_e( 'Pon.–Pt.:', 'autoserwis' ); ?> <?php echo esc_html( autoserwis_get( 'hours_week', '09:00 – 17:00' ) ); ?><br>
								<?php esc_html_e( 'Sobota:', 'autoserwis' ); ?> <?php echo esc_html( autoserwis_get( 'hours_saturday', '09:00 – 14:00' ) ); ?>
							</p>
						</div>
					</li>
				</ul>
			</div>

			<div class="contact__map reveal reveal--delay" id="mapa">
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
