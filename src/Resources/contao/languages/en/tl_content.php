<?php

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbook'] = array('Flipbook', 'Select the flipbook to display.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbooks'] = array('Flipbooks', 'Select the flipbooks to display and their sort order.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookControlbarPosition'] = array('Control bar position', 'Select the position of the control bar.');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHeight'] = array('Flipbook height', 'Enter the height of the flipbook in pixels.');
$GLOBALS['TL_LANG']['tl_content']['duncrowRatioCustom'] = array('Custom Ratio Flipbooks', '16 / 9 or 4 / 3 etc. (overwrites height and PDF Format) <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/Guides/Box_sizing/Aspect_ratios" target="_blank" style="text-decoration:underline">more infos</a>');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookBackgroundColor'] = array('Background color', 'Enter the background color as a hex value. (empty = transparent background)');
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHiddenControlElements'] = array('Hidden icons of the control bar', 'Select the icons you want to hide in the control bar.');

$GLOBALS['TL_LANG']['tl_content']['duncrowRatio'] =array('PDF Format (Ratio) Flipbooks', '(overwrites height)');
$GLOBALS['TL_LANG']['tl_content']['duncrowRatio']['options'] = 
array(
    '210 / 297'   => 'DIN A4 Portrait (210 x 297 mm)',
    '297 / 210'   => 'DIN A4 Landscape (297 x 210 mm)',
    '148 / 210'   => 'DIN A5 Portrait (148 x 210 mm)',
    '210 / 148'   => 'DIN A5 Landscape (210 x 148 mm)',
    '105 / 148'   => 'DIN A6 Portrait (105 x 148 mm)',
    '148 / 105'   => 'DIN A6 Landscape (148 x 105 mm)',
    '8.5 / 11'    => 'Letter Portrait (8.5" x 11")',
    '11 / 8.5'    => 'Letter Landscape (11" x 8.5")',
    '8.5 / 14'    => 'Legal Portrait (8.5" x 14")',
    '14 / 8.5'    => 'Legal Landscape (14" x 8.5")',
    '7 / 10'      => 'Executive Portrait (7" x 10")',
    '10 / 7'      => 'Executive Landscape (10" x 7")',
    '16 / 9'      => 'Widescreen (16:9)',
    '4 / 3'       => 'Standard (4:3)',
    '3 / 4'       => 'Standard Portrait (3:4)'
);

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_content']['duncrowFlipbookHiddenControlElements']['options'] = array(
    'share' => 'Share',
    'download' => 'Download',
    'fullScreen' => 'Fullscreen',
    'thumbnail' => 'Thumbnail view',
    'outline' => 'Table of contents'
);

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['flipbookOptions_legend'] = 'Options';
