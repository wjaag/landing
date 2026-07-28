<?php
/**
 * Warstwa SEO motywu.
 *
 * Motyw nie zakłada obecności wtyczki SEO — gdy jednak wykryje Yoasta,
 * Rank Matha lub SEOPress, wycofuje się z meta tagów, żeby nie dublować
 * znaczników. Dane strukturalne zostają, bo opisują konkretny warsztat.
 *
 * @package autoserwis
 */

defined( 'ABSPATH' ) || exit;

/**
 * Czy działa wtyczka SEO, która sama wstawia meta tagi?
 *
 * @return bool
 */
function autoserwis_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )        // Yoast SEO.
		|| class_exists( 'RankMath' )        // Rank Math.
		|| defined( 'SEOPRESS_VERSION' )     // SEOPress.
		|| defined( 'AIOSEO_VERSION' );      // All in One SEO.
}

/**
 * Dane firmy w jednym miejscu — używane przez meta tagi i JSON-LD.
 *
 * @return array
 */
function autoserwis_business_data() {
	return array(
		'name'       => get_bloginfo( 'name' ),
		'street'     => 'ul. Sowińskiego 26',
		'city'       => 'Szczecin',
		'postal'     => '70-237',
		'region'     => 'zachodniopomorskie',
		'country'    => 'PL',
		// Współrzędne budynku przy Sowińskiego 26 (OpenStreetMap).
		'lat'        => '53.4180049',
		'lng'        => '14.5392151',
		'phone_mob'  => autoserwis_get( 'phone_mobile', '509 499 101' ),
		'email'      => autoserwis_get( 'email', 'autohol@interia.pl' ),
		'phone_land' => autoserwis_get( 'phone_landline', '91 812 11 92' ),
	);
}

/**
 * Numer telefonu w formacie międzynarodowym (E.164) — wymagany
 * przez dane strukturalne.
 *
 * @param string $phone Numer w zapisie lokalnym.
 * @return string
 */
function autoserwis_tel_e164( $phone ) {
	$digits = preg_replace( '/\D/', '', $phone );

	if ( 0 === strpos( $digits, '48' ) && strlen( $digits ) > 9 ) {
		return '+' . $digits;
	}

	return '+48' . $digits;
}

/* -------------------------------------------------------------------------
 * Język witryny
 * ---------------------------------------------------------------------- */

/**
 * Motyw jest w całości po polsku — deklarujemy to niezależnie od tego,
 * czy WordPress został zainstalowany z angielską lokalizacją.
 *
 * @param string $output Atrybuty języka.
 * @return string
 */
function autoserwis_language_attributes( $output ) {
	if ( false !== strpos( $output, 'lang=' ) && false === strpos( $output, 'lang="en' ) ) {
		return $output;
	}

	return preg_replace( '/lang="[^"]*"/', 'lang="pl-PL"', $output ) ?: 'lang="pl-PL"';
}
add_filter( 'language_attributes', 'autoserwis_language_attributes' );

/* -------------------------------------------------------------------------
 * Tytuł strony
 * ---------------------------------------------------------------------- */

/**
 * Strona główna dostaje tytuł z frazami zamiast samej nazwy witryny.
 *
 * @param array $parts Części tytułu.
 * @return array
 */
function autoserwis_document_title( $parts ) {
	if ( autoserwis_seo_plugin_active() || ! is_front_page() ) {
		return $parts;
	}

	$parts['title']   = get_bloginfo( 'name' );
	$parts['tagline'] = __( 'Serwis samochodowy, blacharstwo i lakiernictwo — Szczecin', 'autoserwis' );

	unset( $parts['site'] );

	return $parts;
}
add_filter( 'document_title_parts', 'autoserwis_document_title' );

/**
 * Separator tytułu — półpauza czyta się lepiej niż domyślna kreska.
 *
 * @return string
 */
function autoserwis_title_separator() {
	return '—';
}
add_filter( 'document_title_separator', 'autoserwis_title_separator' );

/* -------------------------------------------------------------------------
 * Opis strony
 * ---------------------------------------------------------------------- */

/**
 * Opis bieżącej strony: własny z Customizera, potem domyślny dla szablonu.
 *
 * @return string
 */
