<?php
/**
 * Nagłówek strony.
 *
 * @package autoserwis
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Przejdź do treści', 'autoserwis' ); ?></a>

<header class="site-header" id="top">
	<div class="container site-header__inner">

		<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="site-header__logo-text">
					AUTO<em>SIKORA</em>
				</span>
			<?php endif; ?>
		</a>

		<nav class="site-header__nav" aria-label="<?php esc_attr_e( 'Menu główne', 'autoserwis' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'primary-menu',
				'depth'          => 1,
				'fallback_cb'    => 'autoserwis_menu_fallback',
			) );
			?>
		</nav>

		<div class="site-header__actions">
			<a class="button button--primary site-header__call" href="<?php echo esc_attr( autoserwis_tel( autoserwis_get( 'phone_mobile', '509 499 101' ) ) ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.5 2.9.7a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<span><?php echo esc_html( autoserwis_get( 'phone_mobile', '509 499 101' ) ); ?></span>
			</a>

			<button class="mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="<?php esc_attr_e( 'Otwórz menu', 'autoserwis' ); ?>">
				<span class="mobile-menu-toggle__icon"><span></span><span></span></span>
			</button>
		</div>
	</div>
</header>

<div class="mobile-menu" id="mobile-menu" hidden>
	<div class="mobile-menu__overlay" data-menu-close></div>
	<div class="mobile-menu__drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Menu', 'autoserwis' ); ?>">
		<div class="mobile-menu__header">
			<span class="mobile-menu__label"><?php esc_html_e( 'Menu', 'autoserwis' ); ?></span>
			<button class="mobile-menu__close" data-menu-close aria-label="<?php esc_attr_e( 'Zamknij menu', 'autoserwis' ); ?>">&times;</button>
		</div>
		<nav class="mobile-menu__nav" aria-label="<?php esc_attr_e( 'Menu mobilne', 'autoserwis' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'mobile-menu__list',
				'depth'          => 1,
				'fallback_cb'    => 'autoserwis_menu_fallback',
			) );
			?>
		</nav>
		<div class="mobile-menu__footer">
			<a class="button button--primary" href="<?php echo esc_attr( autoserwis_tel( autoserwis_get( 'phone_mobile', '509 499 101' ) ) ); ?>">
				<?php esc_html_e( 'Zadzwoń', 'autoserwis' ); ?> · <?php echo esc_html( autoserwis_get( 'phone_mobile', '509 499 101' ) ); ?>
			</a>
		</div>
	</div>
</div>

<?php
/**
 * Fallback menu – kotwice sekcji landing page'a.
 */
function autoserwis_menu_fallback( $args ) {
	$items = array(
		'#uslugi'  => __( 'Usługi', 'autoserwis' ),
		'#proces'  => __( 'Jak działamy', 'autoserwis' ),
		'#zakres'  => __( 'Zakres usług', 'autoserwis' ),
		'#kontakt' => __( 'Kontakt', 'autoserwis' ),
	);
	echo '<ul class="' . esc_attr( $args['menu_class'] ) . '">';
	foreach ( $items as $href => $label ) {
		echo '<li><a href="' . esc_url( home_url( '/' ) . $href ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
