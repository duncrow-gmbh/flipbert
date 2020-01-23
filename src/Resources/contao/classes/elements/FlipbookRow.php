<?php

namespace duncrow\FlipbertBundle;

class FlipbookRow extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'frontend/duncrow_flipbook_row';

    /**
     * Generate the content element
     */
    protected function compile()
    {
        $objFlipbooks = FlipbookModel::findMultipleByIds(unserialize($this->duncrowFlipbooks));

        foreach($objFlipbooks as $flipbook) {
            $pdf = \FilesModel::findByUuid($flipbook->pdf)->path;
            $im = new \Imagick($pdf.'[0]');
            $im->setImageFormat('jpg');
            $im->writeImage('bundles/flipbert/thumbnails/'.$flipbook->alias.'.jpg');

            $flipbook->thumb = 'bundles/flipbert/thumbnails/'.$flipbook->alias.'.jpg';
        }

        if (TL_MODE == 'BE')
        {
            $this->strTemplate          = 'be_wildcard';
            //$this->Template             = new \BackendTemplate($this->strTemplate);
            $this->Template             = new \BackendTemplate('backend/be_duncrow_flipbook_row');
            $this->Template->title      = $this->headline;
            $this->Template->wildcard   = '';
            $this->Template->flipbooks = $objFlipbooks;
        }
        else {
            $this->Template->flipbooks = $objFlipbooks;
        }

        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/flipbert/assets/dflip/js/dflip.js"></script>';
        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/flipbert/dist/flipbert.js"></script>';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/dist/flipbert.css';
    }
}