function autoserwis_meta_description() {
	$custom = '';

	if ( is_page() ) {
		$custom = (string) get_post_meta( get_queried_object_id(), '_autoserwis_description', true );
	}

	if ( '' !== trim( $custom ) ) {
		return $custom;
	}

	$city = 'Szczecinie';

	if ( is_front_page() ) {
		return sprintf(
			/* translators: %s: miasto w miejscowniku. */
			__( 'Auto Sikora — serwis samochodowy w %s. Mechanika, diagnostyka, blacharstwo, lakiernictwo i pomoc po kolizji. 30 lat doświadczenia, auto zastępcze, rozliczenia bezgotówkowe.', 'autoserwis' ),
			$city
		);
	}

	if ( is_page( 'uslugi' ) ) {
		return __( 'Pełna oferta warsztatu Auto Sikora w Szczecinie: mechanika i diagnostyka komputerowa, naprawy powypadkowe, blacharstwo, lakiernictwo, klimatyzacja, auto zastępcze i skup pojazdów.', 'autoserwis' );
	}

	if ( is_page( 'o-nas' ) ) {
		return __( 'Auto Sikora — warsztat samochodowy w Szczecinie działający od 1993 roku. Mechanika, blacharstwo, lakiernictwo i obsługa szkód pod jednym dachem. Poznaj naszą historię i zasady pracy.', 'autoserwis' );
	}

	if ( is_page( 'jak-dzialamy' ) ) {
		return __( 'Jak pracuje Auto Sikora: kontakt, diagnoza, naprawa i odbiór auta. Bez zbędnych formalności — ustalamy zakres prac i zajmujemy się resztą.', 'autoserwis' );
	}

	if ( is_page( 'kontakt' ) ) {
		$data = autoserwis_business_data();
		return sprintf(
			/* translators: 1: adres, 2: miasto, 3: telefon. */
			__( 'Auto Sikora — %1$s, %2$s. Zadzwoń: %3$s. Warsztat czynny pon.–pt. 9:00–17:00, sobota 9:00–14:00.', 'autoserwis' ),
			$data['street'],
			$data['city'],
			$data['phone_mob']
		);
	}

	$excerpt = get_the_excerpt();

	return $excerpt ? wp_strip_all_tags( $excerpt ) : get_bloginfo( 'description' );
}

/**
 * Skrócenie opisu do długości, którą wyszukiwarki faktycznie pokazują.
 *
 * @param string $text  Tekst źródłowy.
 * @param int    $limit Maksymalna liczba znaków.
 * @return string
 */
function autoserwis_trim_description( $text, $limit = 160 ) {
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $text ) ) );

	if ( mb_strlen( $text ) <= $limit ) {
		return $text;
	}

	$cut   = mb_substr( $text, 0, $limit );
	$space = mb_strrpos( $cut, ' ' );

	return rtrim( $space ? mb_substr( $cut, 0, $space ) : $cut, ' ,.;:' ) . '…';
}

/* -------------------------------------------------------------------------
 * Meta tagi w <head>
 * ---------------------------------------------------------------------- */

/**
 * Opis, odsyłacz kanoniczny, Open Graph i Twitter Card.
 */
function autoserwis_head_meta() {
	if ( autoserwis_seo_plugin_active() ) {
		return;
	}

	$description = autoserwis_trim_description( autoserwis_meta_description() );
	$title       = wp_get_document_title();
	$url         = is_front_page() ? home_url( '/' ) : get_permalink();
	$image       = get_template_directory_uri() . '/assets/images/hero-workshop.webp';

	if ( has_custom_logo() ) {
		$logo = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
		if ( $logo ) {
			$image = $logo;
		}
	}

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );

	// Open Graph.
	printf( '<meta property="og:type" content="%s">' . "\n", is_front_page() ? 'website' : 'article' );
	printf( '<meta property="og:locale" content="pl_PL">' . "\n" );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr__( 'Warsztat samochodowy Auto Sikora w Szczecinie', 'autoserwis' ) );

	// Twitter.
	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
}
add_action( 'wp_head', 'autoserwis_head_meta', 1 );

/* -------------------------------------------------------------------------
 * Dane strukturalne (JSON-LD)
 * ---------------------------------------------------------------------- */

/**
 * Wizytówka warsztatu — pełny profil lokalnej firmy.
 *
 * @return array
 */
function autoserwis_schema_business() {
	$data = autoserwis_business_data();

	return array(
		'@type'         => 'AutoRepair',
		'@id'           => home_url( '/#warsztat' ),
		'name'          => $data['name'],
		'description'   => autoserwis_trim_description( autoserwis_meta_description(), 300 ),
		'url'           => home_url( '/' ),
		'image'         => get_template_directory_uri() . '/assets/images/hero-workshop.webp',
		'telephone'     => autoserwis_tel_e164( $data['phone_mob'] ),
		'email'         => $data['email'],
		'priceRange'    => '$$',
		'currenciesAccepted' => 'PLN',
		'paymentAccepted'    => 'Gotówka, karta płatnicza, przelew, rozliczenie bezgotówkowe z ubezpieczycielem',
		'address'       => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $data['street'],
			'addressLocality' => $data['city'],
			'postalCode'      => $data['postal'],
			'addressRegion'   => $data['region'],
			'addressCountry'  => $data['country'],
		),
		'geo'           => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => $data['lat'],
			'longitude' => $data['lng'],
		),
		'contactPoint'  => array(
			array(
				'@type'             => 'ContactPoint',
				'telephone'         => autoserwis_tel_e164( $data['phone_mob'] ),
				'contactType'       => 'customer service',
				'availableLanguage' => 'Polish',
			),
			array(
				'@type'             => 'ContactPoint',
				'telephone'         => autoserwis_tel_e164( $data['phone_land'] ),
				'contactType'       => 'customer service',
				'availableLanguage' => 'Polish',
			),
		),
		'areaServed'    => array(
			array( '@type' => 'City', 'name' => 'Szczecin' ),
			array( '@type' => 'AdministrativeArea', 'name' => 'województwo zachodniopomorskie' ),
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
		'hasOfferCatalog' => autoserwis_schema_offer_catalog(),
	);
}

