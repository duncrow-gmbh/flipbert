<?php

namespace Duncrow\FlipbertBundle;

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

        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowflipbert/assets/dflip/js/dflip.js"></script>';
        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowflipbert/dist/flipbert.js"></script>';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowflipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowflipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowflipbert/dist/flipbert.css';
    }
}
