<?php
/**
 * Szablon strony „Usługi” (slug: uslugi).
 * Pełna lista usług warsztatu.
 *
 * @package autoserwis
 */

get_header();

$img     = get_template_directory_uri() . '/assets/images';
$tel_mob = autoserwis_get( 'phone_mobile', '509 499 101' );

/**
 * Definicje usług: [obraz, tytuł, opis, lista szczegółów, wyróżnienie].
 */
$services = array(
	array(
		'image' => 'service-mechanics.webp',
		'title' => __( 'Mechanika i diagnostyka', 'autoserwis' ),
		'desc'  => __( 'Kompleksowe naprawy mechaniczne — od drobnych usterek po poważne remonty. Diagnostyka komputerowa pozwala szybko znaleźć źródło problemu.', 'autoserwis' ),
		'items' => array(
			__( 'Diagnostyka komputerowa', 'autoserwis' ),
			__( 'Naprawy silników i osprzętu', 'autoserwis' ),
			__( 'Układy hamulcowe i zawieszenia', 'autoserwis' ),
			__( 'Wymiana rozrządu, sprzęgła, olejów i filtrów', 'autoserwis' ),
			__( 'Przygotowanie do przeglądu technicznego', 'autoserwis' ),
		),
	),
	array(
		'image' => 'service-collision.webp',
		'title' => __( 'Pomoc po kolizji i naprawy powypadkowe', 'autoserwis' ),
		'desc'  => __( 'Miałeś stłuczkę lub wypadek? Zajmiemy się wszystkim — od oględzin i wyceny, przez kontakt z ubezpieczycielem, aż po pełną naprawę auta.', 'autoserwis' ),
		'items' => array(
			__( 'Bezgotówkowe rozliczenie z ubezpieczycielem', 'autoserwis' ),
			__( 'Wycena i dokumentacja szkody', 'autoserwis' ),
			__( 'Naprawy blacharsko-lakiernicze po szkodzie', 'autoserwis' ),
			__( 'Auto zastępcze na czas naprawy', 'autoserwis' ),
		),
	),
	array(
		'image' => 'service-bodywork.webp',
		'title' => __( 'Blacharstwo', 'autoserwis' ),
		'desc'  => __( 'Naprawy karoserii i elementów nadwozia — przywracamy autu fabryczny wygląd i geometrię, zgodnie ze sztuką blacharską.', 'autoserwis' ),
		'items' => array(
			__( 'Naprawa i wymiana elementów karoserii', 'autoserwis' ),
			__( 'Usuwanie wgnieceń i skutków korozji', 'autoserwis' ),
			__( 'Naprawy ram i podłużnic', 'autoserwis' ),
			__( 'Spawanie i klejenie elementów nadwozia', 'autoserwis' ),
		),
	),
	array(
		'image' => 'service-paint.webp',
		'title' => __( 'Lakiernictwo', 'autoserwis' ),
		'desc'  => __( 'Precyzyjne lakierowanie elementów auta w komorze lakierniczej. Idealne dopasowanie koloru i trwałe wykończenie.', 'autoserwis' ),
		'items' => array(
			__( 'Lakierowanie elementów i całych pojazdów', 'autoserwis' ),
			__( 'Komputerowy dobór koloru', 'autoserwis' ),
			__( 'Usuwanie rys i odprysków', 'autoserwis' ),
			__( 'Polerowanie i zabezpieczanie lakieru', 'autoserwis' ),
		),
	),
	array(
		'image'    => 'extra-legal.webp',
		'title'    => __( 'Dochodzenie odszkodowań', 'autoserwis' ),
		'desc'     => __( 'Otoczymy Cię pełną opieką prawną, abyś spokojnie mógł dochodzić swoich praw. Mamy na koncie ponad 100 wygranych spraw!', 'autoserwis' ),
		'featured' => true,
		'items'    => array(
			__( 'Analiza szkody i dokumentacji', 'autoserwis' ),
			__( 'Reprezentacja przed ubezpieczycielem', 'autoserwis' ),
			__( 'Dopłaty do zaniżonych odszkodowań', 'autoserwis' ),
			__( 'Ponad 100 wygranych spraw', 'autoserwis' ),
		),
	),
	array(
		'image' => 'extra-ac.webp',
		'title' => __( 'Klimatyzacja', 'autoserwis' ),
		'desc'  => __( 'Serwisujemy klimatyzacje od ręki w każdego rodzaju pojazdach.', 'autoserwis' ),
		'items' => array(
			__( 'Napełnianie i odgrzybianie układu', 'autoserwis' ),
			__( 'Wykrywanie i usuwanie nieszczelności', 'autoserwis' ),
			__( 'Wymiana filtrów kabinowych', 'autoserwis' ),
		),
	),
	array(
		'image' => 'extra-replacement.webp',
		'title' => __( 'Auto zastępcze', 'autoserwis' ),
		'desc'  => __( 'Na czas naprawy oferujemy auto zastępcze — nie zostaniesz bez środka transportu.', 'autoserwis' ),
		'items' => array(
			__( 'Samochód na czas naprawy', 'autoserwis' ),
			__( 'Rozliczenie w ramach OC sprawcy', 'autoserwis' ),
			__( 'Proste formalności na miejscu', 'autoserwis' ),
		),
	),
	array(
		'image' => 'extra-buyout.webp',
		'title' => __( 'Skup pojazdów', 'autoserwis' ),
		'desc'  => __( 'Chcesz sprzedać auto? Przyjedź, dogadamy się! Uczciwa wycena na miejscu.', 'autoserwis' ),
		'items' => array(
			__( 'Wycena od ręki', 'autoserwis' ),
			__( 'Auta sprawne i powypadkowe', 'autoserwis' ),
			__( 'Formalności załatwiamy za Ciebie', 'autoserwis' ),
		),
	),
	array(
		'image' => 'extra-maintenance.webp',
		'title' => __( 'Konserwacja pojazdów', 'autoserwis' ),
		'desc'  => __( 'Przeprowadzamy pełną konserwację pojazdów — chronimy auto przed korozją i upływem czasu.', 'autoserwis' ),
		'items' => array(
			__( 'Zabezpieczenie antykorozyjne podwozia', 'autoserwis' ),
			__( 'Konserwacja profili zamkniętych', 'autoserwis' ),
			__( 'Przeglądy okresowe i sezonowe', 'autoserwis' ),
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
				<span><?php esc_html_e( 'Usługi', 'autoserwis' ); ?></span>
			</nav>

			<header class="section-head reveal">
				<p class="eyebrow"><span class="eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Pełna oferta', 'autoserwis' ); ?></p>
				<h1 class="section-head__title">
					<?php esc_html_e( 'Wszystkie usługi', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'w jednym miejscu.', 'autoserwis' ); ?></span>
				</h1>
				<p class="section-head__lead">
					<?php esc_html_e( 'Od diagnozy, przez naprawy mechaniczne, blacharstwo i lakiernictwo, aż po pomoc w dochodzeniu odszkodowań. Wiedza poparta 30-letnim doświadczeniem.', 'autoserwis' ); ?>
				</p>
			</header>
		</div>
	</section>

	<!-- Lista usług -->
	<section class="section services-full" id="lista-uslug">
		<div class="container">
			<div class="services-full__grid">
				<?php foreach ( $services as $i => $service ) : ?>
					<article class="service-detail reveal<?php echo ! empty( $service['featured'] ) ? ' service-detail--featured' : ''; ?>" style="--d:<?php echo esc_attr( ( $i % 3 ) * 0.07 ); ?>s">
						<figure class="service-detail__media">
							<img src="<?php echo esc_url( "$img/{$service['image']}" ); ?>"
								alt="<?php echo esc_attr( $service['title'] ); ?>"
								loading="lazy" decoding="async" width="900" height="600">
							<?php if ( ! empty( $service['featured'] ) ) : ?>
								<span class="service-card__tag"><?php esc_html_e( 'Najczęściej wybierane', 'autoserwis' ); ?></span>
							<?php endif; ?>
						</figure>
						<div class="service-detail__body">
							<span class="service-detail__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h2><?php echo esc_html( $service['title'] ); ?></h2>
							<p><?php echo esc_html( $service['desc'] ); ?></p>
							<ul class="service-detail__list">
								<?php foreach ( $service['items'] as $item ) : ?>
									<li><?php echo esc_html( $item ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="section services-cta">
		<div class="container services-cta__inner reveal">
			<div>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Nie znalazłeś swojej sprawy?', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadzwoń.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead"><?php esc_html_e( 'Opowiedz nam, co dzieje się z samochodem — na pewno coś wymyślimy.', 'autoserwis' ); ?></p>
			</div>
			<div class="services-cta__actions">
				<a class="button button--primary" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
					<?php echo esc_html( $tel_mob ); ?> <span aria-hidden="true">→</span>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">
					<?php esc_html_e( 'Dane kontaktowe', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
