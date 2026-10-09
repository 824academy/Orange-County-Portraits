<?php
/**
 * Regenerates the labelled placeholder SVGs and docs/IMAGE-CHECKLIST.md
 * from oc-portraits/inc/image-slots.php.
 *
 * Usage: php tools/build-placeholders.php
 */

$root  = dirname( __DIR__ );
$slots = require $root . '/oc-portraits/inc/image-slots.php';
$dir   = $root . '/oc-portraits/assets/placeholders';

foreach ( glob( $dir . '/*.svg' ) as $old ) {
	unlink( $old );
}

$esc = function ( $s ) {
	return htmlspecialchars( $s, ENT_XML1 | ENT_QUOTES, 'UTF-8' );
};

foreach ( $slots as $key => $s ) {
	list( $rw, $rh ) = array_map( 'floatval', explode( '/', $s['ratio'] ) );
	$w  = 1200;
	$h  = (int) round( $w * $rh / $rw );
	$cx = $w / 2;
	$cy = $h / 2;
	$svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="$w" height="$h" viewBox="0 0 $w $h">
<rect width="$w" height="$h" fill="#DCE4D9"/>
<rect x="24" y="24" width="{$esc($w-48)}" height="{$esc($h-48)}" fill="none" stroke="#9EAF9B" stroke-width="4" stroke-dasharray="18 12"/>
<g font-family="Helvetica, Arial, sans-serif" fill="#263E34" text-anchor="middle">
<text x="$cx" y="{$esc($cy-70)}" font-size="34" letter-spacing="8">PHOTO PLACEHOLDER</text>
<text x="$cx" y="{$esc($cy+10)}" font-size="96" font-family="Georgia, serif">{$esc($s['id'])}</text>
<text x="$cx" y="{$esc($cy+70)}" font-size="34">{$esc($s['page'])} — {$esc($s['place'])}</text>
<text x="$cx" y="{$esc($cy+120)}" font-size="30" fill="#4F604D">Crop {$esc($s['ratio'])} · upload about {$esc($s['size'])} px</text>
</g>
</svg>
SVG;
	file_put_contents( "$dir/$key.svg", $svg . "\n" );
}

$orientation = function ( $ratio ) {
	list( $w, $h ) = array_map( 'floatval', explode( '/', $ratio ) );
	return $w > $h ? 'Landscape' : ( $w < $h ? 'Portrait' : 'Square' );
};

$md  = "# Image placement checklist\n\n";
$md .= "Generated from `oc-portraits/inc/image-slots.php` by `tools/build-placeholders.php`. Each placeholder on the site shows its ID (H1, F2…).\n\n";
$md .= "**How to replace:** open the page in the editor → click the placeholder → toolbar **Replace** → upload. Then write alt text describing *your* photo (who, what, where — e.g. \"Two children laughing with their mother on a picnic blanket\").\n\n";
$md .= "**Export settings:** JPEG, sRGB, quality ~80, long edge about 2000–2400 px (WordPress makes the smaller sizes automatically). Aim for under ~500 KB each; the home hero (H1) under ~400 KB. Keep faces away from the edges — the site crops to the ratio shown, and on phones hero images crop to 4:3.\n\n";
$md .= "| ID | Page | Placement | Orientation (crop) | Recommended upload | Suggested subject | Done |\n|---|---|---|---|---|---|---|\n";
foreach ( $slots as $s ) {
	$md .= "| {$s['id']} | {$s['page']} | {$s['place']} | {$orientation($s['ratio'])} ({$s['ratio']}) | {$s['size']} px | {$s['subject']} | ☐ |\n";
}
$md .= "\n## Blog posts\n\n| Placement | Orientation | Recommended upload | Notes |\n|---|---|---|---|\n";
$md .= "| Featured image (each post) | Landscape — shown 16:9 on the article, 16:10 on the blog index, 3:2 on the homepage, 4:3 in related posts | 2000 × 1250 px | Keep the subject centred so every crop works. |\n";
$md .= "| Images inside an article | Any | 1600–2000 px long edge | Optional. Add alt text. |\n";
$md .= "\n## Reuse is fine\n\nThe same photograph can fill several slots (e.g. H2 = F2, A1 = H7, P2 = C2). Upload once and choose it from the Media Library.\n";
$md .= "\n## Never use\n\nGenerated photographs, stock photos presented as your work, or a headshot that isn't you. Delete any slot you can't fill well (X3 especially) rather than leaving a placeholder at launch.\n";
file_put_contents( $root . '/docs/IMAGE-CHECKLIST.md', $md );
echo count( $slots ) . " placeholders written.\n";
