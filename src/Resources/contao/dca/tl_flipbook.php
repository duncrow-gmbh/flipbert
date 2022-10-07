<?php

/**
 * Table tl_flipbook
 */

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

$GLOBALS['TL_DCA']['tl_flipbook'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'switchToEdit' => true,
        'enableVersioning' => true,
        'onsubmit_callback' => array(
            array('tl_flipbook', 'generateAlias')
        ),
        'ondelete_callback' => array(
            array('tl_flipbook', 'deleteOnServer')
        ),
        'onload_callback' => array(
            array('tl_flipbook', 'showLicenseHint')
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'published' => 'index',
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 0,
            'fields' => array('title'),
            'flag' => 1,
            'panelLayout' => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields' => array('title'),
            'showColumns' => true
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['toggle'],
                'icon' => 'visible.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_flipbook', 'btnToggle')
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default' => '
			{general_legend},title,alias,pdf,thumbnail;
			{published_legend},published,start,stop;
		',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['title'],
            'search' => true,
            'inputType' => 'text',
            'save_callback' => array(
                array('tl_flipbook', 'createOnServer')
            ),
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['alias'],
            'inputType' => 'text',
            'eval' => array('rgxp' => 'alias', 'doNotCopy' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'flipbook_id' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['flipbook_id'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 10, 'rgxp' => 'natural'),
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'pdf' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['pdf'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array('mandatory' => true, 'fieldType' => 'radio', 'files' => true, 'filesOnly' => true, 'tl_class' => 'clr w50', 'extensions' => 'pdf'),
            'sql' => "blob NULL"
        ),
        'thumbnail' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['thumbnail'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array('mandatory' => false, 'fieldType' => 'radio', 'files' => true, 'filesOnly' => true, 'tl_class' => 'w50', 'extensions' => \Contao\Config::get('validImageTypes')),
            'sql' => "blob NULL"
        ),
        'published' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['published'],
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => array('doNotCopy' => true, 'tl_class' => 'clr'),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'start' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['start'],
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "varchar(11) NOT NULL default ''"
        ),
        'stop' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_flipbook']['stop'],
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "varchar(11) NOT NULL default ''"
        )
    )
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_flipbook extends Backend
{

    public function showLicenseHint($dc)
    {
        if ($_POST || Input::get('act') != 'edit') {
            return;
        }

        Message::addInfo($GLOBALS['TL_LANG']['tl_flipbook']['fillLicense']);
    }

    /**
     * Return the "toggle visibility" button
     *
     * @param array $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function btnToggle($row, $href, $label, $title, $icon, $attributes): string
    {
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"') . '</a> ';
    }

    /**
     * Disable/enable an event
     *
     * @param integer $intId
     * @param boolean $blnVisible
     * @param DataContainer|null $dc
     */
    public function toggleVisibility(int $intId, bool $blnVisible, DataContainer $dc = null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        if ($dc) {
            $dc->id = $intId; // see #8043
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_flipbook SET tstamp=" . time() . ", published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
            ->execute($intId);
    }

    /**
     * Auto-generate the product alias if it has not been set yet
     *
     * @param DataContainer $dc
     *
     * @return string
     *
     */
    public function generateAlias(DataContainer $dc): string
    {
        $autoAlias = false;
        $varValue = $dc->activeRecord->alias;

        // Generate alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_flipbook WHERE alias=?")
            ->execute($varValue);

        // Check whether the news alias exists
        if ($objAlias->numRows > 1 && !$autoAlias) {
            #throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            $varValue .= '-' . $dc->id;
        }

        // Add ID to alias
        if ($objAlias->numRows && $autoAlias) {
            $varValue .= '-' . $dc->id;
        }

        $this->Database->prepare("UPDATE tl_flipbook set alias=? WHERE id = ?")
            ->execute($varValue, $dc->id);

        return $varValue;
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function createOnServer($varValue, DataContainer $dc)
    {

        $license = $GLOBALS['TL_CONFIG']['license'];

        $params = [
            'title' => $varValue,
            'domain' => $_SERVER['SERVER_NAME'],
            'license' => $license
        ];

        if ($flipbookId = $dc->activeRecord->flipbook_id)
            $params['flipbookId'] = $flipbookId;

        $server = $GLOBALS['TL_CONFIG']['server'] . '/create';

        $client = new Client();
        $response = $client->request('GET', $server, [
            'query' => $params
        ]);

        $response = json_decode($response->getBody()->getContents());

        if ($response->error) {
            throw new \Exception($GLOBALS['TL_LANG']['tl_flipbook'][$response->error]);
        }

        $this->Database
            ->prepare("UPDATE tl_flipbook set flipbook_id=? WHERE id = ?")
            ->execute($response->flipbookId, $dc->id);

        return $varValue;
    }

    /**
     * @throws GuzzleException
     */
    public function deleteOnServer(DataContainer $dc)
    {

        $server = $GLOBALS['TL_CONFIG']['server'] . '/delete';

        $client = new Client();

        try {
            $response = $client->request('GET', $server, [
                'query' => ['flipbookId' => $dc->activeRecord->flipbook_id]
            ]);
        } catch (Exception $exception) {
        }
    }
}
