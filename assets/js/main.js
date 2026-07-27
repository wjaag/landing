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
	 * Wybór numeru telefonu w nagłówku
	 * ---------------------------------------------------------- */
	// Menu może być kilka na stronie (nagłówek + sekcje CTA).
	const callMenus = document.querySelectorAll('[data-call-menu]');

	if (callMenus.length) {
		const closeAll = (except) => {
			callMenus.forEach((menu) => {
				if (menu === except) return;
				menu.classList.remove('is-open');
				const t = menu.querySelector('[data-call-toggle]');
				if (t) t.setAttribute('aria-expanded', 'false');
			});
		};

		callMenus.forEach((callMenu) => {
			const callToggle = callMenu.querySelector('[data-call-toggle]');
			const callList = callMenu.querySelector('.call-menu__list');
			if (!callToggle || !callList) return;

			callList.removeAttribute('hidden');

			const setCallOpen = (open) => {
				if (open) closeAll(callMenu);
				callMenu.classList.toggle('is-open', open);
				callToggle.setAttribute('aria-expanded', String(open));
			};

			callToggle.addEventListener('click', (e) => {
				e.stopPropagation();
				setCallOpen(!callMenu.classList.contains('is-open'));
			});

			document.addEventListener('click', (e) => {
				if (!callMenu.contains(e.target)) setCallOpen(false);
			});

			document.addEventListener('keydown', (e) => {
				if (e.key === 'Escape' && callMenu.classList.contains('is-open')) {
					setCallOpen(false);
					callToggle.focus({ preventScroll: true });
				}
			});

			callList.querySelectorAll('a').forEach((a) => {
				a.addEventListener('click', () => setCallOpen(false));
			});
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
	 * Ukrywanie elementów następuje TUTAJ (klasa .reveal-init),
	 * nigdy w samym CSS — dzięki temu bez JS treść jest widoczna.
	 * ---------------------------------------------------------- */
	const revealEls = document.querySelectorAll('.reveal');
	if (
		revealEls.length &&
		'IntersectionObserver' in window &&
		!window.matchMedia('(prefers-reduced-motion: reduce)').matches
	) {
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

		revealEls.forEach((el) => {
			// Nie ukrywaj elementów, które są już w kadrze przy starcie.
			const rect = el.getBoundingClientRect();
			if (rect.top > window.innerHeight * 0.9) {
				el.classList.add('reveal-init');
				io.observe(el);
			}
		});

		// Siatka bezpieczeństwa: po 3 s pokaż wszystko bezwarunkowo.
		setTimeout(() => {
			revealEls.forEach((el) => el.classList.add('is-visible'));
		}, 3000);
	}
})();
