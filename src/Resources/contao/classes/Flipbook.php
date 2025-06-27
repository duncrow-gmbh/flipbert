<?php

namespace DuncrowGmbh\Flipbert\Classes;

use DuncrowGmbh\Flipbert\Models\FlipbookModel;

class Flipbook extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'duncrow_flipbook';

    /**
     * Generate the content element
     */
    protected function compile()
    {
        $objFlipbook = FlipbookModel::findOneBy('id', $this->duncrowFlipbook);

        if (TL_MODE == 'BE')
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
