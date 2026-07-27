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
		'icon'  => '<path d="M21.5 16.9v2.6a1.8 1.8 0 0 1-2 1.8 18.6 18.6 0 0 1-8.1-2.9 18.3 18.3 0 0 1-5.6-5.6A18.6 18.6 0 0 1 2.9 4.6a1.8 1.8 0 0 1 1.8-2h2.6a1.8 1.8 0 0 1 1.8 1.6c.1.9.3 1.8.6 2.7a1.8 1.8 0 0 1-.4 1.9L8.1 10a15 15 0 0 0 5.6 5.6l1.2-1.2a1.8 1.8 0 0 1 1.9-.4c.9.3 1.8.5 2.7.6a1.8 1.8 0 0 1 1.6 1.8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
		'desc'  => __( 'Zadzwoń do nas i opowiedz, czego potrzebuje Twój samochód. Umówimy się na wizytę w dogodnym terminie.', 'autoserwis' ),
		'items' => array(
			__( 'Rozmowa telefoniczna lub wizyta na miejscu', 'autoserwis' ),
			__( 'Wstępna ocena problemu i orientacyjny koszt', 'autoserwis' ),
			__( 'Ustalenie terminu — zwykle w ciągu kilku dni', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Diagnoza', 'autoserwis' ),
		'icon'  => '<circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m20.5 20.5-4.8-4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 11h1.6l1.2-2.2 1.4 4 1.1-1.8h1.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
		'desc'  => __( 'Oglądamy samochód, oceniamy zakres naprawy i przedstawiamy Ci konkretne rozwiązanie.', 'autoserwis' ),
		'items' => array(
			__( 'Oględziny i diagnostyka komputerowa', 'autoserwis' ),
			__( 'Jasna wycena przed rozpoczęciem prac', 'autoserwis' ),
			__( 'Przy szkodach — pełna dokumentacja dla ubezpieczyciela', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Naprawa', 'autoserwis' ),
		'icon'  => '<path d="M15.5 3.8a5 5 0 0 0-6.1 6.6L3.6 16.2a2 2 0 0 0 2.8 2.8l5.8-5.8a5 5 0 0 0 6.6-6.1l-2.9 2.9-2.8-.7-.7-2.8 2.9-2.9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
		'desc'  => __( 'Nasi fachowcy wykonują ustalone prace zgodnie ze sztuką i z dbałością o każdy detal.', 'autoserwis' ),
		'items' => array(
			__( 'Sprawdzone części i materiały', 'autoserwis' ),
			__( 'Informujemy o postępach prac', 'autoserwis' ),
			__( 'Na czas naprawy możesz otrzymać auto zastępcze', 'autoserwis' ),
		),
	),
	array(
		'title' => __( 'Odbiór auta', 'autoserwis' ),
		'icon'  => '<circle cx="8" cy="8" r="4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m11.5 11.5 8 8M17 17l2-2M14.5 14.5l1.5-1.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
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
						<span class="process-detail__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="26" height="26"><?php echo $step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg></span>
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
					<span class="stat-card__bg" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="9" r="6.2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m8.4 14.2-1.9 7 5.5-3 5.5 3-1.9-7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m12 5.8 1.2 2.4 2.6.4-1.9 1.8.5 2.6-2.4-1.3-2.4 1.3.5-2.6-1.9-1.8 2.6-.4L12 5.8Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					<strong>30</strong>
					<span><?php esc_html_e( 'lat doświadczenia w branży motoryzacyjnej', 'autoserwis' ); ?></span>
				</div>
				<div class="stat-card reveal" style="--d:.08s">
					<span class="stat-card__bg" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M12 2.2 3.8 5.5v6.6c0 5 3.5 9.6 8.2 11 4.7-1.4 8.2-6 8.2-11V5.5L12 2.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.8 11.8h6.4M12 9v5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
					<strong>100+</strong>
					<span><?php esc_html_e( 'wygranych spraw o odszkodowania', 'autoserwis' ); ?></span>
				</div>
				<div class="stat-card reveal" style="--d:.16s">
					<span class="stat-card__bg" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M20 10c0 6.2-8 12.5-8 12.5S4 16.2 4 10a8 8 0 1 1 16 0Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.6 7.2a2.6 2.6 0 0 0-3.2 3.4L8.2 12.8a1 1 0 0 0 1.4 1.4l2.2-2.2a2.6 2.6 0 0 0 3.4-3.2l-1.5 1.5-1.5-.4-.4-1.5 1.8-1.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
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
				<?php
				get_template_part( 'template-parts/call-menu', null, array(
					'label' => __( 'Zadzwoń teraz', 'autoserwis' ),
					'class' => 'services-cta__call',
				) );
				?>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">
					<?php esc_html_e( 'Zobacz usługi', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
