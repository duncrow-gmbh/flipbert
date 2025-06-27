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
    protected $strTemplate = 'duncrow_flipbook_row';

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
                if(extension_loaded('imagick')){
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
                }else  if(extension_loaded('gd')){
                    // TODO: Enable GD Extension (untested)
                    // if(!file_exists('files/flipbert/thumbnails/'.$flipbook->alias.'.jpg')) {

                    //     // Convert to PNG files, so GD can be used for the following processing
                    //         //../files/flipbert/thumbnails/
                    //         // JPG
                    //         $cacheDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pdftoimage' . DIRECTORY_SEPARATOR . bin2hex((new Secure())->generate());
                    //         $this->filesystem->mkdir($this->cacheDir);
                    //         (new Process([
                    //             'gs',
                    //             '-dSAFER',
                    //             '-dBATCH',
                    //             '-dNOPAUSE',
                    //             '-sDEVICE=png16m',
                    //             '-dTextAlphaBits=4',
                    //             '-dGraphicsAlphaBits=4',
                    //             '-r' . $resolution,
                    //             '-sOutputFile=' . $cacheDir . DIRECTORY_SEPARATOR . '%03d.png',
                    //             $pdf[0]
                    //             ])
                    //         )->mustRun();

    
                    //     // recreate symlinks
                    //     list($class, $method) = $GLOBALS['TL_PURGE']['custom']['symlinks']['callback'];
                    //     $this->import($class);
                    //     $this->$class->$method();
                    // }
                    // $thumbnail = 'files/flipbert/thumbnails/'.$flipbook->alias.'.jpg';
                    $thumbnail = ''; 
                }else{
                    $thumbnail = ''; 
                }
                
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
