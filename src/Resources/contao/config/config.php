<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'duncrowFlipbertExtension' => array(
        'duncrowFlipbook' => array
        (
            'tables'        => array('tl_flipbook'),
            'icon'          => 'system/modules/flipbook/assets/img/box-icon.png',
        )
    )
));

if ('BE' === TL_MODE) {
    $GLOBALS['TL_CSS'][] = 'bundles/flipbert/dist/backend.css';
}

$GLOBALS['TL_CONFIG']['server'] = 'http://backend.flipbook.test';

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_flipbook'] = '\\duncrow\\FlipbertBundle\\FlipbookModel';

/**
 * Content Elements
 */
array_insert($GLOBALS['TL_CTE'], 1, array
(
    'duncrowFlipbook' => array(
        'duncrowFlipbook' => '\\duncrow\\FlipbertBundle\\Flipbook',
        'duncrowFlipbookRow' => '\\duncrow\\FlipbertBundle\\FlipbookRow'
    )
));
