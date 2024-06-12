<?php

namespace DuncrowGmbh\Flipbert\Classes;

use DuncrowGmbh\Flipbert\Models\FlipbookModel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request; 

class Flipbook extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'frontend/duncrow_flipbook';

    /**
     * Generate the content element
     */
    protected function compile()
    {
        $objFlipbook = FlipbookModel::findOneBy('id', $this->duncrowFlipbook);

        if (System::getContainer()
            ->get('contao.routing.scope_matcher')
            ->isBackendRequest(System::getContainer()
            ->get('request_stack')->getCurrentRequest() ?? Request::create('')))
        {
            $this->strTemplate          = 'be_wildcard';
            $this->Template             = new \BackendTemplate($this->strTemplate);
            $this->Template->title      = $this->headline;
            $this->Template->wildcard   = $objFlipbook->title;
        }
        else {
            $this->Template->flipbook = $objFlipbook;
        }

        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowgmbhflipbert/assets/dflip/js/dflip.js"></script>';
        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowgmbhflipbert/dist/flipbert.js"></script>';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/dist/flipbert.css';
    }
}
