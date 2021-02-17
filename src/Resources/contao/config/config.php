<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'duncrowFlipbertExtension' => array(
        'duncrowFlipbook' => array
        (
            'tables'        => array('tl_flipbook')
        )
    )
));

if ('BE' === TL_MODE) {
    $GLOBALS['TL_CSS'][] = 'bundles/duncrowflipbert/dist/backend.css';
}

$GLOBALS['TL_CONFIG']['server'] = 'https://flipbert.duncrow.com';

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_flipbook'] = '\\DuncrowGmbh\\Flipbert\\Models\\FlipbookModel';

/**
 * Content Elements
 */
array_insert($GLOBALS['TL_CTE'], 1, array
(
    'duncrowFlipbook' => array(
        'duncrowFlipbook' => '\\DuncrowGmbh\\Flipbert\\Classes\\Flipbook',
        'duncrowFlipbookRow' => '\\DuncrowGmbh\\Flipbert\\Classes\\FlipbookRow'
    )
));
