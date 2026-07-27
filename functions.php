<?php
/**
 * Auto Sikora – funkcje motywu.
 *
 * @package autoserwis
 */

defined( 'ABSPATH' ) || exit;

define( 'AUTOSERWIS_VERSION', '1.6.1' );

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
	add_theme_support( 'automatic-feed-links' );

	// Edytor blokowy: podgląd w edytorze ma odpowiadać stronie.
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus( array(
		'primary' => __( 'Menu główne', 'autoserwis' ),
	) );
}
add_action( 'after_setup_theme', 'autoserwis_setup' );

/* -------------------------------------------------------------------------
 * Zasoby (CSS/JS)
 * ---------------------------------------------------------------------- */
/**
 * Wersja pliku statycznego na podstawie czasu modyfikacji.
 *
 * Ręcznie podbijana stała bywa zapominana przy edycji CSS/JS, przez co
 * przeglądarki serwują stare pliki. Czas modyfikacji zmienia się sam,
 * więc każda zmiana od razu trafia do użytkownika.
 *
 * @param string $relative Ścieżka względem katalogu motywu.
 * @return string Wersja do parametru ?ver=.
 */
function autoserwis_asset_version( $relative ) {
	$path = get_template_directory() . '/' . ltrim( $relative, '/' );
	$time = file_exists( $path ) ? filemtime( $path ) : false;

	return $time ? AUTOSERWIS_VERSION . '.' . $time : AUTOSERWIS_VERSION;
}

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
		autoserwis_asset_version( 'assets/css/main.css' )
	);

	wp_enqueue_script(
		'autoserwis-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		autoserwis_asset_version( 'assets/js/main.js' ),
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
 * Czy stroną zarządza kreator (Elementor, Beaver Builder, Divi, WPBakery)?
 *
 * Kreatory dostarczają własny nagłówek strony i układ, więc motyw nie
 * dokłada wtedy swojego tytułu ani okruszków — inaczej pojawiłyby się
 * dwa nagłówki nad tą samą treścią.
 *
 * @param int|null $post_id Identyfikator strony (domyślnie bieżąca).
 * @return bool
 */
function autoserwis_is_page_builder( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	if ( ! $post_id ) {
		return false;
	}

	// Elementor.
	if ( did_action( 'elementor/loaded' ) && get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
		return true;
	}

	// Beaver Builder.
	if ( get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {
		return true;
	}

	// Divi.
	if ( function_exists( 'et_pb_is_pagebuilder_used' ) && et_pb_is_pagebuilder_used( $post_id ) ) {
		return true;
	}

	// WPBakery.
	if ( get_post_meta( $post_id, '_wpb_vc_js_status', true ) === 'true' ) {
		return true;
	}

	return false;
}

/**
 * Najczęstsze pytania klientów.
 *
 * Wspólne źródło dla sekcji na stronie i danych strukturalnych FAQPage,
 * dzięki którym pytania mogą pojawić się bezpośrednio w wynikach Google.
 *
 * @return array Lista par pytanie/odpowiedź.
 */
function autoserwis_faq() {
	return array(
		array(
			'q' => __( 'Ile kosztuje naprawa?', 'autoserwis' ),
			'a' => __( 'Wycena zależy od zakresu prac, dlatego zawsze zaczynamy od oględzin i diagnozy. Po sprawdzeniu auta przedstawiamy konkretną kwotę i zakres napraw — dopiero wtedy decydujesz, czy zlecasz nam pracę. Nie doliczamy kosztów bez Twojej zgody.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Czy trzeba się wcześniej umawiać?', 'autoserwis' ),
			'a' => __( 'Zalecamy telefon przed wizytą — dzięki temu przygotujemy stanowisko i nie będziesz czekać. Drobne sprawy, jak sprawdzenie klimatyzacji czy szybka diagnoza, obsługujemy zwykle od ręki.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Jak długo potrwa naprawa?', 'autoserwis' ),
			'a' => __( 'Prosty serwis, wymiana oleju czy klocków to zwykle jeden dzień. Naprawy blacharsko-lakiernicze i szkody powypadkowe trwają dłużej, bo lakier musi odpowiednio związać. Termin podajemy przy wycenie i informujemy o każdej zmianie.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Czy dostanę auto zastępcze?', 'autoserwis' ),
			'a' => __( 'Tak, na czas naprawy udostępniamy auto zastępcze. Przy szkodach z OC sprawcy koszt najczęściej pokrywa ubezpieczyciel, a formalności załatwiamy za Ciebie.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Czy rozliczacie się bezgotówkowo z ubezpieczycielem?', 'autoserwis' ),
			'a' => __( 'Tak. Przy szkodach komunikacyjnych rozliczamy się bezpośrednio z ubezpieczycielem — nie musisz wykładać własnych pieniędzy ani pilnować dokumentów. Zajmujemy się wyceną, zgłoszeniem i korespondencją.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Czy naprawa w warsztacie poza siecią traci gwarancję producenta?', 'autoserwis' ),
			'a' => __( 'Nie. Zgodnie z przepisami Unii Europejskiej możesz serwisować auto poza autoryzowaną stacją bez utraty gwarancji, o ile prace wykonuje się zgodnie z zaleceniami producenta i na częściach odpowiedniej jakości. Tak właśnie pracujemy i wystawiamy pełną dokumentację.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Jakich części używacie?', 'autoserwis' ),
			'a' => __( 'Domyślnie montujemy części oryginalne lub renomowanych producentów o jakości porównywalnej z oryginałem. Jeśli zależy Ci na tańszym zamienniku, powiemy wprost, na czym polega różnica — wybór zawsze należy do Ciebie.', 'autoserwis' ),
		),
		array(
			'q' => __( 'Czy pomożecie uzyskać odszkodowanie?', 'autoserwis' ),
			'a' => __( 'Tak. Analizujemy dokumentację szkody, reprezentujemy Cię przed ubezpieczycielem i walczymy o dopłaty do zaniżonych odszkodowań. Mamy na koncie ponad 100 wygranych spraw.', 'autoserwis' ),
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

require get_template_directory() . '/inc/seo.php';
