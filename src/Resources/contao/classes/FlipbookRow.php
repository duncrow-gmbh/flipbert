<?php

namespace DuncrowGmbh\Flipbert\Classes;

use Contao\FilesModel;
use Contao\Folder;
use DuncrowGmbh\Flipbert\Models\FlipbookModel;

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

            if (!file_exists('/files/flipbert')) {
                $flipbertFolder = new Folder('files/flipbert');
                $flipbertFolder->unprotect();
                $thumbnailsFolder = new Folder('files/flipbert/thumbnails');
            }

            if($flipbook->thumbnail) {
                $objFile = FilesModel::findByUuid($flipbook->thumbnail);
                $thumbnail = $objFile->path;
            }
            else {
                if(!file_exists('files/flipbert/thumbnails/'.$flipbook->alias.'.jpg')) {
                    $im = new \Imagick($pdf.'[0]');
                    $im->setImageFormat('jpg');
                    $im->writeImage('../files/flipbert/thumbnails/'.$flipbook->alias.'.jpg');

                    // recreate symlinks
                    list($class, $method) = $GLOBALS['TL_PURGE']['custom']['symlinks']['callback'];
                    $this->import($class);
                    $this->$class->$method();
                }
                $thumbnail = 'files/flipbert/thumbnails/'.$flipbook->alias.'.jpg';
            }

            $flipbook->thumb = $thumbnail;
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

        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowgmbhflipbert/assets/dflip/js/dflip.js"></script>';
        $GLOBALS['TL_JQUERY'][] = '<script src="/bundles/duncrowgmbhflipbert/dist/flipbert.js"></script>';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/duncrowgmbhflipbert/dist/flipbert.css';
    }
}
