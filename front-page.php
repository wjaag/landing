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
		<div class="container">

			<div class="hero__top">

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
				</div>

				<div class="hero__aside reveal reveal--delay">
					<figure class="hero__figure">
						<picture>
							<source media="(max-width: 640px)" srcset="<?php echo esc_url( "$img/hero-workshop-sm.webp" ); ?>">
							<img src="<?php echo esc_url( "$img/hero-workshop.webp" ); ?>"
								alt="<?php esc_attr_e( 'Auto Sikora — warsztat samochodowy w Szczecinie', 'autoserwis' ); ?>"
								width="1600" height="898" fetchpriority="high" decoding="async">
						</picture>
						<figcaption class="hero__overlay">
							<span class="hero__facts">
								<span class="hero__fact">
									<small><?php esc_html_e( 'Adres', 'autoserwis' ); ?></small>
									<strong><?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?></strong>
								</span>
								<span class="hero__fact">
									<small><?php esc_html_e( 'Pon.–Pt.', 'autoserwis' ); ?></small>
									<strong><?php echo esc_html( autoserwis_get( 'hours_week', '09:00 – 17:00' ) ); ?></strong>
								</span>
								<span class="hero__fact">
									<small><?php esc_html_e( 'Sobota', 'autoserwis' ); ?></small>
									<strong><?php echo esc_html( autoserwis_get( 'hours_saturday', '09:00 – 14:00' ) ); ?></strong>
								</span>
							</span>
							<span class="hero__phones">
								<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
									<span class="hero__phone-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="20" height="20"><rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/><path d="M10.5 18.5h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
									<span class="hero__phone-text">
										<small><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></small>
										<strong><?php echo esc_html( $tel_mob ); ?></strong>
									</span>
								</a>
								<a class="hero__phone" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
									<span class="hero__phone-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="20" height="20"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.5 2.9.7a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
									<span class="hero__phone-text">
										<small><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></small>
										<strong><?php echo esc_html( $tel_land ); ?></strong>
									</span>
								</a>
							</span>
						</figcaption>
					</figure>
				</div>

			</div>

			<div class="hero__cases" id="uslugi">
				<p class="hero__cases-heading reveal">
					<span class="hero__cases-title"><?php esc_html_e( 'Czego potrzebujesz?', 'autoserwis' ); ?></span>
					<span class="hero__cases-sub"><?php esc_html_e( 'Najczęstsze przypadki', 'autoserwis' ); ?></span>
				</p>
				<div class="case-grid">
					<a class="case-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'po-kolizji' ) ); ?>">
						<img class="case-card__bg" src="<?php echo esc_url( "$img/service-collision.webp" ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" width="900" height="600">
						<span class="case-card__veil" aria-hidden="true"></span>
						<span class="case-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="24" height="24"><path d="M2 12h3l1.6-4.2A2 2 0 0 1 8.5 6.5h7a2 2 0 0 1 1.9 1.3L19 12h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 12h16v4.5a1 1 0 0 1-1 1h-1.5a1 1 0 0 1-1-1V16h-9v.5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m13 2-2.4 4.5h3.2L11.5 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
						<span class="case-card__body">
							<strong><?php esc_html_e( 'Po kolizji', 'autoserwis' ); ?></strong>
							<?php esc_html_e( 'Pomoc po stłuczce lub wypadku.', 'autoserwis' ); ?>
						</span>
						<span class="case-card__arrow" aria-hidden="true">↗</span>
					</a>
					<a class="case-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'mechanika' ) ); ?>" style="--d:.06s">
						<img class="case-card__bg" src="<?php echo esc_url( "$img/service-mechanics.webp" ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" width="900" height="600">
						<span class="case-card__veil" aria-hidden="true"></span>
						<span class="case-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="24" height="24"><path d="M15.5 3.8a5 5 0 0 0-6.1 6.6L3.6 16.2a2 2 0 0 0 2.8 2.8l5.8-5.8a5 5 0 0 0 6.6-6.1l-2.9 2.9-2.8-.7-.7-2.8 2.9-2.9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
						<span class="case-card__body">
							<strong><?php esc_html_e( 'Naprawa auta', 'autoserwis' ); ?></strong>
							<?php esc_html_e( 'Diagnostyka i naprawy mechaniczne.', 'autoserwis' ); ?>
						</span>
						<span class="case-card__arrow" aria-hidden="true">↗</span>
					</a>
					<a class="case-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'blacharstwo' ) ); ?>" style="--d:.12s">
						<img class="case-card__bg" src="<?php echo esc_url( "$img/service-bodywork.webp" ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" width="900" height="600">
						<span class="case-card__veil" aria-hidden="true"></span>
						<span class="case-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="24" height="24"><path d="m14.5 2.5 7 7-3 3-7-7 3-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m11.5 5.5-8 8a2.1 2.1 0 0 0 0 3l1 1a2.1 2.1 0 0 0 3 0l8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
						<span class="case-card__body">
							<strong><?php esc_html_e( 'Blacharka', 'autoserwis' ); ?></strong>
							<?php esc_html_e( 'Naprawy karoserii i nadwozia.', 'autoserwis' ); ?>
						</span>
						<span class="case-card__arrow" aria-hidden="true">↗</span>
					</a>
					<a class="case-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'lakiernictwo' ) ); ?>" style="--d:.18s">
						<img class="case-card__bg" src="<?php echo esc_url( "$img/service-paint.webp" ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" width="900" height="600">
						<span class="case-card__veil" aria-hidden="true"></span>
						<span class="case-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="24" height="24"><path d="M4 3h9v5H4V3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M13 5.5h4a2 2 0 0 1 2 2V10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 8v3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M5.5 11.5h5a1.5 1.5 0 0 1 1.5 1.5v7a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 20v-7a1.5 1.5 0 0 1 1.5-1.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg></span>
						<span class="case-card__body">
							<strong><?php esc_html_e( 'Lakierowanie', 'autoserwis' ); ?></strong>
							<?php esc_html_e( 'Precyzyjne lakierowanie elementów.', 'autoserwis' ); ?>
						</span>
						<span class="case-card__arrow" aria-hidden="true">↗</span>
					</a>
				</div>
			</div>

		</div>
	</section>

	<!-- ============================================================
	     ZAKRES USŁUG
	============================================================ -->
	<section class="section section--alt services" id="zakres">
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
				<a class="service-card service-card--featured reveal" href="<?php echo esc_url( autoserwis_service_url( 'odszkodowania' ) ); ?>">
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

				<a class="service-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'klimatyzacja' ) ); ?>" style="--d:.06s">
					<img src="<?php echo esc_url( "$img/extra-ac.webp" ); ?>" alt="<?php esc_attr_e( 'Serwis klimatyzacji samochodowej', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">02</span>
						<strong><?php esc_html_e( 'Klimatyzacja', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Serwisujemy klimatyzacje od ręki w każdego rodzaju pojazdach.', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'auto-zastepcze' ) ); ?>" style="--d:.12s">
					<img src="<?php echo esc_url( "$img/extra-replacement.webp" ); ?>" alt="<?php esc_attr_e( 'Auto zastępcze na czas naprawy', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">03</span>
						<strong><?php esc_html_e( 'Auto zastępcze', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Na czas naprawy oferujemy auto zastępcze.', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'skup-pojazdow' ) ); ?>" style="--d:.18s">
					<img src="<?php echo esc_url( "$img/extra-buyout.webp" ); ?>" alt="<?php esc_attr_e( 'Skup pojazdów', 'autoserwis' ); ?>" loading="lazy" decoding="async" width="900" height="600">
					<span class="service-card__overlay"></span>
					<span class="service-card__content">
						<span class="service-card__num">04</span>
						<strong><?php esc_html_e( 'Skup pojazdów', 'autoserwis' ); ?></strong>
						<span class="service-card__desc"><?php esc_html_e( 'Chcesz sprzedać auto? Przyjedź, dogadamy się!', 'autoserwis' ); ?></span>
						<span class="service-card__arrow" aria-hidden="true">→</span>
					</span>
				</a>

				<a class="service-card reveal" href="<?php echo esc_url( autoserwis_service_url( 'konserwacja' ) ); ?>" style="--d:.24s">
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
						<span class="contact__call-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="20" height="20"><rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/><path d="M10.5 18.5h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
						<span class="contact__call-text">
							<span><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></span>
							<strong><?php echo esc_html( $tel_mob ); ?> <span aria-hidden="true">→</span></strong>
						</span>
					</a>
					<a class="contact__call" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
						<span class="contact__call-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="20" height="20"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.5 2.9.7a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
						<span class="contact__call-text">
							<span><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></span>
							<strong><?php echo esc_html( $tel_land ); ?> <span aria-hidden="true">→</span></strong>
						</span>
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
