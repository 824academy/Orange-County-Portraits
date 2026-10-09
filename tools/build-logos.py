"""
Builds the Orange County Portraits logo concepts as outlined SVGs
(no font dependency) from the theme's own font files.

Usage: python3 tools/build-logos.py
Requires: pip install fonttools brotli
"""

import io
import os

from fontTools.pens.svgPathPen import SVGPathPen
from fontTools.pens.transformPen import TransformPen
from fontTools.ttLib import TTFont
from fontTools.varLib import instancer

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
FONTS = os.path.join(ROOT, "oc-portraits", "assets", "fonts")
OUT = os.path.join(ROOT, "brand")

FOREST = "#263E34"
SAGE = "#9EAF9B"
PALE = "#EFF3ED"
ROSE = "#C6A49D"
WHITE = "#FFFFFF"


def load(name, wght):
    font = TTFont(os.path.join(FONTS, name))
    font = instancer.instantiateVariableFont(font, {"wght": wght})
    buf = io.BytesIO()
    font.flavor = None
    font.save(buf)
    buf.seek(0)
    return TTFont(buf)


SERIF = load("newsreader-latin-wght-normal.woff2", 300)
SERIF_ITALIC = load("newsreader-latin-wght-italic.woff2", 300)
SANS = load("figtree-latin-wght-normal.woff2", 500)


def text_path(font, text, size, tracking=0.0, x=0.0, y=0.0):
    """Return (svg path d, advance width) for text at baseline y."""
    upm = font["head"].unitsPerEm
    cmap = font.getBestCmap()
    gs = font.getGlyphSet()
    hmtx = font["hmtx"]
    scale = size / upm
    d = []
    cursor = x
    for i, ch in enumerate(text):
        name = cmap.get(ord(ch))
        if name is None:
            continue
        pen = SVGPathPen(gs)
        tpen = TransformPen(pen, (scale, 0, 0, -scale, cursor, y))
        gs[name].draw(tpen)
        d.append(pen.getCommands())
        cursor += hmtx[name][0] * scale
        if i < len(text) - 1:
            cursor += tracking * size
    return " ".join(p for p in d if p), cursor - x


def width_of(font, text, size, tracking=0.0):
    return text_path(font, text, size, tracking)[1]


def svg(w, h, body, bg=None, title="Orange County Portraits"):
    rect = f'<rect width="{w}" height="{h}" fill="{bg}"/>' if bg else ""
    return (
        f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {w:.0f} {h:.0f}" '
        f'width="{w:.0f}" height="{h:.0f}" role="img" aria-label="{title}">'
        f"<title>{title}</title>{rect}{body}</svg>\n"
    )


def centered(font, text, size, tracking, cx, y, fill):
    w = width_of(font, text, size, tracking)
    d, _ = text_path(font, text, size, tracking, cx - w / 2, y)
    return f'<path d="{d}" fill="{fill}"/>', w


# ---------------------------------------------------------------- concept 1
def stacked(ink=FOREST, accent=ROSE, bg=None):
    """ORANGE COUNTY / rule / PORTRAITS — the site's wordmark, refined."""
    W, H = 900, 300
    cx = W / 2
    top, w1 = centered(SERIF, "ORANGE COUNTY", 78, 0.2, cx, 150, ink)
    bottom, _ = centered(SANS, "PORTRAITS", 22, 0.62, cx + 0.31 * 22, 228, ink)
    rule = f'<rect x="{cx - 28}" y="183" width="56" height="1.5" fill="{accent}"/>'
    return svg(W, H, top + rule + bottom, bg)


# ---------------------------------------------------------------- concept 2
def monogram_paths(ink, cx, cy, r):
    """Thin ring with an 'OC' monogram set in Newsreader Light."""
    size = r * 1.05
    o_w = width_of(SERIF, "O", size)
    c_w = width_of(SERIF, "C", size)
    overlap = size * 0.16  # letters interlock slightly
    total = o_w + c_w - overlap
    x0 = cx - total / 2
    base = cy + size * 0.34
    o, _ = text_path(SERIF, "O", size, 0, x0, base)
    c, _ = text_path(SERIF, "C", size, 0, x0 + o_w - overlap, base)
    ring = f'<circle cx="{cx}" cy="{cy}" r="{r}" fill="none" stroke="{ink}" stroke-width="{max(1.2, r * 0.012):.2f}"/>'
    return ring + f'<path d="{o} {c}" fill="{ink}"/>'


def monogram(ink=FOREST, bg=None, size=512):
    return svg(size, size, monogram_paths(ink, size / 2, size / 2, size * 0.42), bg)


def lockup(ink=FOREST, accent=ROSE, bg=None):
    """Monogram + hairline + stacked name, for headers and letterhead."""
    W, H = 1000, 260
    body = monogram_paths(ink, 130, H / 2, 92)
    body += f'<rect x="262" y="{H / 2 - 62}" width="1.2" height="124" fill="{accent}"/>'
    x = 300
    d1, _ = text_path(SERIF, "ORANGE COUNTY", 64, 0.18, x, H / 2 + 6)
    d2, _ = text_path(SANS, "PORTRAITS", 19, 0.62, x + 3, H / 2 + 58)
    body += f'<path d="{d1}" fill="{ink}"/><path d="{d2}" fill="{ink}"/>'
    return svg(W, H, body, bg)


# ---------------------------------------------------------------- concept 3
def editorial(ink=FOREST, accent=ROSE, bg=None):
    """Sentence-case serif with an italic 'Portraits' — magazine masthead feel."""
    W, H = 1100, 240
    size = 92
    a_w = width_of(SERIF, "Orange County ", size, -0.005)
    b_w = width_of(SERIF_ITALIC, "Portraits", size, -0.005)
    x0 = (W - a_w - b_w) / 2
    d1, _ = text_path(SERIF, "Orange County ", size, -0.005, x0, 140)
    d2, _ = text_path(SERIF_ITALIC, "Portraits", size, -0.005, x0 + a_w, 140)
    tag, _ = centered(SANS, "CYPRESS · ORANGE COUNTY", 16, 0.5, W / 2 + 4, 200, ink)
    rule = f'<rect x="{W / 2 - 24}" y="168" width="48" height="1.2" fill="{accent}"/>'
    return svg(W, H, f'<path d="{d1}" fill="{ink}"/><path d="{d2}" fill="{ink}"/>' + rule + tag, bg)


def main():
    os.makedirs(OUT, exist_ok=True)
    files = {
        "1-stacked-wordmark.svg": stacked(),
        "1-stacked-wordmark-white.svg": stacked(WHITE, ROSE),
        "2-monogram.svg": monogram(),
        "2-monogram-white.svg": monogram(WHITE),
        "2-monogram-site-icon.svg": monogram(FOREST, PALE),
        "2-lockup.svg": lockup(),
        "2-lockup-white.svg": lockup(WHITE, ROSE),
        "3-editorial.svg": editorial(),
        "3-editorial-white.svg": editorial(WHITE, ROSE),
    }
    for name, content in files.items():
        with open(os.path.join(OUT, name), "w") as f:
            f.write(content)
    print(f"Wrote {len(files)} SVGs to brand/")


if __name__ == "__main__":
    main()
