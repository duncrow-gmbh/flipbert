<?php

/**
 * System configuration
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['license'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['flipbook']['license'],
    'inputType'               => 'text',
    'save_callback' => array(
        array( 'duncrowFlipbook_tl_settings', 'checkLicenses' )
    ),
    'eval'                    => array( 'maxlength' => 255, 'tl_class' => 'w50' )
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['server'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['flipbook']['server'],
    'inputType'               => 'text',
    'eval'                    => array( 'maxlength' => 255, 'tl_class' => 'w50', 'disabled' => true )
);

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{flipbook_legend:hide},license,server;';


class duncrowFlipbook_tl_settings extends Backend {

    public function checkLicenses($varValue, DataContainer $dc) {

        $params = [
            'license' => $varValue
        ];

        $server = $GLOBALS['TL_CONFIG']['server'].'/checkLicenses';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $server, [
            'query' => $params
        ]);

        $response = json_decode($response->getBody()->getContents());

        if($response->error) {
            throw new \Exception($GLOBALS['TL_LANG']['tl_settings'][$response->error]);
        }

        return $varValue;
    }
}
