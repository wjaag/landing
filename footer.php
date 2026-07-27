<?php
/**
 * Stopka — jedna linijka z podpisem autora.
 *
 * Landing page kończy się sekcją „Kontakt”, więc stopka pozostaje
 * celowo minimalna. Wywołanie wp_footer() musi zostać: bez niego
 * WordPress nie wstawi skryptów motywu ani paska administracyjnego.
 *
 * @package autoserwis
 */

$autoserwis_author_mail = 'wjag@onet.pl';
?>

<footer class="site-credit">
	<div class="container">
		<p>
			<?php esc_html_e( 'design & code:', 'autoserwis' ); ?>
			<a href="mailto:<?php echo esc_attr( antispambot( $autoserwis_author_mail ) ); ?>">
				<?php esc_html_e( 'Wojciech Jagodziński', 'autoserwis' ); ?>
			</a>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
