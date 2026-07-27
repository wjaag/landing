#!/usr/bin/env bash
# Lokalny podgląd motywu Auto Sikora w WordPress Playground (PHP-WASM, bez Dockera).
#
#   ./.dev/preview.sh start    - uruchom serwer na http://127.0.0.1:9400
#   ./.dev/preview.sh stop     - zatrzymaj
#   ./.dev/preview.sh restart  - przeładuj (po zmianach w functions.php / blueprint)
#   ./.dev/preview.sh status   - sprawdź stan
#   ./.dev/preview.sh logs     - podejrzyj logi
#
# Motyw jest zamontowany z katalogu repo, więc zmiany w .php/.css/.js
# widać po odświeżeniu przeglądarki — bez restartu.
set -euo pipefail

PORT="${PORT:-9400}"
REPO="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WORK="/tmp/wpprev"
WP_VERSION="6.8.2"
LOG="$WORK/server.log"

ensure_deps() {
  mkdir -p "$WORK"
  if [ ! -d "$WORK/node_modules/@wp-playground/cli" ]; then
    echo "==> Instaluję WP Playground CLI (jednorazowo, ~400 MB)..."
    (cd "$WORK" && npm i --silent @wp-playground/cli)
  fi
  if [ ! -f "$WORK/wordpress/wp-load.php" ]; then
    echo "==> Pobieram WordPress $WP_VERSION z GitHuba..."
    # wordpress.org bywa zablokowany w sandboksie; codeload.github.com działa
    curl -sL -o "$WORK/wp.tar.gz" \
      "https://codeload.github.com/WordPress/WordPress/tar.gz/refs/tags/$WP_VERSION"
    mkdir -p "$WORK/wordpress"
    tar xzf "$WORK/wp.tar.gz" -C "$WORK/wordpress" --strip-components=1
    rm -f "$WORK/wp.tar.gz"
  fi
  # Motyw montujemy z repo — w drzewie WP nie może być katalogu-duplikatu.
  rm -rf "$WORK/wordpress/wp-content/themes/autoserwis"
}

write_blueprint() {
  cat > "$WORK/bp.json" <<'JSON'
{
  "landingPage": "/",
  "steps": [
    { "step": "activateTheme", "themeFolderName": "autoserwis" },
    { "step": "setSiteOptions", "options": { "blogname": "Auto Sikora" } },
    { "step": "runPHP", "code": "<?php require_once '/wordpress/wp-load.php';\n$ids=[];\nforeach ([['Strona główna','strona-glowna'],['Usługi','uslugi'],['Jak działamy','jak-dzialamy'],['Kontakt','kontakt']] as $p) {\n  $ex = get_page_by_path($p[1]);\n  $ids[$p[1]] = $ex ? $ex->ID : wp_insert_post(['post_title'=>$p[0],'post_name'=>$p[1],'post_status'=>'publish','post_type'=>'page']);\n}\nupdate_option('show_on_front','page');\nupdate_option('page_on_front',$ids['strona-glowna']);\nupdate_option('permalink_structure','/%postname%/');\nflush_rewrite_rules(true);\n" }
  ]
}
JSON
}

start() {
  if curl -s -o /dev/null --max-time 3 "http://127.0.0.1:$PORT/"; then
    echo "Serwer już działa: http://127.0.0.1:$PORT"; return 0
  fi
  ensure_deps
  write_blueprint
  echo "==> Startuję WordPress $WP_VERSION + motyw z $REPO"
  (cd "$WORK" && setsid nohup npx @wp-playground/cli server \
      --port "$PORT" --php 8.3 \
      --wordpress-install-mode install-from-existing-files-if-needed \
      --mount-before-install "$WORK/wordpress:/wordpress" \
      --mount "$REPO:/wordpress/wp-content/themes/autoserwis" \
      --blueprint bp.json --login \
      > "$LOG" 2>&1 < /dev/null &)
  for _ in $(seq 1 60); do
    sleep 2
    if curl -s -o /dev/null --max-time 3 "http://127.0.0.1:$PORT/"; then
      echo "Gotowe → http://127.0.0.1:$PORT   (wp-admin: /wp-admin/, zalogowany jako admin)"
      return 0
    fi
  done
  echo "Nie wystartował w 2 min. Log:"; tail -20 "$LOG"; return 1
}

stop()    { pkill -f "wp-playground-cli server" 2>/dev/null && echo "Zatrzymano." || echo "Nic nie działało."; }
status()  { curl -s -o /dev/null -w "HTTP %{http_code} na http://127.0.0.1:$PORT/\n" --max-time 5 "http://127.0.0.1:$PORT/" || echo "Serwer nie odpowiada."; }
logs()    { tail -40 "$LOG"; }

case "${1:-start}" in
  start)   start ;;
  stop)    stop ;;
  restart) stop; sleep 3; start ;;
  status)  status ;;
  logs)    logs ;;
  *) echo "Użycie: $0 {start|stop|restart|status|logs}"; exit 1 ;;
esac
