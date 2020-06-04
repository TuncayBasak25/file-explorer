<?php

include 'header.php';
include 'functions.php';

$handle = fopen('.cache.txt', 'a+');
if (!filesize('.cache.txt')) {
    fwrite($handle, getcwd());
}
fclose($handle);

if (isset($_POST['choosen'])){
  if (is_dir(file_get_contents('.cache.txt') . DIRECTORY_SEPARATOR . $_POST['choosen'])) {
    $cache = file_get_contents('.cache.txt');
    $handle = fopen('.cache.txt', 'w+');
    fwrite($handle, $cache . DIRECTORY_SEPARATOR . $_POST['choosen']);
    chdir(file_get_contents('.cache.txt'));
  }
  $_POST['choosen'] = '';
}

$files = scandir(getcwd());

echo "<div class='container text-center'>";

foreach ($files as $file) {
  if ($file !== '..' && $file !== '.') {
    if (is_dir(file_get_contents('.cache.txt') . DIRECTORY_SEPARATOR . $file)) {
      echo "<form method='POST'>";
      echo "<input type='hidden' name='choosen' value='" . $file . "'>";
      echo "<a href='index.php'><button type='submit'>" . $file . "</button></a>";
      echo "</form>";
    }
    else {
      echo "<a href='" . $file . "'><button>" . $file . "</button></a>";
    }
  }
}
echo "</div>";

include 'footer.php';