/**
 * Katalog usług warsztatu — buduje się z tej samej listy,
 * którą wyświetla strona „Usługi”.
 *
 * @return array
 */
function autoserwis_schema_offer_catalog() {
	$items = array();

	foreach ( autoserwis_services() as $service ) {
		$items[] = array(
			'@type'       => 'Offer',
			'itemOffered' => array(
				'@type'       => 'Service',
				'name'        => $service['title'],
				'description' => $service['desc'],
				'url'         => autoserwis_service_url( $service['slug'] ),
				'provider'    => array( '@id' => home_url( '/#warsztat' ) ),
				'areaServed'  => array( '@type' => 'City', 'name' => 'Szczecin' ),
			),
		);
	}

	return array(
		'@type'           => 'OfferCatalog',
		'name'            => __( 'Usługi warsztatu Auto Sikora', 'autoserwis' ),
		'itemListElement' => $items,
	);
}

/**
 * Ścieżka okruszków — na podstronach powiela to, co widzi użytkownik.
 *
 * @return array|null
 */
function autoserwis_schema_breadcrumbs() {
	if ( is_front_page() || ! is_page() ) {
		return null;
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => array(
			array(
				'@type'    => 'ListItem',
				'position' => 1,
				'name'     => __( 'Strona główna', 'autoserwis' ),
				'item'     => home_url( '/' ),
			),
			array(
				'@type'    => 'ListItem',
				'position' => 2,
				'name'     => get_the_title(),
				'item'     => get_permalink(),
			),
		),
	);
}

/**
 * Jeden graf zamiast kilku osobnych bloków — łatwiej go powiązać
 * odwołaniami (@id) i mniej waży.
 */
function autoserwis_schema() {
	$graph = array( autoserwis_schema_business() );

	$breadcrumbs = autoserwis_schema_breadcrumbs();
	if ( $breadcrumbs ) {
		$graph[] = $breadcrumbs;
	}

	$graph[] = array(
		'@type'     => 'WebSite',
		'@id'       => home_url( '/#witryna' ),
		'url'       => home_url( '/' ),
		'name'      => get_bloginfo( 'name' ),
		'inLanguage' => 'pl-PL',
		'publisher' => array( '@id' => home_url( '/#warsztat' ) ),
	);

	echo '<script type="application/ld+json">'
		. wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graph,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		)
		. '</script>' . "\n";
}
add_action( 'wp_head', 'autoserwis_schema' );

/* -------------------------------------------------------------------------
 * Pole opisu w edytorze strony
 * ---------------------------------------------------------------------- */

/**
 * Prosty metabox — pozwala nadpisać opis bez instalowania wtyczki SEO.
 */
function autoserwis_description_metabox() {
	if ( autoserwis_seo_plugin_active() ) {
		return;
	}

	add_meta_box(
		'autoserwis_seo',
		__( 'Opis dla wyszukiwarek', 'autoserwis' ),
		'autoserwis_description_metabox_render',
		'page',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'autoserwis_description_metabox' );

/**
 * Zawartość metaboksu.
 *
 * @param WP_Post $post Edytowana strona.
 */
function autoserwis_description_metabox_render( $post ) {
	$value = (string) get_post_meta( $post->ID, '_autoserwis_description', true );

	wp_nonce_field( 'autoserwis_description_save', 'autoserwis_description_nonce' );

	printf(
		'<p><textarea name="autoserwis_description" rows="3" style="width:100%%" maxlength="200" placeholder="%s">%s</textarea></p>',
		esc_attr__( 'Zostaw puste, aby użyć opisu domyślnego dla tej strony.', 'autoserwis' ),
		esc_textarea( $value )
	);
	printf(
		'<p class="description">%s</p>',
		esc_html__( 'Około 150–160 znaków. Tyle pokazuje Google w wynikach wyszukiwania.', 'autoserwis' )
	);
}

/**
 * Zapis opisu.
 *
 * @param int $post_id Identyfikator strony.
 */
function autoserwis_description_save( $post_id ) {
	if ( ! isset( $_POST['autoserwis_description_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['autoserwis_description_nonce'] ) ), 'autoserwis_description_save' )
		|| defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE
		|| ! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$value = isset( $_POST['autoserwis_description'] )
		? sanitize_text_field( wp_unslash( $_POST['autoserwis_description'] ) )
		: '';

	if ( '' === $value ) {
		delete_post_meta( $post_id, '_autoserwis_description' );
	} else {
		update_post_meta( $post_id, '_autoserwis_description', $value );
	}
}
add_action( 'save_post_page', 'autoserwis_description_save' );
