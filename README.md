# WordPress Lab — lokalne środowisko testowe

Gotowy sandbox WordPress do testowania motywów, wtyczek i importów. Aplikacja działa pod **http://localhost:8070**; baza i cache nie są wystawione na hosta.

## Co jest w środku

- **WordPress + Apache + PHP 8.3** — automatyczna instalacja po wejściu na stronę.
- **MariaDB 11.4** — trwały, odseparowany wolumen danych.
- **Redis** — gotowy pod wtyczkę Redis Object Cache.
- **WP-CLI** — do zarządzania stroną bez klikania.
- Opcjonalnie: **Adminer** (GUI bazy) i **Mailpit** (bezpieczna skrzynka testowa).
- Limity uploadu 64 MB, log błędów `wp-content/debug.log`, healthchecki i wygodne polecenia `make`.

## Start w 60 sekund

```bash
cp .env.example .env
docker compose up -d
```

Otwórz [http://localhost:8070](http://localhost:8070), wybierz język i przejdź standardowy instalator WordPressa.

> Wymagany jest Docker Engine z Docker Compose v2. Port `8070` można zmienić w `.env` (`WP_PORT`).

Sprawdź stan i logi:

```bash
make status
make logs
```

Zatrzymanie środowiska **nie usuwa** danych:

```bash
make down
```

## Gdzie pracować

Własne zasoby trzymaj w `wp-content/`:

```text
wp-content/
├── plugins/       # własne / testowane wtyczki
├── themes/        # motywy
└── uploads/       # media — celowo ignorowane przez Git
```

Zmiany w motywach i wtyczkach są widoczne od razu — katalog jest montowany z hosta. Rdzeń WordPressa, baza i Redis pozostają w zarządzanych wolumenach Dockera.

## WP-CLI, baza i backupy

```bash
# lista wtyczek
make cli CMD="plugin list"

# zainstaluj i aktywuj wtyczkę
make cli CMD="plugin install query-monitor --activate"

# otwórz konsolę bazy
make db-shell

# zrób eksport bazy / zaimportuj plik SQL
make export-db
make import-db FILE=backups/moj-backup.sql
```

Alternatywnie uruchamiaj bezpośrednio: `docker compose run --rm wp <polecenie-wp>`.

## Narzędzia opcjonalne

Domyślnie startują tylko WordPress, MariaDB i Redis. Włącz przydatne narzędzia tylko wtedy, gdy ich potrzebujesz:

```bash
docker compose --profile tools up -d adminer mailpit
```

| Narzędzie | Adres | Logowanie |
| --- | --- | --- |
| Adminer | http://localhost:8071 | System: `MySQL`, Server: `db`, dane z `.env` |
| Mailpit | http://localhost:8025 | bez logowania; przechwytuje e-maile testowe |

Aby WordPress wysyłał wiadomości do Mailpit, zainstaluj dowolną wtyczkę SMTP i ustaw host `mailpit`, port `1025`, bez szyfrowania i bez uwierzytelniania.

## Reset i dobre praktyki

Pełny reset (usuwa bazę, rdzeń WP oraz Redis):

```bash
make reset
```

- `.env` zawiera lokalne sekrety i nie trafia do Gita.
- `wp-content/uploads/`, cache i debug log są ignorowane. Kod motywów/wtyczek pozostaje wersjonowany.
- Nie używaj przykładowych haseł poza środowiskiem lokalnym.
