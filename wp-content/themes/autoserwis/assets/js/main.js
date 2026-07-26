/**
 * Auto Sikora – interakcje frontendu.
 * Vanilla JS, bez zależności.
 */
(() => {
	'use strict';

	/* ------------------------------------------------------------
	 * Menu mobilne (drawer)
	 * ---------------------------------------------------------- */
	const toggle = document.querySelector('.mobile-menu-toggle');
	const menu = document.getElementById('mobile-menu');

	if (toggle && menu) {
		menu.removeAttribute('hidden');

		const setOpen = (open) => {
			menu.classList.toggle('is-open', open);
			document.body.classList.toggle('menu-open', open);
			toggle.setAttribute('aria-expanded', String(open));
			if (open) {
				const firstLink = menu.querySelector('a, button');
				firstLink && firstLink.focus({ preventScroll: true });
			} else {
				toggle.focus({ preventScroll: true });
			}
		};

		toggle.addEventListener('click', () => {
			setOpen(!menu.classList.contains('is-open'));
		});

		menu.querySelectorAll('[data-menu-close]').forEach((el) => {
			el.addEventListener('click', () => setOpen(false));
		});

		// Zamknij po kliknięciu w link (kotwice na tej samej stronie).
		menu.querySelectorAll('.mobile-menu__list a, .mobile-menu__footer a').forEach((a) => {
			a.addEventListener('click', () => setOpen(false));
		});

		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && menu.classList.contains('is-open')) {
				setOpen(false);
			}
		});
	}

	/* ------------------------------------------------------------
	 * Cień nagłówka po przewinięciu
	 * ---------------------------------------------------------- */
	const header = document.querySelector('.site-header');
	if (header) {
		const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ------------------------------------------------------------
	 * Scroll reveal (IntersectionObserver)
	 * ---------------------------------------------------------- */
	const revealEls = document.querySelectorAll('.reveal');
	if (revealEls.length) {
		if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			const io = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							entry.target.classList.add('is-visible');
							io.unobserve(entry.target);
						}
					});
				},
				{ threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
			);
			revealEls.forEach((el) => io.observe(el));
		} else {
			revealEls.forEach((el) => el.classList.add('is-visible'));
		}
	}
})();
