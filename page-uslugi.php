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

$services = autoserwis_services();
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
					<article id="usluga-<?php echo esc_attr( $service['slug'] ); ?>" class="service-detail reveal<?php echo ! empty( $service['featured'] ) ? ' service-detail--featured' : ''; ?>" style="--d:<?php echo esc_attr( ( $i % 3 ) * 0.07 ); ?>s">
						<figure class="service-detail__media">
							<img src="<?php echo esc_url( "$img/{$service['image']}" ); ?>"
								alt="<?php echo esc_attr( $service['title'] ); ?>"
								loading="lazy" decoding="async" width="900" height="600">
							<?php if ( ! empty( $service['featured'] ) ) : ?>
								<span class="service-card__tag"><?php esc_html_e( 'Najczęściej wybierane', 'autoserwis' ); ?></span>
							<?php endif; ?>
						</figure>
						<div class="service-detail__body">
							<?php // Na mobile ta część leży na zdjęciu i zostaje po rozwinięciu. ?>
							<div class="service-detail__head">
								<h2 class="service-detail__heading">
									<span class="service-detail__num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									<span class="service-detail__title"><?php echo esc_html( $service['title'] ); ?></span>
								</h2>
								<?php // Skrót widoczny tylko na zwiniętej karcie (mobile). ?>
								<span class="service-detail__short"><?php echo esc_html( $service['desc'] ); ?></span>
							</div>

							<div class="service-detail__more" id="usluga-<?php echo esc_attr( $service['slug'] ); ?>-tresc">
								<p><?php echo esc_html( $service['desc'] ); ?></p>
								<ul class="service-detail__list">
									<?php foreach ( $service['items'] as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>

							<?php // Przycisk działa tylko na wąskich ekranach — na desktopie CSS go ukrywa. ?>
							<button type="button" class="service-detail__toggle" data-service-toggle
								aria-expanded="false" aria-controls="usluga-<?php echo esc_attr( $service['slug'] ); ?>-tresc">
								<span class="service-detail__toggle-text sr-only"
									data-label-more="<?php echo esc_attr( sprintf( __( 'Pokaż szczegóły: %s', 'autoserwis' ), $service['title'] ) ); ?>"
									data-label-less="<?php echo esc_attr( sprintf( __( 'Zwiń szczegóły: %s', 'autoserwis' ), $service['title'] ) ); ?>"><?php echo esc_html( sprintf( __( 'Pokaż szczegóły: %s', 'autoserwis' ), $service['title'] ) ); ?></span>
								<span class="service-detail__chevron" aria-hidden="true"></span>
							</button>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="section section--alt services-cta">
		<div class="container services-cta__inner reveal">
			<div>
				<h2 class="section-head__title">
					<?php esc_html_e( 'Nie znalazłeś swojej sprawy?', 'autoserwis' ); ?>
					<span class="accent"><?php esc_html_e( 'Zadzwoń.', 'autoserwis' ); ?></span>
				</h2>
				<p class="section-head__lead"><?php esc_html_e( 'Opowiedz nam, co dzieje się z samochodem — na pewno coś wymyślimy.', 'autoserwis' ); ?></p>
			</div>
			<div class="services-cta__actions">
				<?php
				get_template_part( 'template-parts/call-menu', null, array(
					'label' => __( 'Zadzwoń teraz', 'autoserwis' ),
					'class' => 'services-cta__call',
				) );
				?>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">
					<?php esc_html_e( 'Dane kontaktowe', 'autoserwis' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
