<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Include necessary files
require_once __DIR__ . '/SoneriticsTrailingSlashConfiguration.php';
require_once __DIR__ . '/Logic/UrlWithTrailingSlash.php';
require_once __DIR__ . '/Logic/UrlWithTrailingSlashProcessor.php';

/**
 * Starts the addon
 */
function initiateAlwaysTrailingStart()
{
// Perform the checks if it's necessary to execute the plugin
    if (!in_array(AREA, SoneriticsTrailingSlashConfiguration::$actOnAreas)) {
        return;
    }

    $isAjax = 'xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
    if ($isAjax && SoneriticsTrailingSlashConfiguration::$actOnAjax === false) {
        return;
    }

    if (!empty($_POST) && SoneriticsTrailingSlashConfiguration::$actOnPost === false) {
        return;
    }

// Check if the URL has a trailing slash and redirect if not
    $urlWithTrailingSlashProcessor = new UrlWithTrailingSlashProcessor;
    if ($urlWithTrailingSlashProcessor->hasTrailingSlash() === false) {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $urlWithTrailingSlashProcessor->getTrailingSlashURL()->getUrlWithSlash());
        die;
    }
}

// Start the addon
initiateAlwaysTrailingStart();
