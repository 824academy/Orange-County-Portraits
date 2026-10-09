# Logo concepts

Three restrained directions for Orange County Portraits, built only from the website's own fonts:
- **Newsreader Light**: the serif used for headings.
- **Figtree**: the sans-serif used for body text.

There are no script fonts or botanical marks. The text is converted to vector shapes, so the files look identical on any computer, with or without the fonts installed. `logo-concepts.png` shows all three side by side.

| Concept | Files | Best for |
|---|---|---|
| **1 · Stacked wordmark** | `1-stacked-wordmark(.svg/-white.svg)` | The current site wordmark, refined. Website header, email signature, print. |
| **2 · OC monogram + lockup** | `2-monogram*`, `2-lockup*` | The monogram works small: site icon (favicon), Instagram profile, watermark, gallery cover, packaging stamp. The lockup is a wide horizontal version for headers and letterhead. |
| **3 · Editorial masthead** | `3-editorial*` | Sentence case with an italic *Portraits*, like a magazine title. Feels the most "luxury editorial". |

Colors:
- Forest `#263E34` for the logo itself.
- White versions for use on forest or sage backgrounds.
- A dusty rose `#C6A49D` hairline accent.

`png/` holds high-resolution PNG exports with transparent backgrounds. `2-monogram-site-icon.png` is ready for **Settings → General → Site Icon**.

To regenerate the files, run `pip install fonttools brotli`, then `python3 tools/build-logos.py`.
