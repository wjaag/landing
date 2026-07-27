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
	const callMenu = document.querySelector('[data-call-menu]');

	if (callMenu) {
		const callToggle = callMenu.querySelector('[data-call-toggle]');
		const callList = callMenu.querySelector('.call-menu__list');

		if (callToggle && callList) {
			callList.removeAttribute('hidden');

			const setCallOpen = (open) => {
				callMenu.classList.toggle('is-open', open);
				callToggle.setAttribute('aria-expanded', String(open));
			};

			callToggle.addEventListener('click', (e) => {
				e.stopPropagation();
				setCallOpen(!callMenu.classList.contains('is-open'));
			});

			// Klik poza menu zamyka listę.
			document.addEventListener('click', (e) => {
				if (!callMenu.contains(e.target)) {
					setCallOpen(false);
				}
			});

			document.addEventListener('keydown', (e) => {
				if (e.key === 'Escape' && callMenu.classList.contains('is-open')) {
					setCallOpen(false);
					callToggle.focus({ preventScroll: true });
				}
			});

			// Po wybraniu numeru lista nie ma już powodu zostawać otwarta.
			callList.querySelectorAll('a').forEach((a) => {
				a.addEventListener('click', () => setCallOpen(false));
			});
		}
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
	 * Rozwijane kafelki usług (tylko wąskie ekrany)
	 *
	 * Zwijanie włącza JS, nie CSS — bez skryptu treść zostaje
	 * widoczna, a wyszukiwarki widzą pełny opis usługi.
	 * ---------------------------------------------------------- */
	const serviceCards = document.querySelectorAll('.service-detail');
	const compactQuery = window.matchMedia('(max-width: 900px)');

	if (serviceCards.length) {
		const applyCompact = (card, compact) => {
			const toggle = card.querySelector('[data-service-toggle]');
			if (!toggle) return;

			if (compact) {
				card.classList.add('is-collapsible');
				// Kafelek wskazany kotwicą otwieramy od razu.
				const open = card.id && card.id === decodeURIComponent(location.hash).slice(1);
				card.classList.toggle('is-open', open);
				toggle.setAttribute('aria-expanded', String(open));
				syncLabel(toggle, open);
			} else {
				card.classList.remove('is-collapsible', 'is-open');
				toggle.setAttribute('aria-expanded', 'false');
				syncLabel(toggle, false);
			}
		};

		function syncLabel(toggle, open) {
			const text = toggle.querySelector('.service-detail__toggle-text');
			if (!text) return;
			const label = open ? text.dataset.labelLess : text.dataset.labelMore;
			if (label) text.textContent = label;
		}

		serviceCards.forEach((card) => {
			const toggle = card.querySelector('[data-service-toggle]');
			if (!toggle) return;

			toggle.addEventListener('click', () => {
				if (!card.classList.contains('is-collapsible')) return;
				const open = !card.classList.contains('is-open');
				card.classList.toggle('is-open', open);
				toggle.setAttribute('aria-expanded', String(open));
				syncLabel(toggle, open);
			});

			applyCompact(card, compactQuery.matches);
		});

		const onBreakpoint = () => {
			serviceCards.forEach((card) => applyCompact(card, compactQuery.matches));
		};
		compactQuery.addEventListener('change', onBreakpoint);

		// Wejście z odnośnika #usluga-... rozwija właściwy kafelek.
		window.addEventListener('hashchange', () => {
			if (!compactQuery.matches) return;
			const target = document.getElementById(decodeURIComponent(location.hash).slice(1));
			if (target && target.classList.contains('is-collapsible')) {
				const toggle = target.querySelector('[data-service-toggle]');
				target.classList.add('is-open');
				if (toggle) {
					toggle.setAttribute('aria-expanded', 'true');
					syncLabel(toggle, true);
				}
			}
		});
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
