<?php
namespace StoreEngine;
require_once __DIR__.'/../tests/settingsInit.php';
/**
 * This script simply fetches a file and streams it's content to the user
 * The File ID is passed via a $_REQUEST var fileID
*/

if (!isset($_REQUEST['fileID']) || !is_numeric($_REQUEST['fileID'])) {
    throw new \Exception("fileID not set or invalid");
}

// Generate FileModel
$fileModelFactory = new FileModelFactory();
$fileModel = $fileModelFactory->get();

// Setup FileModel
$fileModel->setFileID($_REQUEST['fileID']);

// Fetch File instance and request DownloadSession
$file = $fileModel->get()[0] or die("Error: file not found");
$downloadSessionFactory = new DownloadSessionFactory(StoreEngine::get(), $file);
$downloadSession = $downloadSessionFactory->get();

// Begin file download
$downloadSession->run();