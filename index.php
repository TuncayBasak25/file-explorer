<?php

include 'header.php';
include 'functions.php';
include 'htmlfunctions.php';

$showHidden = false;
$hideShow = 'HIDE';
$A = 'A';
$hiddenStyle = 'bg-red';

if (isset($_POST['pressed'])) {
  $pressed = $_POST['pressed'];
  if ($_POST['pressed'][0] === 'A'){
    $showHidden = true;
    $hideShow = 'SHOW';
    $A = '';
    $pressed = substr($_POST['pressed'], 1);
  }
}
else {
  $pressed = getcwd();
}
chdir($pressed);

if ($showHidden) {
  $hiddenStyle = 'bg-blue';
}

div('container-fluid top-menu border text-center row');

//Menu d'arboressance
if (getcwd() !== 'C:' . DIRECTORY_SEPARATOR) {
  $cwd = explode(DIRECTORY_SEPARATOR, getcwd());
}
else {
  $cwd = array(getcwd());
}
div('');
div('row ml-2');
$cwdroad = '';
foreach ($cwd as $item) {
  $cwdroad = $cwdroad . $item . DIRECTORY_SEPARATOR;
  div('d-flex menu-item');
  echo "<form method='POST'>";
  echo "<input type='hidden' name='pressed' value='" . $cwdroad . "'>";
  echo "<a href='index.php'><button class='menu-btn' type='submit'>" . $item . "</button></a>";
  echo "</form>";
  endDiv();
}
endDiv();
endDiv();

//Option d'affichage;
div('hidden-file-div d-flex ml-auto ' . $hiddenStyle);
echo "<form method='POST'>";
echo "<input type='hidden' name='pressed' value='" . $A . $cwdroad . "'>";
echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $hideShow . "</button></a>";
echo "</form>";
endDiv();

endDiv();



div('container-fluid super-content border');
div('container-fluid content row text-center');
$content = scandir(getcwd());
$folders = array();
foreach ($content as $item) {
  if (!(!$showHidden && $item[0] === '.') && $item !== '.' && $item !== '..' && is_dir($pressed . DIRECTORY_SEPARATOR . $item)) {
    array_push($folders, $item);
  }
}
foreach ($folders as $item) {
  div('item-folder d-flex');
  echo "<form method='POST'>";
  echo "<input type='hidden' name='pressed' value='" . getcwd() . DIRECTORY_SEPARATOR . $item . "'>";
  echo "<a href='index.php'><button class='item-btn' type='submit'><span class='item-text'>" . $item . "</span></button></a>";
  echo "</form>";
  endDiv();
}

$files = array();
foreach ($content as $item) {
  if (!(!$showHidden && $item[0] === '.') && !is_dir($pressed . DIRECTORY_SEPARATOR . $item)) {
    array_push($files, $item);
  }
}
foreach ($files as $item) {
  div('item-file d-flex');
  echo "<a href='" . $item . "'><button class='item-btn'><span class='item-text'>" . $item . "</span></button></a>";
  endDiv();
}

endDiv();
endDiv();

include 'footer.php';
