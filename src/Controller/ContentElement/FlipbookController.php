<?php

namespace DuncrowGmbh\Flipbert\Controller\ContentElement;

use DuncrowGmbh\Flipbert\Model\FlipbookModel;
use Contao\Folder;
use Contao\System;
use Contao\ContentModel;
use Symfony\Component\HttpFoundation\Request; 
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Response;
use Contao\BackendTemplate; 
    
#[AsContentElement('duncrowFlipbook', category: 'Flipbert', template:'duncrow_flipbook')]
class FlipbookController extends AbstractContentElementController
{

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        // dd($model); 
        $objFlipbook = FlipbookModel::findOneBy('id', $model->duncrowFlipbook);

        if (System::getContainer()
            ->get('contao.routing.scope_matcher')
            ->isBackendRequest(System::getContainer()
            ->get('request_stack')->getCurrentRequest() ?? Request::create('')))
        {
            
            $template        = new BackendTemplate('be_wildcard');
            $template->title      = $model->headline;
            $template->wildcard   = $objFlipbook->title;
        }
        else {
            $template->flipbook = $objFlipbook;
        }
        
        $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/flipbert/assets/dflip/js/dflip.js';
        $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/flipbert/dist/flipbert.js';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/dflip.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/assets/dflip/css/themify-icons.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/flipbert/dist/flipbert.css';

        return $template->getResponse();
    }
}
