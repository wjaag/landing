<?php
/**
 * Szablon strony „Jak działamy” (slug: jak-dzialamy).
 * Rozbudowany opis procesu obsługi klienta.
 *
 * @package autoserwis
 */

get_header();

$img     = get_template_directory_uri() . '/assets/images';
$tel_mob = autoserwis_get( 'phone_mobile', '509 499 101' );

$steps = array(
	array(
		'title' => __( 'Kontakt', 'autoserwis' ),
		'desc'  => __( 'Zadzwoń do nas i opowiedz, czego potrzebuje Twój samochód. Umówimy się na wizytę w dogodnym terminie.', 'autoserwis' ),
		'items' => array(
			__( 'Rozmowa telefoniczna lub wizyta na miejscu', 'autoserwis' ),
			__( 'Wstępna ocena problemu i orientacyjny koszt', 'autoserwis' ),
			__( 'Ustalenie terminu — zwykle w ciągu kilku dni', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Diagnoza', 'autoserwis' ),
		'desc'  => __( 'Oglądamy samochód, oceniamy zakres naprawy i przedstawiamy Ci konkretne rozwiązanie.', 'autoserwis' ),
		'items' => array(
			__( 'Oględziny i diagnostyka komputerowa', 'autoserwis' ),
			__( 'Jasna wycena przed rozpoczęciem prac', 'autoserwis' ),
			__( 'Przy szkodach — pełna dokumentacja dla ubezpieczyciela', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Naprawa', 'autoserwis' ),
		'desc'  => __( 'Nasi fachowcy wykonują ustalone prace zgodnie ze sztuką i z dbałością o każdy detal.', 'autoserwis' ),
		'items' => array(
			__( 'Sprawdzone części i materiały', 'autoserwis' ),
			__( 'Informujemy o postępach prac', 'autoserwis' ),
			__( 'Na czas naprawy możesz otrzymać auto zastępcze', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Odbiór auta', 'autoserwis' ),
		'desc'  => __( 'Odbierasz sprawny i gotowy do drogi samochód. Prosto, konkretnie i bez niepotrzebnych komplikacji.', 'autoserwis' ),
		'items' => array(
			__( 'Wspólne oględziny wykonanych prac', 'autoserwis' ),
			__( 'Wskazówki dotyczące dalszej eksploatacji', 'autoserwis' ),
			__( 'Rozliczenie — gotówka, przelew lub bezgotówkowo z OC', 'autoserwis' ),
		),
	),
);
?>

<main id="main">

	<!-- Nagłówek podstrony -->
	<section class="section page-hero">
		<div class="container">
			<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Okruszki', 'autoserwis' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'autoserwis' ); ?></a>
				<span aria-hidden="true">/</span>
				<span><?php esc_html_e( 'Jak działamy', 'autoserwis' ); ?></span>
			</nav>

			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Jak działamy', 'autoserwis' ); ?></p>
				<h1 class="section-head__title">
					<?php esc_html_e( 'Prosty proces.', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadowolony klient.', 'autoserwis' ); ?></span>
				</h1>
				<p class="section-head__lead">
					<?php esc_html_e( 'Bez zbędnych formalności. Kontaktujesz się z nami, ustalamy zakres prac, a my zajmujemy się resztą — od diagnozy aż po odbiór gotowego samochodu.', 'autoserwis' ); ?>
				</p>
			</header>
		</div>
	</section>

	<!-- Kroki procesu -->
	<section class="section process-full">
		<div class="container">
			<ol class="process-full__list">
				<?php foreach ( $steps as $i => $step ) : ?>
					<li class="process-detail reveal" style="--d:<?php echo esc_attr( ( $i % 2 ) * 0.08 ); ?>s">
						<span class="process-detail__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<div class="process-detail__body">
							<h2><?php echo esc_html( $step['title'] ); ?></h2>
							<p><?php echo esc_html( $step['desc'] ); ?></p>
							<ul class="service-detail__list">
								<?php foreach ( $step['items'] as $item ) : ?>
									<li><?php echo esc_html( $item ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- Dlaczego my -->
	<section class="section section--alt why-us">
		<div class="container">
			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Dlaczego my', 'autoserwis' ); ?></p>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Liczby, które mówią', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'same za siebie.', 'autoserwis' ); ?></span>
				</h2>
			</header>
			<div class="stats-grid">
				<div class="stat-card reveal">
					<strong>30</strong>
					<span><?php esc_html_e( 'lat doświadczenia w branży motoryzacyjnej', 'autoserwis' ); ?></span>
				</div>
				<div class="stat-card reveal" style="--d:.08s">
					<strong>100+</strong>
					<span><?php esc_html_e( 'wygranych spraw o odszkodowania', 'autoserwis' ); ?></span>
				</div>
				<div class="stat-card reveal" style="--d:.16s">
					<strong>1</strong>
					<span><?php esc_html_e( 'miejsce, w którym załatwisz wszystko — od naprawy po formalności', 'autoserwis' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="section section--alt services-cta">
		<div class="container services-cta__inner reveal">
			<div>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Gotowy na pierwszy krok?', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadzwoń.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead"><?php esc_html_e( 'Umówimy wizytę i zajmiemy się Twoim autem.', 'autoserwis' ); ?></p>
			</div>
			<div class="services-cta__actions">
				<a class="button button--primary" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
					<?php echo esc_html( $tel_mob ); ?> <span aria-hidden="true">→</span>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<?php esc_html_e( 'Zobacz usługi', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
