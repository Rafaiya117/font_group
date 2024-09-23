<?php
include('../api/_a.php');
// header('Cache-Control: no-cache, no-store, must-revalidate');
// header('Pragma: no-cache');
// header('Expires: 0');
// upload_font.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['font_file'])) {
  $targetDirectory = 'uploads/';
  $fontName = basename($_FILES['font_file']['name']);
  $targetPath = $targetDirectory . $fontName;

  if (pathinfo($fontName, PATHINFO_EXTENSION) == 'ttf') {
      if (move_uploaded_file($_FILES['font_file']['tmp_name'], $targetPath)) {
          $fontNameWithoutExtension = pathinfo($fontName, PATHINFO_FILENAME); 

           $query= $db->action('INSERT INTO font_file (font_name, font_file) VALUES (?,?)',$fontName,$fontNameWithoutExtension);
          echo $fontNameWithoutExtension; 
      } else {
          echo 'Error uploading font.'; 
      }
  } else {
      echo 'Invalid file type. Only TTF files are allowed.'; 
  }
} else {
  echo 'Error uploading font.';
}
?>