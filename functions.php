<?php
/**
 * Auto Sikora – funkcje motywu.
 *
 * @package autoserwis
 */

defined( 'ABSPATH' ) || exit;

define( 'AUTOSERWIS_VERSION', '1.4.0' );

/* -------------------------------------------------------------------------
 * Konfiguracja motywu
 * ---------------------------------------------------------------------- */
function autoserwis_setup() {
	load_theme_textdomain( 'autoserwis', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 96,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Menu główne', 'autoserwis' ),
	) );
}
add_action( 'after_setup_theme', 'autoserwis_setup' );

/* -------------------------------------------------------------------------
 * Zasoby (CSS/JS)
 * ---------------------------------------------------------------------- */
function autoserwis_enqueue_assets() {
	// Font: Inter (subset latin-ext dla polskich znaków).
	wp_enqueue_style(
		'autoserwis-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'autoserwis-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'autoserwis-fonts' ),
		AUTOSERWIS_VERSION
	);

	wp_enqueue_script(
		'autoserwis-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		AUTOSERWIS_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'autoserwis_enqueue_assets' );

/**
 * Preconnect dla Google Fonts.
 */
function autoserwis_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'autoserwis_resource_hints', 10, 2 );

/* -------------------------------------------------------------------------
 * Customizer – dane kontaktowe warsztatu
 * ---------------------------------------------------------------------- */
function autoserwis_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'autoserwis_contact', array(
		'title'    => __( 'Dane warsztatu', 'autoserwis' ),
		'priority' => 30,
	) );

	$fields = array(
		'phone_landline' => array( __( 'Telefon stacjonarny', 'autoserwis' ), '91 812 11 92' ),
		'phone_mobile'   => array( __( 'Telefon komórkowy', 'autoserwis' ), '509 499 101' ),
		'address_line'   => array( __( 'Adres', 'autoserwis' ), 'ul. Sowińskiego 26, Szczecin' ),
		'address_hint'   => array( __( 'Wskazówka dojazdu', 'autoserwis' ), 'skrzyżowanie ulic Sowińskiego i Kusocińskiego' ),
		'hours_week'     => array( __( 'Godziny (pon.–pt.)', 'autoserwis' ), '09:00 – 17:00' ),
		'hours_saturday' => array( __( 'Godziny (sobota)', 'autoserwis' ), '09:00 – 14:00' ),
		'map_embed'      => array( __( 'Adres URL mapy (iframe src)', 'autoserwis' ), 'https://www.google.com/maps?q=ul.+Sowi%C5%84skiego+26,+Szczecin&z=15&output=embed' ),
	);

	foreach ( $fields as $key => $data ) {
		$wp_customize->add_setting( "autoserwis_{$key}", array(
			'default'           => $data[1],
			'sanitize_callback' => 'map_embed' === $key ? 'esc_url_raw' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( "autoserwis_{$key}", array(
			'label'   => $data[0],
			'section' => 'autoserwis_contact',
			'type'    => 'text',
		) );
	}
}
add_action( 'customize_register', 'autoserwis_customize_register' );

/**
 * Pomocnik: pobierz ustawienie kontaktowe.
 * Gdy w bazie zapisano pustą wartość, wraca do wartości domyślnej —
 * dzięki temu np. mapa nigdy nie dostanie pustego adresu URL.
 */
function autoserwis_get( $key, $default = '' ) {
	// UWAGA: świadomie omijamy get_theme_mod(). Ta funkcja przepuszcza wartość
	// przez sprintf(), więc znak „%” w treści (np. %C5%84 w zakodowanym adresie
	// mapy) wywołuje ValueError i zabija renderowanie strony.
	$mods  = get_theme_mods();
	$value = isset( $mods[ "autoserwis_{$key}" ] ) ? $mods[ "autoserwis_{$key}" ] : '';

	if ( '' === trim( (string) $value ) ) {
		return $default;
	}
	return $value;
}

/**
 * Pomocnik: numer telefonu w formacie tel: (bez spacji).
 */
function autoserwis_tel( $phone ) {
	return 'tel:' . preg_replace( '/\s+/', '', $phone );
}

/**
 * Fallback menu – kotwice sekcji landing page'a.
 * WAŻNE: musi być w functions.php (nie w header.php), bo Customizer
 * wywołuje wp_nav_menu z tym callbackiem w żądaniach AJAX (selective
 * refresh), w których pliki szablonów nie są ładowane.
 */
function autoserwis_menu_fallback( $args ) {
	$items = autoserwis_menu_items();

	echo '<ul class="' . esc_attr( $args['menu_class'] ) . '">';
	foreach ( $items as $href => $label ) {
		$is_current = autoserwis_menu_is_current( $href );
		$li_class   = $is_current ? ' class="current-menu-item"' : '';
		$aria       = $is_current ? ' aria-current="page"' : '';
		echo '<li' . $li_class . '><a href="' . esc_url( $href ) . '"' . $aria . '>' . esc_html( $label ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</ul>';
}

/**
 * Pozycje menu motywu (nagłówek, menu mobilne, stopka).
 *
 * @return array Mapa: adres URL => etykieta.
 */
function autoserwis_menu_items() {
	return array(
		home_url( '/' )              => __( 'Główna', 'autoserwis' ),
		home_url( '/uslugi/' )       => __( 'Usługi', 'autoserwis' ),
		home_url( '/jak-dzialamy/' ) => __( 'Jak działamy', 'autoserwis' ),
		home_url( '/kontakt/' )      => __( 'Kontakt', 'autoserwis' ),
	);
}

/**
 * Czy dany adres menu wskazuje aktualnie wyświetlaną stronę?
 */
function autoserwis_menu_is_current( $href ) {
	$path = trim( (string) wp_parse_url( $href, PHP_URL_PATH ), '/' );
	$home = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );

	// Obsługa instalacji w podkatalogu – odcinamy ścieżkę bazową.
	if ( '' !== $home && 0 === strpos( $path, $home ) ) {
		$path = trim( substr( $path, strlen( $home ) ), '/' );
	}

	if ( '' === $path ) {
		return is_front_page();
	}

	return is_page( $path );
}

/* -------------------------------------------------------------------------
 * Podstrony sekcji – tworzone automatycznie przy aktywacji motywu
 * ---------------------------------------------------------------------- */
function autoserwis_create_pages() {
	$pages = array(
		'uslugi'       => __( 'Usługi', 'autoserwis' ),
		'jak-dzialamy' => __( 'Jak działamy', 'autoserwis' ),
		'kontakt'      => __( 'Kontakt', 'autoserwis' ),
	);
	foreach ( $pages as $slug => $title ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		wp_insert_post( array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '', // Treść renderują szablony page-{slug}.php.
		) );
	}
}
add_action( 'after_switch_theme', 'autoserwis_create_pages' );

/* -------------------------------------------------------------------------
 * Porządki – lżejszy <head>
 * ---------------------------------------------------------------------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Dane strukturalne (JSON-LD) dla lokalnego biznesu.
 */
function autoserwis_schema() {
	if ( ! is_front_page() ) {
		return;
	}
	$schema = array(
		'@context'     => 'https://schema.org',
		'@type'        => 'AutoRepair',
		'name'         => get_bloginfo( 'name' ),
		'url'          => home_url( '/' ),
		'telephone'    => preg_replace( '/\s+/', '', autoserwis_get( 'phone_mobile', '509 499 101' ) ),
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'ul. Sowińskiego 26',
			'addressLocality' => 'Szczecin',
			'addressCountry'  => 'PL',
		),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '09:00',
				'closes'    => '17:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '09:00',
				'closes'    => '14:00',
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'autoserwis_schema' );
