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
			<?php
			// Kolejność: logo z Customizera > plik motywu > napis zapasowy.
			if ( has_custom_logo() ) :
				the_custom_logo();
			elseif ( autoserwis_logo_url() ) :
				?>
				<img class="site-header__logo" src="<?php echo esc_url( autoserwis_logo_url() ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					<?php echo autoserwis_logo_size_attr(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					decoding="async">
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
			<?php
			get_template_part( 'template-parts/call-menu', null, array(
				'label' => __( 'Zadzwoń', 'autoserwis' ),
				'class' => 'site-header__call',
			) );
			?>

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
 * (definicja w functions.php — patrz autoserwis_menu_fallback)
 */
