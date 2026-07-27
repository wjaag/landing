#!/usr/bin/env bash
# Renderuje motyw przez WP Playground i zapisuje statyczny zrzut do .dev/preview/
# Dzięki temu efekt zmian można obejrzeć w podglądzie plików, bez dostępu do portu.
#
#   ./.dev/snapshot.sh           - zrzuć wszystkie strony
#   ./.dev/snapshot.sh /kontakt/ - zrzuć jedną stronę
set -euo pipefail

PORT="${PORT:-9400}"
REPO="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
OUT="$REPO/.dev/preview"
WORK="/tmp/wpprev"
BASE="http://127.0.0.1:$PORT"

"$REPO/.dev/preview.sh" start > /dev/null

if [ "$#" -gt 0 ]; then
  PAGES=("$@")
else
  PAGES=(/ /uslugi/ /jak-dzialamy/ /kontakt/)
fi

rm -rf "$OUT"
mkdir -p "$OUT/assets/css" "$OUT/assets/js" "$OUT/assets/images" "$OUT/wp-includes/css/dist/block-library"

# Pliki motywu kopiujemy wprost z repo — są identyczne z serwowanymi.
cp "$REPO/assets/css/main.css" "$OUT/assets/css/"
cp "$REPO/assets/js/main.js"   "$OUT/assets/js/"
cp "$REPO"/assets/images/*     "$OUT/assets/images/" 2>/dev/null || true

# Style rdzenia WP, do których odwołuje się <head>.
cp "$WORK/wordpress/wp-includes/css/dist/block-library/style.min.css" \
   "$OUT/wp-includes/css/dist/block-library/" 2>/dev/null || true

for page in "${PAGES[@]}"; do
  name="$(echo "$page" | sed 's#^/##; s#/$##')"
  [ -z "$name" ] && name="index"
  echo "==> $page -> $name.html"
  curl -sL "$BASE$page" \
    | sed -E \
        -e "s#https?://127\.0\.0\.1:$PORT/wp-content/themes/autoserwis/#./#g" \
        -e "s#https?://127\.0\.0\.1:$PORT/wp-includes/#./wp-includes/#g" \
        -e "s#https?://127\.0\.0\.1:$PORT/uslugi/#./uslugi.html#g" \
        -e "s#https?://127\.0\.0\.1:$PORT/jak-dzialamy/#./jak-dzialamy.html#g" \
        -e "s#https?://127\.0\.0\.1:$PORT/kontakt/#./kontakt.html#g" \
        -e "s#https?://127\.0\.0\.1:$PORT/?#./index.html#g" \
    > "$OUT/$name.html"
done

echo "Gotowe: $OUT/"
