<?php
use Contao\System;
use Symfony\Component\HttpFoundation\Request; 
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

if (System::getContainer()
    ->get('contao.routing.scope_matcher')
    ->isBackendRequest(System::getContainer()
    ->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {
    $GLOBALS['TL_CSS'][] = 'bundles/duncrowgmbhflipbert/dist/backend.css';
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
