<?php

namespace DuncrowGmbh\Flipbert\Controller\ContentElement;

use Contao\FilesModel;
use Contao\Folder;
use DuncrowGmbh\Flipbert\Model\FlipbookModel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\ContentModel;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\BackendTemplate; 
use Symfony\Component\HttpFoundation\Response;


#[AsContentElement('duncrowFlipbookRow', category: 'Flipbert', template:'duncrow_flipbook_row')]
class FlipbookRowController extends AbstractContentElementController
{

    protected function getResponse(FragmentTemplate $template, ContentModel  $model, Request $request): Response
    {
        

        $objFlipbooks = FlipbookModel::findMultipleByIds(unserialize($model->duncrowFlipbooks));

        if(isset($objFlipbooks)){
            foreach($objFlipbooks as $flipbook) {
                $pdf = FilesModel::findByUuid($flipbook->pdf)->path;
    
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
        }
        

        if (System::getContainer()
            ->get('contao.routing.scope_matcher')
            ->isBackendRequest(System::getContainer()
            ->get('request_stack')->getCurrentRequest() ?? Request::create(''))) { 
            // $this->strTemplate          = 'be_wildcard';
            //$this->Template             = new \BackendTemplate($this->strTemplate);
            $template           = new BackendTemplate('backend/be_duncrow_flipbook_row');
            $template->title      = $model->headline;
            $template->wildcard   = '';
            $template->flipbooks = $objFlipbooks;
        }
        else {
            $template->flipbooks = $objFlipbooks;
        }

        $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/flipbert/assets/dflip/js/dflip.js';
        $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/flipbert/dist/flipbert.js';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/dist/flipbert.css';

        return $template->getResponse();
    }
}
