<?php

$all_contents = scandir($cwd);
$contents = [];
$contents_size = [];
$contents_type = [];
$contents_date = [];


foreach ($all_contents as $item) { if ($item !== '.' && $item !== '..' && substr($item, -3) !== '.sys' && $item !== '.trash' && $item !== '.copyed') {
  if (is_dir($cwd . DIRECTORY_SEPARATOR . $item)) {
    $contents[$item] = $item;
    $contents_size[$item] = '';
    $contents_type[$item] = 'folder';
    $contents_date[$item] = filemtime($cwd . DIRECTORY_SEPARATOR . $item);
  }
  else {
    $contents[$item] = $item;
    $contents_size[$item] = filesize($cwd . DIRECTORY_SEPARATOR . $item);
    if ($item[0] === '.' && strpos(substr($item, 1), '.')) {
      $type = explode('.', substr($item, 1));
      $contents_type[$item] = $type[1];
    }
    else if (strpos($item, '.')) {
      $type = explode('.', $item);
      $contents_type[$item] = $type[1];
    }
    else {
      $contents_type[$item] = 'undefined';
    }
    $contents_date[$item] = filemtime($cwd . DIRECTORY_SEPARATOR . $item);
  }
}}

if ($sort_by === 'date') {
  $sorted_contents = &$contents_date;
  asort($sorted_contents);
}
else if ($sort_by === 'size') {
  $sorted_contents = &$contents_size;
  asort($sorted_contents);
}
else if ($sort_by === 'type') {
  $sorted_contents = &$contents_type;
  natcasesort($sorted_contents);
}
else {
  $sorted_contents = &$contents;
  natcasesort($sorted_contents);
}

if ($sort_order === 'down') {
  $keys = [];
  $values = [];
  $reversed = [];
  foreach ($sorted_contents as $key => $value) {
    array_push($keys, $key);
    array_push($values, $value);
  }
  for ($i=count($keys)-1; $i >= 0 ; $i--) {
    $reversed[$keys[$i]] = $values[$i];
  }
  $sorted_contents = &$reversed;
}
