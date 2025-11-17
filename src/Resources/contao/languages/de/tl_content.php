<?php
// languages/de/tl_content.php

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbook'] = array('Flipbook', 'Wählen Sie das anzuzeigende Flipbook aus.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbooks'] = array('Flipbooks', 'Wählen Sie die anzuzeigenden Flipbooks und ihre Sortierung aus.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookControlbarPosition'] = array('Position der Kontrollleiste', 'Wählen Sie die Position der Kontrollleiste aus.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHeight'] = array('Höhe des Flipbooks', 'Geben Sie die Höhe des Flipbooks in Pixel ein.');
$GLOBALS['TL_LANG']['tl_content']['duncrowRatioCustom'] = array('Custom Ratio Flipbooks', '16 / 9 or 4 / 3 etc. (überschreibt die Höhe und das PDF Format) <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/Guides/Box_sizing/Aspect_ratios"  style="text-decoration:underline" target="_blank">more infos</a>');
$GLOBALS['TL_LANG']['tl_content']['duncrowRatio'] = array('PDF Format (Ratio) Flipbooks', '(überschreibt die Höhe) ');
$GLOBALS['TL_LANG']['tl_content']['duncrowRatio']['options'] = 
array(
    '210 / 297'   => 'DIN A4 Hochformat (210 x 297 mm)',
    '297 / 210'   => 'DIN A4 Querformat (297 x 210 mm)',
    '148 / 210'   => 'DIN A5 Hochformat (148 x 210 mm)',
    '210 / 148'   => 'DIN A5 Querformat (210 x 148 mm)',
    '105 / 148'   => 'DIN A6 Hochformat (105 x 148 mm)',
    '148 / 105'   => 'DIN A6 Querformat (148 x 105 mm)',
    '8.5 / 11'    => 'Letter Hochformat (8.5" x 11")',
    '11 / 8.5'    => 'Letter Querformat (11" x 8.5")',
    '8.5 / 14'    => 'Legal Hochformat (8.5" x 14")',
    '14 / 8.5'    => 'Legal Querformat (14" x 8.5")',
    '7 / 10'      => 'Executive Hochformat (7" x 10")',
    '10 / 7'      => 'Executive Querformat (10" x 7")',
    '16 / 9'      => 'Widescreen (16:9)',
    '4 / 3'       => 'Standard (4:3)',
    '3 / 4'       => 'Standard Hochformat (3:4)'
);
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookBackgroundColor'] = array('Hintergrundfarbe', 'Geben Sie die Hintergrundfarbe als Hex-Wert ein. (leer = transparenter Hintergrund)');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHiddenControlElements'] = array('Ausgeblendete Icons der Kontrollleiste', 'Wählen Sie die Icons aus, welche in der Kontrollleiste ausgeblendet werden sollen.');

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHiddenControlElements']['options'] = array(
    'share' => 'Share',
    'download' => 'Download',
    'fullScreen' => 'Fullscreen',
    'thumbnail' => 'Miniaturenansicht',
    'outline' => 'Inhaltsverzeichnis'
);

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['flipbookOptions_legend'] = 'Optionen';
