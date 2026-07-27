<?php
/**
 * Przycisk telefonu z wyborem numeru (komórkowy / stacjonarny).
 *
 * Używany w nagłówku i w sekcjach CTA. Każda instancja dostaje własny
 * identyfikator, bo na jednej stronie może ich być kilka.
 *
 * Argumenty (get_template_part):
 *   label    string Napis na przycisku.
 *   class    string Dodatkowe klasy przycisku.
 *   icon     bool   Czy pokazać ikonę słuchawki na przycisku.
 *
 * @package autoserwis
 */

$args      = wp_parse_args(
	$args ?? array(),
	array(
		'label' => __( 'Zadzwoń', 'autoserwis' ),
		'class' => '',
		'icon'  => true,
	)
);

$GLOBALS['autoserwis_call_menu_id'] = ( $GLOBALS['autoserwis_call_menu_id'] ?? 0 ) + 1;

$list_id  = 'call-menu-list-' . $GLOBALS['autoserwis_call_menu_id'];
$tel_mob  = autoserwis_get( 'phone_mobile', '509 499 101' );
$tel_land = autoserwis_get( 'phone_landline', '91 812 11 92' );
?>
<div class="call-menu" data-call-menu>
	<button type="button" class="button button--primary <?php echo esc_attr( $args['class'] ); ?>" data-call-toggle
		aria-expanded="false" aria-haspopup="true" aria-controls="<?php echo esc_attr( $list_id ); ?>">
		<?php if ( $args['icon'] ) : ?>
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.5 2.9.7a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		<?php endif; ?>
		<span><?php echo esc_html( $args['label'] ); ?></span>
	</button>

	<div class="call-menu__list" id="<?php echo esc_attr( $list_id ); ?>" role="menu" hidden>
		<p class="call-menu__label"><?php esc_html_e( 'Wybierz numer', 'autoserwis' ); ?></p>
		<a class="call-menu__item" role="menuitem" href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>">
			<span class="call-menu__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="18" height="18"><rect x="6" y="2" width="12" height="20" rx="2.5" stroke="currentColor" stroke-width="1.8"/><path d="M10.5 18.5h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
			<span class="call-menu__text">
				<small><?php esc_html_e( 'Komórkowy', 'autoserwis' ); ?></small>
				<strong><?php echo esc_html( $tel_mob ); ?></strong>
			</span>
		</a>
		<a class="call-menu__item" role="menuitem" href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>">
			<span class="call-menu__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" width="18" height="18"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.5 2.9.7a2 2 0 0 1 1.7 2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
			<span class="call-menu__text">
				<small><?php esc_html_e( 'Stacjonarny', 'autoserwis' ); ?></small>
				<strong><?php echo esc_html( $tel_land ); ?></strong>
			</span>
		</a>
	</div>
</div>
