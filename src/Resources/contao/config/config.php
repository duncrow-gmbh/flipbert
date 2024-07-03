<?php
use Contao\System;
use Symfony\Component\HttpFoundation\Request; 
use DuncrowGmbh\Flipbert\Model\FlipbookModel; 
    
use Contao\ArrayUtil;

$GLOBALS['TL_MODELS']['tl_flipbook'] = FlipbookModel::class;

/**
 * Back end modules
 */
ArrayUtil::arrayInsert($GLOBALS['BE_MOD'], 1, array
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
    $GLOBALS['TL_CSS'][] = 'bundles/flipbert/dist/backend.css';
}

$GLOBALS['TL_CONFIG']['server'] = 'https://flipbert.duncrow.com';



/**
 * Content Elements
 */
// ArrayUtil::arrayInsert($GLOBALS['TL_CTE'], 1, array
// (
//     'duncrowFlipbook' => array(
//         'duncrowFlipbook' => '\\DuncrowGmbh\\Flipbert\\Controller\\ContentElement\\FlipbookController',
//         'duncrowFlipbookRow' => '\\DuncrowGmbh\\Flipbert\\Controller\\ContentElement\\FlipbookRowController'
//     )
// ));
