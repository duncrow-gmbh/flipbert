<?php

$strFolder = 'FlipbertBundle';
$strNamespace = 'Duncrow\\' . $strFolder;

// Register the namespace
ClassLoader::addNamespaces(array(
    $strNamespace
));

/**
 * Register the templates
 */
/*TemplateLoader::addFiles(array
(
    'duncrow_flipbook'          =>        "system/modules/flipbert/templates",
    'j_duncrowFlipbook'         =>        "system/modules/flipbert/templates"
));*/
