<?php
use Contao\Input;
// dca/tl_content.php
/**
 * Table tl_content
 */
$strName = 'tl_content';

//$GLOBALS['TL_DCA'][$strName]['config']['onload_callback'][] = array('duncrowFlipbook_tl_content', 'showJsLibraryHint');

/* Palettes */
$GLOBALS['TL_DCA'][$strName]['palettes']['duncrowFlipbook'] = '{type_legend},type,duncrowFlipbook;{flipbookOptions_legend},duncrowFlipbookHeight,duncrowFlipbookControlbarPosition,duncrowFlipbookBackgroundColor,duncrowFlipbookHiddenControlElements;{invisible_legend:hide},invisible,start,stop;';
$GLOBALS['TL_DCA'][$strName]['palettes']['duncrowFlipbookRow'] = '{type_legend},type,duncrowFlipbooks;{flipbookOptions_legend},duncrowFlipbookControlbarPosition,duncrowFlipbookHiddenControlElements;{invisible_legend:hide},invisible,start,stop;';

/* Fields */
$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbook'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbook'],
    'inputType'  => 'select',
    'filter'     => true,
    'foreignKey' => 'tl_flipbook.title',
    'eval'       => array(
        'mandatory'    => true,
        'titleField'   => 'title',
        'searchField'  => 'title',
        'tl_class'     => 'clr w50'
    ),
    'sql'        => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbooks'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbooks'],
    'inputType'  => 'checkboxWizard',
    'filter'     => true,
    'foreignKey' => 'tl_flipbook.title',
    'eval'       => array(
        'mandatory'    => true,
        'multiple'     => true,
        'titleField'   => 'title',
        'searchField'  => 'title',
        'tl_class'     => 'clr w50'
    ),
    'sql'        => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbookHeight'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbookHeight'],
    'inputType'  => 'text',
    'eval'       => array(
        'mandatory'     => true,
        'maxlength'     => 10,
        'rgxp'          => 'natural',
        'tl_class'      => 'clr w50'
    ),
    'sql'        => "int(10) unsigned NOT NULL default '500'"
);

$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbookControlbarPosition'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbookControlbarPosition'],
    'inputType'  => 'select',
    'filter'     => true,
    'options'    => array(
        'top' => 'Oben',
        'bottom' => 'Unten',
        'left' => 'Links',
        'right' => 'Rechts'
    ),
    'eval'       => array(
        'mandatory'    => true,
        'tl_class'     => 'w50'
    ),
    'sql'        => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbookBackgroundColor'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbookBackgroundColor'],
    'inputType'  => 'text',
    'eval'       => array(
        'mandatory'     => false,
        'tl_class'      => 'clr w50'
    ),
    'sql'        => "varchar(12) NOT NULL default 'transparent'"
);

$GLOBALS['TL_DCA'][$strName]['fields']['duncrowFlipbookHiddenControlElements'] = array
(
    'label'      => &$GLOBALS['TL_LANG'][$strName]['duncrowFlipbookHiddenControlElements'],
    'inputType'  => 'checkbox',
    'options'    => ($GLOBALS['TL_LANG'][$strName]['duncrowFlipbookHiddenControlElements']['options'] ?? []),
    'eval'       => array(
        'mandatory'     => false,
        'tl_class'      => 'w50',
        'multiple'      => true
    ),
    'sql'        => "blob NULL"
);




class duncrowFlipbook_tl_content extends tl_content {

    /**
     * Show a hint if a JavaScript library needs to be included in the page layout
     *
     * @param object
     */
    public function showJsLibraryHint($dc)
    {
        if ($_POST || Input::get('act') != 'edit')
        {
            return;
        }

        // Return if the user cannot access the layout module (see #6190)
        if (!$this->User->hasAccess('themes', 'modules') || !$this->User->hasAccess('layout', 'themes'))
        {
            return;
        }

        $objCte = ContentModel::findByPk($dc->id);

        if ($objCte === null)
        {
            return;
        }

        switch ($objCte->type)
        {

            case 'duncrowFlipbook':
            case 'duncrowFlipbookRow':
                Message::addInfo(sprintf($GLOBALS['TL_LANG']['tl_content']['includeTemplate'], 'j_duncrowFlipbook'));
                break;
        }
    }
}
