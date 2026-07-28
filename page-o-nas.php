<?php
/**
 * Szablon strony „O nas” (slug: o-nas).
 * Historia warsztatu, zespół i podejście do klienta.
 *
 * @package autoserwis
 */

get_header();

$img = get_template_directory_uri() . '/assets/images';

/**
 * Kamienie milowe firmy. Rok jako liczba, bo to konkret,
 * który buduje zaufanie szybciej niż deklaracje.
 */
$milestones = array(
	array(
		'year' => '1993',
		'title' => __( 'Początek — usługi holownicze', 'autoserwis' ),
		'desc'  => __( 'Zaczynaliśmy od pomocy drogowej w Szczecinie. Holowaliśmy auta po kolizjach i awariach, poznając od podszewki najczęstsze problemy kierowców.', 'autoserwis' ),
	),
	array(
		'year' => 'lata 90.',
		'title' => __( 'Mechanika i diagnostyka', 'autoserwis' ),
		'desc'  => __( 'Kilka lat później otworzyliśmy warsztat mechaniczny. Do holowania doszły naprawy silników, zawieszeń i układów hamulcowych oraz diagnostyka komputerowa.', 'autoserwis' ),
	),
	array(
		'year' => 'obecnie',
		'title' => __( 'Kompleksowy serwis', 'autoserwis' ),
		'desc'  => __( 'Dziś pod jednym dachem prowadzimy mechanikę, blacharstwo, lakiernictwo i obsługę szkód komunikacyjnych — od zgłoszenia u ubezpieczyciela po odbiór gotowego auta.', 'autoserwis' ),
	),
);

/**
 * Zasady pracy — to, co klient realnie odczuwa w kontakcie z warsztatem.
 */
$values = array(
	array(
		'title' => __( 'Bezpieczeństwo przede wszystkim', 'autoserwis' ),
		'desc'  => __( 'Nie wypuszczamy auta, którym sami nie pojechalibyśmy w trasę. Jeśli podczas naprawy znajdziemy coś, co zagraża bezpieczeństwu, powiemy o tym wprost.', 'autoserwis' ),
		'icon'  => '<path d="M12 2.5 4.5 5.5v6c0 4.6 3.2 8.7 7.5 10 4.3-1.3 7.5-5.4 7.5-10v-6L12 2.5Z"/><path d="m9 12 2.2 2.2L15.5 10"/>',
	),
	array(
		'title' => __( 'Wycena przed naprawą', 'autoserwis' ),
		'desc'  => __( 'Zakres prac i koszt ustalamy przed rozpoczęciem. Nie dokładamy pozycji bez Twojej zgody, a o każdej zmianie informujemy telefonicznie.', 'autoserwis' ),
		'icon'  => '<rect x="3.5" y="3" width="17" height="18" rx="2.5"/><path d="M8 8.5h8M8 12.5h8M8 16.5h5"/>',
	),
	array(
		'title' => __( 'Doświadczony zespół', 'autoserwis' ),
		'desc'  => __( 'Naszą ekipę tworzą mechanicy z wieloletnią praktyką, którzy pracują z autami każdej marki — od kilkuletnich po pojazdy z długim przebiegiem.', 'autoserwis' ),
		'icon'  => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20.5a6.5 6.5 0 0 1 13 0"/><path d="M16 5.2a3.5 3.5 0 0 1 0 5.6M18.5 20.5a6.5 6.5 0 0 0-3-5.5"/>',
	),
	array(
		'title' => __( 'Wszystko w jednym miejscu', 'autoserwis' ),
		'desc'  => __( 'Mechanika, blacharka, lakiernictwo i formalności z ubezpieczycielem. Nie odsyłamy Cię do trzech różnych firm — załatwiasz sprawę u nas.', 'autoserwis' ),
		'icon'  => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
	),
);
?>

