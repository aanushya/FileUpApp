<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new Google_Service_Drive($client);
  $files = $drive->files->listFiles(array())->getFiles();
  //echo json_encode($files);
  
  
  //echo '<tt><pre>' . var_export($files, TRUE) . '</pre></tt>';
  //$files = $drive_service->files->listFiles(array())->getFiles();
  
 
 
  // iterate the files name|mimeType 
 ?> 
 <h3> List of files</h3>
 <table style="width:100%">
  <tr style="font-weight:bold">
  <td>File Name</td>
  <td>MimeType</td>
  </tr>
   <?php
  foreach ($files as $value) {
	  ?>
	  <tr>
  <td><?= $value['name']?></td>
  <td><?= $value['mimeType']?></td>
  </tr>
	  <?php
  }
   ?>  </table> <?php
  // iterate the files name|mimeType 

  
  
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
