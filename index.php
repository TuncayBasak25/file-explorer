<?php

include 'header.php';
include 'functions.php';
include 'htmlfunctions.php';


$showHidden = false;
$hideShow = 'HIDE';
$ASelf = 'A';
$AOther = '';
$hiddenStyle = 'bg-red';

$copy = false;
$copyShow = 'COPY';
$RSelf = 'R';
$ROther = '';
$copyStyle = 'bg-red';

$cut = false;
$cutShow = 'CUT';
$KSelf = 'K';
$KOther = '';
$cutStyle = 'bg-red';

$paste = false;
$pasteShow = 'UNAVAILBLE';
$pasteSource = '';
$PSelf = 'P';
$POther = '';
$pasteStyle = 'bg-red';

$delete = false;
$deleteShow = '\DELETE';
$DSelf = 'D';
$DOther = '';
$deleteStyle = 'bg-red';

if (isset($_POST['pressed'])) {
  $pressed = $_POST['pressed'];

  $action = explode(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, $pressed);

  $pressed = $action[0];

  if ($pressed[0] !== 'C') {
    if ($pressed[0] === 'A'){
      $showHidden = true;
      $hideShow = 'SHOW';
      $hiddenStyle = 'bg-blue';
      $ASelf = '';
      $AOther = 'A';
      $pressed = substr($pressed, 1);
    }

    if ($pressed[0] === 'R'){
      $copy = true;
      $copyShow = 'CHOOSE FILE';
      $copyStyle = 'bg-blue';
      $RSelf = '';
      $ROther = 'R';
      $copyStyle = 'bg-blue';
      $pressed = substr($pressed, 1);
    }
    else if ($pressed[0] === 'K'){
      $cut = true;
      $cutShow = 'CHOOSE FILE';
      $cutStyle = 'bg-blue';
      $KSelf = '';
      $KOther = 'K';
      $cutStyle = 'bg-blue';
      $pressed = substr($pressed, 1);
    }
    else if ($pressed[0] === 'P'){
      $paste = true;
      $pasteShow = 'PASTE';
      $pasteStyle = 'bg-blue';
      $PSelf = '';
      $POther = 'P';
      $pressed = substr($pressed, 1);
    }
    else if ($pressed[0] === 'D'){
      $delete = true;
      $deleteShow = 'CHOOSE FILE';
      $deleteStyle = 'bg-blue';
      $DSelf = '';
      $DOther = 'D';
      $pressed = substr($pressed, 1);
    }
  }
}
else {
  $pressed = getcwd();
}
chdir($pressed);

if (isset($_POST['new'])) {
  if(strpos($_POST['new'], '.') === false) {
    mkdir(getcwd() . DIRECTORY_SEPARATOR . $_POST['new'], 0777);
  }
  else {
    fopen(getcwd() . DIRECTORY_SEPARATOR . $_POST['new'], 'a+');
  }
}

if(isset($action[1])) {
  if ($action[1][0] === 'R') {
    $pasteSource = substr($action[1], 1);
  }
  else if ($action[1][0] === 'K') {
    $items = explode(DIRECTORY_SEPARATOR, $action[1]);
    $item = end($items);
    rename(substr($action[1], 1), 'C:\wamp64\www\tbasak\file-explorer\.trash' . DIRECTORY_SEPARATOR . $item);
    $pasteSource = 'K' . 'C:\wamp64\www\tbasak\file-explorer\.trash' . DIRECTORY_SEPARATOR . $item;
  }
  else if ($action[1][0] === 'D') {
    $items = explode(DIRECTORY_SEPARATOR, $action[1]);
    $item = end($items);
    rename(substr($action[1], 1), 'C:\wamp64\www\tbasak\file-explorer\.trash' . DIRECTORY_SEPARATOR . $item);
  }
  else if ($action[1][0] === 'P') {
    if ($action[1][1] === 'K') {
      $items = explode(DIRECTORY_SEPARATOR, $action[1]);
      $item = end($items);
      copy(substr($action[1], 2), getcwd() . DIRECTORY_SEPARATOR . $item);
      unlink(substr($action[1], 2));
    }
    else {
      $items = explode(DIRECTORY_SEPARATOR, $action[1]);
      $item = end($items);
      copy(substr($action[1], 1), getcwd() . DIRECTORY_SEPARATOR . $item);
    }
  }
  else if($action[1][0] === 'M') {
    $pasteSource = substr($action[1], 1);
  }
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
  echo "<input type='hidden' name='pressed' value='" . $AOther . $POther . $cwdroad . DIRECTORY_SEPARATOR . 'M' . $pasteSource . "'>";
  echo "<a href='index.php'><button class='menu-btn' type='submit'>" . $item . "</button></a>";
  echo "</form>";
  endDiv();
}
endDiv();
endDiv();