<main id="main">

	<!-- Nagłówek podstrony -->
	<section class="section page-hero about-hero">
		<div class="container">
			<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Okruszki', 'autoserwis' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'autoserwis' ); ?></a>
				<span aria-hidden="true">/</span>
				<span><?php esc_html_e( 'O nas', 'autoserwis' ); ?></span>
			</nav>

			<div class="about-hero__grid">
				<header class="section-head section-head--left reveal">
					<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'O nas', 'autoserwis' ); ?></p>
					<h1 class="section-head__title">
						<?php esc_html_e( 'Warsztat samochodowy w Szczecinie', 'autoserwis' ); ?>
						<span class="accent"><?php esc_html_e( 'od 1993 roku.', 'autoserwis' ); ?></span>
					</h1>
					<p class="section-head__lead">
						<?php esc_html_e( 'Auto Sikora to rodzinny serwis przy ulicy Sowińskiego, w którym mechanika, blacharstwo i lakiernictwo prowadzimy pod jednym dachem. Ponad trzydzieści lat pracy z kierowcami nauczyło nas jednego: liczy się bezpieczeństwo jazdy i uczciwa rozmowa o kosztach.', 'autoserwis' ); ?>
					</p>
				</header>

				<figure class="about-hero__figure reveal reveal--delay">
					<picture>
						<source media="(max-width: 640px)" srcset="<?php echo esc_url( "$img/hero-workshop-sm.webp" ); ?>">
						<img src="<?php echo esc_url( "$img/hero-workshop.webp" ); ?>"
							alt="<?php esc_attr_e( 'Warsztat Auto Sikora przy ul. Sowińskiego w Szczecinie', 'autoserwis' ); ?>"
							width="1600" height="898" fetchpriority="high" decoding="async">
					</picture>
					<figcaption>
						<strong><?php esc_html_e( 'Auto Sikora', 'autoserwis' ); ?></strong>
						<span><?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?></span>
					</figcaption>
				</figure>
			</div>
		</div>
	</section>

	<!-- Historia -->
	<section class="section section--alt about-story">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Nasza historia', 'autoserwis' ); ?></p>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Od lawety', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'do pełnego serwisu.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead">
					<?php esc_html_e( 'Trzy dekady w jednym miejscu — każdy etap dokładał coś, czego wcześniej nie potrafiliśmy zrobić dla klienta.', 'autoserwis' ); ?>
				</p>
			</header>

			<div class="about-story__grid">

				<ol class="about-timeline">
					<?php foreach ( $milestones as $i => $step ) : ?>
						<li class="about-timeline__item reveal" style="--d:<?php echo esc_attr( $i * 0.07 ); ?>s">
							<span class="about-timeline__year"><?php echo esc_html( $step['year'] ); ?></span>
							<div class="about-timeline__body">
								<h3><?php echo esc_html( $step['title'] ); ?></h3>
								<p><?php echo esc_html( $step['desc'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>

				<aside class="about-scope reveal reveal--delay">
					<p class="about-scope__label"><?php esc_html_e( 'Dziś pod jednym dachem', 'autoserwis' ); ?></p>
					<p class="about-scope__intro">
						<?php esc_html_e( 'To, co kiedyś wymagało objazdu po trzech firmach, dziś załatwiasz w jednym warsztacie.', 'autoserwis' ); ?>
					</p>

					<ul class="about-scope__list">
						<?php
						$scope = array( 'mechanika', 'po-kolizji', 'blacharstwo', 'lakiernictwo', 'odszkodowania' );
						foreach ( autoserwis_services() as $service ) :
							if ( ! in_array( $service['slug'], $scope, true ) ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( autoserwis_service_url( $service['slug'] ) ); ?>">
									<span><?php echo esc_html( $service['title'] ); ?></span>
									<span class="about-scope__arrow" aria-hidden="true">↗</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>

					<a class="button button--secondary about-scope__cta" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
						<?php esc_html_e( 'Pełna oferta', 'autoserwis' ); ?> <span aria-hidden="true">→</span>
					</a>
				</aside>

			</div>
		</div>
	</section>

	<!-- Jak pracujemy -->
	<section class="section about-values">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Jak pracujemy', 'autoserwis' ); ?></p>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Cztery zasady, których', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'nie łamiemy.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead">
					<?php esc_html_e( 'Dbałość o interes klienta brzmi jak slogan, dopóki nie zamieni się w konkretne zasady. U nas oznacza to cztery rzeczy.', 'autoserwis' ); ?>
				</p>
			</header>

			<div class="about-values__layout">

				<div class="about-values__grid">
					<?php foreach ( $values as $i => $value ) : ?>
						<article class="about-value reveal" style="--d:<?php echo esc_attr( ( $i % 2 ) * 0.08 ); ?>s">
							<span class="about-value__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
									<?php echo $value['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</svg>
							</span>
							<h3><?php echo esc_html( $value['title'] ); ?></h3>
							<p><?php echo esc_html( $value['desc'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>

				<aside class="about-area reveal reveal--delay">
					<h3 class="about-area__title"><?php esc_html_e( 'Gdzie i dla kogo pracujemy', 'autoserwis' ); ?></h3>

					<p>
						<?php esc_html_e( 'Warsztat mieści się przy ulicy Sowińskiego na szczecińskim Nowym Mieście, kilka minut od centrum. Do naszego serwisu samochodowego przyjeżdżają kierowcy z całego Szczecina — z Pogodna, Niebuszewa, Śródmieścia i Prawobrzeża — oraz z okolicznych gmin.', 'autoserwis' ); ?>
					</p>

					<p>
						<?php esc_html_e( 'Obsługujemy samochody osobowe i dostawcze wszystkich marek: od aut kilkuletnich, przez pojazdy z długim przebiegiem, po samochody po kolizjach. Nie odsyłamy do autoryzowanych stacji — diagnostykę komputerową, naprawy mechaniczne, blacharkę i lakiernictwo wykonujemy na miejscu.', 'autoserwis' ); ?>
					</p>

					<ul class="about-area__list">
						<li><?php esc_html_e( 'Naprawy mechaniczne i diagnostyka komputerowa', 'autoserwis' ); ?></li>
						<li><?php esc_html_e( 'Blacharstwo i lakiernictwo w jednym miejscu', 'autoserwis' ); ?></li>
						<li><?php esc_html_e( 'Szkody z OC i AC rozliczane bezgotówkowo', 'autoserwis' ); ?></li>
						<li><?php esc_html_e( 'Auto zastępcze na czas naprawy', 'autoserwis' ); ?></li>
					</ul>

					<p class="about-area__note">
						<?php esc_html_e( 'Nie wiesz, czy zajmiemy się Twoim autem? Zadzwoń i opisz sprawę — powiemy wprost, czy to nasza działka.', 'autoserwis' ); ?>
					</p>
				</aside>

			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="section section--alt services-cta">
		<div class="container services-cta__inner reveal">
			<div>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Masz pytanie o swoje auto?', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadzwoń.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead"><?php esc_html_e( 'Opowiedz, co się dzieje — podpowiemy, czy trzeba przyjechać od razu, czy sprawa może poczekać.', 'autoserwis' ); ?></p>
			</div>
			<div class="services-cta__actions">
				<?php
				get_template_part(
					'template-parts/call-menu',
					null,
					array(
						'label' => __( 'Zadzwoń teraz', 'autoserwis' ),
						'class' => 'services-cta__call',
					)
				);
				?>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<?php esc_html_e( 'Zobacz usługi', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
