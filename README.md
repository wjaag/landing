# Auto Sikora – Landing Page (motyw WordPress)

Nowoczesny, lekki motyw typu **landing page** dla warsztatu samochodowego
**Auto Sikora** (Szczecin). Inspirowany układem i kolorystyką projektu
[sikoratesty.gt.tc](http://sikoratesty.gt.tc/) — czerń/grafit + czerwony akcent `#d92323`.

## Struktura

```
wp-content/themes/autoserwis/
├── style.css            # nagłówek motywu WP
├── functions.php        # enqueue, Customizer, schema.org (JSON-LD), porządki w <head>
├── header.php           # sticky header (glassmorphism) + drawer mobilny
├── front-page.php       # landing: hero, proces, zakres usług, kontakt, mapa
├── footer.php           # stopka
├── index.php            # szablon awaryjny
└── assets/
    ├── css/main.css     # design tokens, fluid typography, grid, animacje
    ├── js/main.js       # vanilla JS: drawer, scroll-reveal (IntersectionObserver)
    └── images/          # zdjęcia WebP (skompresowane, ~688 KB łącznie)

preview/index.html       # statyczny podgląd (1:1 z markupem motywu) — bez WP
```

## Nowoczesne rozwiązania

- **Design**: fluid typography (`clamp()`), CSS Grid + karty bento w sekcji usług,
  glassmorphism w nagłówku (`backdrop-filter`), scroll-reveal, mikrointerakcje
  (hover na kartach, strzałkach, mapie), mapa w skali szarości ożywająca po najechaniu.
- **Wydajność**: obrazy WebP z `loading="lazy"`, `fetchpriority="high"` dla hero,
  responsywne `<picture>` (osobny wariant mobilny), `defer` dla JS, brak jQuery
  i zewnętrznych bibliotek, czyszczenie `<head>` (emoji, generator itd.).
- **SEO / a11y**: dane strukturalne `AutoRepair` (JSON-LD), semantyczny HTML,
  skip-link, `aria-*` dla menu, `prefers-reduced-motion`, kontrasty AA.
- **WordPress**: menu (`primary`), custom logo, dane kontaktowe edytowalne
  w **Customizerze** (Wygląd → Dostosuj → „Dane warsztatu”): telefony, adres,
  godziny otwarcia, adres mapy.

## Instalacja

1. Skopiuj katalog `wp-content/themes/autoserwis` do instalacji WordPressa.
2. Aktywuj motyw **Auto Sikora – Landing** (Wygląd → Motywy).
3. (Opcjonalnie) ustaw logo i dane kontaktowe w Customizerze.
4. Landing renderuje się jako strona główna (`front-page.php`) — nie wymaga
   tworzenia stron ani konfiguracji czytelności.

## Podgląd bez WordPressa

Otwórz `preview/index.html` w przeglądarce — to statyczna kopia markupu motywu
korzystająca z tych samych plików CSS/JS/obrazów.

## Zdjęcia

Grafiki wygenerowane AI (bez znaków wodnych), skonwertowane do WebP
(hero 1600 px ≈ 105 KB, karty 900 px ≈ 40–85 KB).