//Option d'affichage;
div('hidden-file-div d-flex ml-auto ' . $hiddenStyle);
echo "<form method='POST'>";
echo "<input type='hidden' name='pressed' value='" . $ASelf . $POther . getcwd() . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'M' . $pasteSource . "'>";
echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $hideShow . "</button></a>";
echo "</form>";
endDiv();
div('hidden-file-div d-flex ml-auto ' . $deleteStyle);
echo "<form method='POST'>";
echo "<input type='hidden' name='pressed' value='" . $AOther . $DSelf . getcwd() . "'>";
echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $deleteShow . "</button></a>";
echo "</form>";
endDiv();
div('hidden-file-div d-flex ml-auto ' . $copyStyle);
echo "<form method='POST'>";
echo "<input type='hidden' name='pressed' value='" . $AOther . $RSelf . getcwd() . "'>";
echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $copyShow . "</button></a>";
echo "</form>";
endDiv();
div('hidden-file-div d-flex ml-auto ' . $cutStyle);
echo "<form method='POST'>";
echo "<input type='hidden' name='pressed' value='" . $AOther . $KSelf . getcwd() . "'>";
echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $cutShow . "</button></a>";
echo "</form>";
endDiv();
if ($paste) {
  div('hidden-file-div d-flex ml-auto ' . $pasteStyle);
  echo "<form method='POST'>";
  echo "<input type='hidden' name='pressed' value='" . $AOther . getcwd() . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'P' . $pasteSource . "'>";
  echo "<a href='index.php'><button class='hidden-file-btn' type='submit'>" . $pasteShow . "</button></a>";
  echo "</form>";
  endDiv();
}

div('');


echo "<form action='index.php' method='post'>";
echo "Create a folder: <input type='text' name='new'><br>";
echo "<input type='hidden' name='pressed' value='" . $AOther . $POther . getcwd() . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'M' . $pasteSource . "'>";
echo "<input type='submit'></form>";


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
  echo "<input type='hidden' name='pressed' value='" . $AOther . $POther . getcwd() . DIRECTORY_SEPARATOR . $item . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'M' . $pasteSource . "'>";
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
  if($copy || $cut) {
    echo "<form method='POST'>";
    echo "<input type='hidden' name='pressed' value='" . $AOther . 'P' . getcwd() . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $ROther . $KOther . getcwd() . DIRECTORY_SEPARATOR . $item . "'>";
    echo "<a href='index.php'><button class='item-btn' type='submit'><span class='item-text'>" . $item . "</span></button></a>";
    echo "</form>";
  }
  else if($delete) {
    echo "<form method='POST'>";
    echo "<input type='hidden' name='pressed' value='" . $AOther . $POther . getcwd() . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'D' . getcwd() . DIRECTORY_SEPARATOR . $item . "'>";
    echo "<a href='index.php'><button class='item-btn' type='submit'><span class='item-text'>" . $item . "</span></button></a>";
    echo "</form>";
  }
  else {
    echo "<a href='" . $item . "'><button class='item-btn'><span class='item-text'>" . $item . "</span></button></a>";
  }
  endDiv();
}

endDiv();
endDiv();

include 'footer.php';
