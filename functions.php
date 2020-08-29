<?php

function generate_input ($exception = '', $exception2 = '') { //Generate all $_POS var unchanged
  foreach ($_POST as $key => $value) { if ($exception !== $key && $exception2 !== $key) {
    if ($key !== '' && $value !== '' && $value !== " ") echo "<input type='hidden' name='$key' value='$value'>";
  }}
}


function generate_submit_button($context, $value, $name = '', $style = '') {
  if ($name === '') $name = $context;

  echo "<button class='$style' type='submit', form='$context', name='$context' value='$value'>";
    echo $name;
  echo "</button>";
}

function div($style = '') {
  echo "<div class='$style'>";
}
function end_div() {
  echo "</div>";
}

function get_last_element ($path, $level = 1) {
  if(substr($path, -1) === DIRECTORY_SEPARATOR) {
    $elements = explode(DIRECTORY_SEPARATOR, substr($path, -1));
  }
  else {
    $elements = explode(DIRECTORY_SEPARATOR, $path);
  }
  return $elements[count($elements) - $level];
}

function rename_folder ($folder, $new_folder) {
  $folder_content = scandir($folder);
  foreach ($folder_content as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($folder . DIRECTORY_SEPARATOR . $name)) {
      rename($folder . DIRECTORY_SEPARATOR . $name, $new_folder . DIRECTORY_SEPARATOR . $name);
    }
    else {
      if (is_dir($new_folder . DIRECTORY_SEPARATOR . $name)) unlink_folder($new_folder . DIRECTORY_SEPARATOR . $name);
      mkdir($new_folder . DIRECTORY_SEPARATOR . $name, 0777, true);
      rename_folder($folder . DIRECTORY_SEPARATOR . $name, $new_folder . DIRECTORY_SEPARATOR . $name);
      rmdir($folder . DIRECTORY_SEPARATOR . $name);
    }
  }}
}

function unlink_folder ($folder) {
  $folder_content = scandir($folder);
  foreach ($folder_content as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($folder . DIRECTORY_SEPARATOR . $name)) {
      unlink($folder . DIRECTORY_SEPARATOR . $name);
    }
    else {
      unlink_folder($folder . DIRECTORY_SEPARATOR . $name);
    }
  }}
  rmdir($folder);
}

function copy_folder ($folder, $new_folder) {
  $folder_content = scandir($folder);
  foreach ($folder_content as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($folder . DIRECTORY_SEPARATOR . $name)) {
      copy($folder . DIRECTORY_SEPARATOR . $name, $new_folder . DIRECTORY_SEPARATOR . $name);
    }
    else {
      if (is_dir($new_folder . DIRECTORY_SEPARATOR . $name)) unlink_folder($new_folder . DIRECTORY_SEPARATOR . $name);
      mkdir($new_folder . DIRECTORY_SEPARATOR . $name, 0777, true);
      copy_folder($folder . DIRECTORY_SEPARATOR . $name, $new_folder . DIRECTORY_SEPARATOR . $name);
    }
  }}
}
