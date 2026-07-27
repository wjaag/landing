# AutoSerwis Landing

Motyw WordPress typu landing page dla warsztatów samochodowych, serwisów
blacharsko-lakierniczych i firm usługowych.

Zbudowany na natywnych funkcjach WordPressa — bez kreatora stron, bez
frameworków CSS, bez zewnętrznych bibliotek JavaScript. Cały arkusz stylów
i skrypt to dwa pliki, które ładują się jako jedno żądanie każdy.

---

## Wymagania

| | |
|---|---|
| WordPress | 6.0 lub nowszy |
| PHP | 7.4 lub nowszy |
| Wtyczki | żadne wymagane |

## Instalacja

1. **Wygląd → Motywy → Dodaj nowy → Wyślij motyw** i wskaż plik ZIP.
2. Kliknij **Zainstaluj**, potem **Włącz**.
3. Motyw sam utworzy podstrony: *Usługi*, *Jak działamy*, *Kontakt*.
4. **Ustawienia → Czytanie** → jako stronę główną wybierz stronę statyczną.
5. **Ustawienia → Bezpośrednie odnośniki** → wybierz *Nazwa wpisu*.

## Konfiguracja danych firmy

Wszystko w **Wygląd → Personalizuj → Dane warsztatu**:

- telefon komórkowy i stacjonarny,
- adres i wskazówka dojazdu,
- godziny otwarcia (pon.–pt. oraz sobota),
- adres mapy Google (pole `iframe src`).

Zmiany podstawiają się wszędzie naraz: w nagłówku, hero, sekcji kontaktu,
na podstronach i w danych strukturalnych.

### Logo i favicon

- **Logo** — *Personalizuj → Tożsamość witryny → Logo*. Alternatywnie
  wgraj plik do `assets/images/logo.png`, a motyw użyje go automatycznie.
- **Favicon** — *Personalizuj → Tożsamość witryny → Ikona witryny*
  albo plik `assets/images/favicon.ico`.

Gdy nie ma ani logo, ani pliku, nagłówek pokazuje napis tekstowy.

## Struktura

```
front-page.php          strona główna (hero, usługi, proces, kontakt)
page-uslugi.php         pełna oferta — 9 usług z kotwicami
page-jak-dzialamy.php   proces, statystyki, FAQ
page-kontakt.php        dane kontaktowe, dojazd, mapa
page.php                dowolna inna strona (treść z edytora)
404.php, search.php     błąd 404 i wyniki wyszukiwania
inc/seo.php             opisy, Open Graph, dane strukturalne
template-parts/         części wielokrotnego użytku
theme.json              paleta i typografia dla edytora blokowego
```

## Edycja treści

### Usługi

Lista usług siedzi w jednym miejscu — funkcji `autoserwis_services()`
w `functions.php`. Każda pozycja to:

```php
array(
    'slug'  => 'mechanika',                  // kotwica: /uslugi/#usluga-mechanika
    'image' => 'service-mechanics.webp',     // plik z assets/images/
    'title' => __( 'Mechanika i diagnostyka', 'autoserwis' ),
    'desc'  => __( 'Opis usługi…', 'autoserwis' ),
    'items' => array( /* lista punktów */ ),
),
```

Dodanie usługi do tej tablicy wystarczy — pojawi się na stronie *Usługi*
i w danych strukturalnych. Kafelki na stronie głównej odsyłają do kotwic
przez `autoserwis_service_url( 'slug' )`.

### FAQ

Pytania i odpowiedzi: funkcja `autoserwis_faq()` w `functions.php`.
Sekcja renderuje się na stronie *Jak działamy* i zasila schemat `FAQPage`.

## SEO

Motyw działa bez wtyczki SEO:

- opis (`meta description`) dla każdej strony, z polem do nadpisania
  w edytorze — sekcja **Opis dla wyszukiwarek** pod treścią,
- Open Graph i Twitter Card ze zdjęciem,
- dane strukturalne: `AutoRepair` z geolokalizacją i katalogiem usług,
  `BreadcrumbList`, `FAQPage`, `WebSite`,
- wymuszony `lang="pl-PL"`.

**Po instalacji zmień współrzędne i adres** w funkcji
`autoserwis_business_data()` (`inc/seo.php`) — domyślne wskazują
Szczecin. Współrzędne znajdziesz w Mapach Google: prawy klik na punkt →
pierwsza pozycja w menu.

Gdy wykryje Yoasta, Rank Matha, SEOPress lub AIOSEO, motyw wycofuje się
z meta tagów, żeby ich nie dublować. Dane strukturalne zostają.

## Edytor blokowy i kreatory

`theme.json` przekazuje edytorowi paletę, skalę typografii i szerokości
układu. `assets/css/editor.css` sprawia, że podgląd w panelu odpowiada
temu, co widzi odwiedzający.

Motyw wykrywa Elementor, Beaver Builder, Divi i WPBakery. Gdy kreator
prowadzi stronę, motyw nie dokłada własnego nagłówka ani okruszków —
inaczej pojawiłyby się dwa tytuły nad jedną treścią.

## Dostępność

- kontrast tekstu zgodny z WCAG AA,
- widoczny focus na elementach interaktywnych,
- `prefers-reduced-motion` wyłącza animacje,
- menu mobilne obsługiwane klawiaturą, zamykane Escape,
- treść pozostaje widoczna przy wyłączonym JavaScripcie.

## Wydajność

- dwa pliki statyczne, wersjonowane czasem modyfikacji (`?ver=`),
  więc po edycji nie trzeba czyścić cache,
- obrazy w formacie WebP z `width`, `height` i `loading="lazy"`,
- zdjęcie hero z `fetchpriority="high"`,
- brak jQuery i zewnętrznych zależności.

## Podgląd lokalny

W repozytorium jest skrypt uruchamiający WordPressa w przeglądarce
(WordPress Playground, bez Dockera):

```bash
./.dev/preview.sh start    # http://127.0.0.1:9400
./.dev/preview.sh stop
```

Wymaga tylko Node.js. Motyw montuje się z katalogu repozytorium, więc
zmiany widać po odświeżeniu strony.

## Licencja

GPL v2 lub nowsza — zgodnie z wymaganiami WordPressa.

Zdjęcia w `assets/images/` są częścią pakietu demonstracyjnego.
Przed wdrożeniem u klienta zastąp je własnymi materiałami.
