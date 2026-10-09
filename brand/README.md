# Logo concepts

Three restrained directions for Orange County Portraits, built only from the website's own fonts:
- **Newsreader Light**: the serif used for headings.
- **Figtree**: the sans-serif used for body text.

There are no script fonts or botanical marks. The text is converted to vector shapes, so the files look identical on any computer, with or without the fonts installed. `logo-concepts.png` shows concepts 1–3 side by side; `logo-concepts-2.png` shows concepts 4–9.

| Concept | Files | Best for |
|---|---|---|
| **1 · Stacked wordmark** | `1-stacked-wordmark(.svg/-white.svg)` | The current site wordmark, refined. Website header, email signature, print. |
| **2 · OC monogram + lockup** | `2-monogram*`, `2-lockup*` | The monogram works small: site icon (favicon), Instagram profile, watermark, gallery cover, packaging stamp. The lockup is a wide horizontal version for headers and letterhead. |
| **3 · Editorial masthead** | `3-editorial*` | Sentence case with an italic *Portraits*, like a magazine title. Feels the most "luxury editorial". |
| **4 · Inverted hierarchy** | `4-inverted*` | Small spaced ORANGE COUNTY above a large italic *Portraits*. Strong on photo covers and Instagram. |
| **5 · Framed stationery label** | `5-framed*` | Thin double frame around the name and "Cypress · California". Print collateral, packaging stickers, gallery covers. |
| **6 · OCP monogram lockup** | `6-ocp-monogram*` | Interlocked OCP with the name beneath. Watermarks, profile pictures, a square badge. |
| **7 · Single line** | `7-single-line*` | One widely spaced line with rose dots. Very minimal; good for narrow header bars and email footers. |
| **8 · Lens O** | `8-lens*` | Sentence-case name where the O is a drawn lens ring with a rose centre. The only concept with a photography nod. |
| **9 · Tiered atelier label** | `9-tiered*` | Three tiers with hairlines, hotel/atelier style. Print, packaging, a formal mark. |

Colors:
- Forest `#263E34` for the logo itself.
- White versions for use on forest or sage backgrounds.
- A dusty rose `#C6A49D` hairline accent.

`png/` holds high-resolution PNG exports with transparent backgrounds. `2-monogram-site-icon.png` is ready for **Settings → General → Site Icon**.

To regenerate the files, run `pip install fonttools brotli`, then `python3 tools/build-logos.py`.
