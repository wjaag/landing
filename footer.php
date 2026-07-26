<?php
/**
 * Stopka strony.
 *
 * @package autoserwis
 */

$tel_mob  = autoserwis_get( 'phone_mobile', '509 499 101' );
$tel_land = autoserwis_get( 'phone_landline', '91 812 11 92' );
?>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__brand">
			<span class="site-header__logo-text site-header__logo-text--light">AUTO<em>SIKORA</em></span>
			<p><?php esc_html_e( 'Warsztat samochodowy', 'autoserwis' ); ?></p>
		</div>

		<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Menu w stopce', 'autoserwis' ); ?>">
			<a href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>"><?php esc_html_e( 'Usługi', 'autoserwis' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/jak-dzialamy/' ) ); ?>"><?php esc_html_e( 'Jak działamy', 'autoserwis' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/#zakres' ) ); ?>"><?php esc_html_e( 'Zakres usług', 'autoserwis' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'autoserwis' ); ?></a>
		</nav>

		<div class="site-footer__contact">
			<a href="<?php echo esc_attr( autoserwis_tel( $tel_mob ) ); ?>"><?php echo esc_html( $tel_mob ); ?></a>
			<a href="<?php echo esc_attr( autoserwis_tel( $tel_land ) ); ?>"><?php echo esc_html( $tel_land ); ?></a>
			<p><?php echo esc_html( autoserwis_get( 'address_line', 'ul. Sowińskiego 26, Szczecin' ) ); ?></p>
		</div>
	</div>

	<div class="container site-footer__bottom">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Auto Sikora. <?php esc_html_e( 'Wszelkie prawa zastrzeżone.', 'autoserwis' ); ?></p>
		<a class="site-footer__top" href="#top" aria-label="<?php esc_attr_e( 'Wróć na górę', 'autoserwis' ); ?>">↑</a>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
