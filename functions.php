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
 * Definicje usług warsztatu — wspólne źródło dla strony „Usługi”
 * i odnośników z innych sekcji.
 *
 * Klucz „slug” wyznacza kotwicę (#usluga-slug) przy kafelku na /uslugi/.
 * Slugi są stałe i niezależne od tłumaczenia tytułu, więc odnośniki
 * nie psują się po zmianie treści.
 *
 * @return array Lista usług.
 */
function autoserwis_services() {
	return array(
		array(
			'slug'  => 'mechanika',
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
			'slug'  => 'po-kolizji',
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
			'slug'  => 'blacharstwo',
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
			'slug'  => 'lakiernictwo',
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
			'slug'  => 'odszkodowania',
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
			'slug'  => 'klimatyzacja',
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
			'slug'  => 'auto-zastepcze',
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
			'slug'  => 'skup-pojazdow',
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
			'slug'  => 'konserwacja',
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
}

/**
 * Adres URL kafelka konkretnej usługi na stronie „Usługi”.
 *
 * @param string $slug Identyfikator usługi.
 * @return string Adres URL z kotwicą.
 */
function autoserwis_service_url( $slug ) {
	return home_url( '/uslugi/#usluga-' . $slug );
}

/**
 * Adres URL logo motywu (assets/images/logo.png).
 *
 * Zwraca pusty ciąg, gdy pliku nie ma — dzięki temu nagłówek nie
 * pokaże zepsutego obrazka, tylko wróci do napisu AUTO SIKORA.
 * Wynik jest zapamiętywany, bo nagłówek pyta o logo przy każdym żądaniu.
 *
 * @return string Adres URL logo albo pusty ciąg.
 */
function autoserwis_logo_url() {
	static $url = null;

	if ( null === $url ) {
		$url = file_exists( get_template_directory() . '/assets/images/logo.png' )
			? get_template_directory_uri() . '/assets/images/logo.png'
			: '';
	}

	return $url;
}

/**
 * Atrybuty width/height logo — bez nich przeglądarka nie zna proporcji
 * i układ nagłówka przeskakuje po wczytaniu obrazka (CLS).
 *
 * @return string Gotowy fragment atrybutów albo pusty ciąg.
 */
function autoserwis_logo_size_attr() {
	static $attr = null;

	if ( null === $attr ) {
		$attr = '';
		$path = get_template_directory() . '/assets/images/logo.png';

		if ( file_exists( $path ) ) {
			$size = @getimagesize( $path ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
			if ( $size ) {
				$attr = sprintf( 'width="%d" height="%d"', (int) $size[0], (int) $size[1] );
			}
		}
	}

	return $attr;
}

/**
 * Favicon motywu (assets/images/favicon.ico).
 *
 * WordPress ma własną ikonę witryny (Customizer → Tożsamość witryny),
 * więc gdy jest ustawiona, zostawiamy ją w spokoju.
 */
function autoserwis_favicon() {
	if ( has_site_icon() ) {
		return;
	}

	$path = get_template_directory() . '/assets/images/favicon.ico';
	if ( ! file_exists( $path ) ) {
		return;
	}

	$url = get_template_directory_uri() . '/assets/images/favicon.ico';
	printf(
		'<link rel="icon" href="%1$s" sizes="any"><link rel="shortcut icon" href="%1$s">' . "\n",
		esc_url( $url )
	);
}
add_action( 'wp_head', 'autoserwis_favicon' );
add_action( 'admin_head', 'autoserwis_favicon' );

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
