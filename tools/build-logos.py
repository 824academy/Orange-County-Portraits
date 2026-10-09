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


# ---------------------------------------------------------------- concept 4
def inverted(ink=FOREST, accent=ROSE, bg=None):
    """Small tracked sans 'ORANGE COUNTY' above a large italic serif 'Portraits'."""
    W, H = 900, 300
    cx = W / 2
    top, _ = centered(SANS, "ORANGE COUNTY", 20, 0.6, cx + 0.3 * 20, 112, ink)
    rule = f'<rect x="{cx - 20}" y="132" width="40" height="1.2" fill="{accent}"/>'
    word, _ = centered(SERIF_ITALIC, "Portraits", 118, -0.01, cx, 236, ink)
    return svg(W, H, top + rule + word, bg)


# ---------------------------------------------------------------- concept 5
def framed(ink=FOREST, accent=ROSE, bg=None):
    """Stationery label: thin double frame around the stacked name and city."""
    W, H = 760, 420
    cx = W / 2
    sw = 1.2
    frame = (f'<rect x="40" y="40" width="{W-80}" height="{H-80}" fill="none" stroke="{ink}" stroke-width="{sw}"/>'
             f'<rect x="52" y="52" width="{W-104}" height="{H-104}" fill="none" stroke="{ink}" stroke-width="{sw*0.6}"/>')
    name, _ = centered(SERIF, "ORANGE COUNTY", 48, 0.2, cx, 186, ink)
    rule = f'<rect x="{cx - 24}" y="216" width="48" height="1.2" fill="{accent}"/>'
    sub, _ = centered(SANS, "PORTRAITS", 18, 0.62, cx + 0.31 * 18, 256, ink)
    city, _ = centered(SANS, "CYPRESS · CALIFORNIA", 12, 0.4, cx + 0.2 * 12, 322, ink)
    return svg(W, H, frame + name + rule + sub + city, bg)


# ---------------------------------------------------------------- concept 6
def ocp_paths(ink, cx, cy, size):
    """'OCP' set in Newsreader Light with the letters gently interlocked."""
    o_w = width_of(SERIF, "O", size)
    c_w = width_of(SERIF, "C", size)
    p_w = width_of(SERIF, "P", size)
    ov = size * 0.14
    total = o_w + c_w + p_w - 2 * ov
    x0 = cx - total / 2
    base = cy + size * 0.34
    o, _ = text_path(SERIF, "O", size, 0, x0, base)
    c, _ = text_path(SERIF, "C", size, 0, x0 + o_w - ov, base)
    pp, _ = text_path(SERIF, "P", size, 0, x0 + o_w + c_w - 2 * ov, base)
    return f'<path d="{o} {c} {pp}" fill="{ink}"/>'


def ocp_monogram(ink=FOREST, accent=ROSE, bg=None):
    W, H = 700, 420
    cx = W / 2
    body = ocp_paths(ink, cx, 160, 170)
    body += f'<rect x="{cx - 24}" y="268" width="48" height="1.2" fill="{accent}"/>'
    name, _ = centered(SERIF, "ORANGE COUNTY", 34, 0.22, cx, 318, ink)
    sub, _ = centered(SANS, "PORTRAITS", 13, 0.62, cx + 0.31 * 13, 352, ink)
    return svg(W, H, body + name + sub, bg)


# ---------------------------------------------------------------- concept 7
def single_line(ink=FOREST, accent=ROSE, bg=None):
    """One line, widely tracked, with rose dots between the words."""
    W, H = 1300, 200
    size, tr = 58, 0.26
    words = ["ORANGE", "COUNTY", "PORTRAITS"]
    gap = 54
    widths = [width_of(SERIF, w, size, tr) for w in words]
    total = sum(widths) + gap * 2
    x = (W - total) / 2
    body = ""
    for i, w in enumerate(words):
        d, adv = text_path(SERIF, w, size, tr, x, 122)
        body += f'<path d="{d}" fill="{ink}"/>'
        x += adv
        if i < 2:
            body += f'<circle cx="{x + gap/2 + size*tr/2:.1f}" cy="101" r="3" fill="{accent}"/>'
            x += gap
    return svg(W, H, body, bg)


# ---------------------------------------------------------------- concept 8
def lens(ink=FOREST, accent=ROSE, bg=None):
    """Sentence-case serif where the O of 'Orange' is a drawn lens ring."""
    W, H = 1150, 240
    size = 92
    rest = "range County Portraits"
    r_outer = size * 0.33
    gap = size * 0.06
    rest_w = width_of(SERIF, rest, size, -0.005)
    x0 = (W - (2 * r_outer + gap + rest_w)) / 2
    base = 150
    cx = x0 + r_outer
    cy = base - size * 0.34
    ring = (f'<circle cx="{cx:.1f}" cy="{cy:.1f}" r="{r_outer:.1f}" fill="none" stroke="{ink}" stroke-width="{size*0.05:.1f}"/>'
            f'<circle cx="{cx:.1f}" cy="{cy:.1f}" r="{size*0.04:.1f}" fill="{accent}"/>')
    d, _ = text_path(SERIF, rest, size, -0.005, x0 + 2 * r_outer + gap, base)
    tag, _ = centered(SANS, "CYPRESS · ORANGE COUNTY", 15, 0.5, W / 2 + 4, 206, ink)
    return svg(W, H, ring + f'<path d="{d}" fill="{ink}"/>' + tag, bg)


# ---------------------------------------------------------------- concept 9
def tiered(ink=FOREST, accent=ROSE, bg=None):
    """Three-tier label with hairlines — hotel / atelier feel."""
    W, H = 760, 360
    cx = W / 2
    name, nw = centered(SERIF, "ORANGE COUNTY", 56, 0.22, cx, 128, ink)
    half = nw / 2 + 10
    l1 = f'<rect x="{cx-half:.1f}" y="166" width="{half*2:.1f}" height="1" fill="{ink}" opacity="0.55"/>'
    sub, _ = centered(SERIF, "PORTRAITS", 30, 0.42, cx + 0.21 * 30, 214, ink)
    l2 = f'<rect x="{cx-half:.1f}" y="242" width="{half*2:.1f}" height="1" fill="{ink}" opacity="0.55"/>'
    city, _ = centered(SANS, "CYPRESS  ·  CALIFORNIA", 12, 0.42, cx + 0.21 * 12, 282, ink)
    dot = f'<circle cx="{cx}" cy="{166.5}" r="3.2" fill="{bg or WHITE}" stroke="{accent}" stroke-width="1.2"/>'
    return svg(W, H, name + l1 + dot + sub + l2 + city, bg)


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
        "4-inverted.svg": inverted(),
        "4-inverted-white.svg": inverted(WHITE, ROSE),
        "5-framed.svg": framed(),
        "5-framed-white.svg": framed(WHITE, ROSE),
        "6-ocp-monogram.svg": ocp_monogram(),
        "6-ocp-monogram-white.svg": ocp_monogram(WHITE, ROSE),
        "7-single-line.svg": single_line(),
        "7-single-line-white.svg": single_line(WHITE, ROSE),
        "8-lens.svg": lens(),
        "8-lens-white.svg": lens(WHITE, ROSE),
        "9-tiered.svg": tiered(),
        "9-tiered-white.svg": tiered(WHITE, ROSE, FOREST),
    }
    for name, content in files.items():
        with open(os.path.join(OUT, name), "w") as f:
            f.write(content)
    print(f"Wrote {len(files)} SVGs to brand/")


if __name__ == "__main__":
    main()
