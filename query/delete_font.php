<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fontName'])) {
  $targetDirectory = 'uploads/'; 
  $fontName = $_POST['fontName'];
  $filePath = $targetDirectory . $fontName;

  if (file_exists($filePath)) {
    if (unlink($filePath)) {
      echo 'Font deleted successfully!';
    } else {
      echo 'Error deleting font.'; 
    }
  } else {
    echo 'Font not found.'; 
  }
} else {
  echo 'Error deleting font.'; 
}
?>