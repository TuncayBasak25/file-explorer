<?php

chdir($_POST['_cwd']);
$cwd = getcwd();
if (substr($cwd, -1) === DIRECTORY_SEPARATOR) $cwd = substr($cwd, 0, -1);

if (isset($_FILES['file'])) {
   $target_file = basename($_FILES["file"]["name"]);
   echo $_FILES["file"]["tmp_name"];
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
 }

if ($new_content !== '') {
  if (substr($new_content, 0, 6) === 'mkdir ') {
    mkdir($cwd . DIRECTORY_SEPARATOR . substr($new_content, 6), 0777, true);
  }
  else if (substr($new_content, 0, 6) === 'touch ') {
    fopen($cwd . DIRECTORY_SEPARATOR . substr($new_content, 6), 'a+');
  }
  else if (substr($new_content, -3, 1) !== '.' && substr($new_content, -4, 1) !== '.' && substr($new_content, -5, 1) !== '.') {
    mkdir($cwd . DIRECTORY_SEPARATOR . $new_content, 0777, true);
  }
  else {
    fopen($cwd . DIRECTORY_SEPARATOR . $new_content, 'a+');
  }
}

if ($action === 'cut' || $action === 'copy') {
  $copy_contents = scandir($copy_folder);
  foreach ($copy_contents as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($copy_folder . DIRECTORY_SEPARATOR .$name)) unlink($copy_folder . DIRECTORY_SEPARATOR . $name);
    else unlink_folder($copy_folder . DIRECTORY_SEPARATOR . $name);
  }}
}

if ($action ==='clean') {
  $trash_content = scandir($trash_folder);
  foreach ($trash_content as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($trash_folder . DIRECTORY_SEPARATOR .$name)) unlink($trash_folder . DIRECTORY_SEPARATOR . $name);
    else unlink_folder($trash_folder . DIRECTORY_SEPARATOR . $name);
  }}
}

if ($action === 'copy') {
  foreach ($_POST as $name => $value) { if (substr($name, 0, 9) === '_selected') {
    if (!is_dir($value)) {
      copy($value, $copy_folder . DIRECTORY_SEPARATOR . get_last_element($value));
    }
    else {
      mkdir($copy_folder . DIRECTORY_SEPARATOR . get_last_element($value), 0777, true);
      copy_folder($value, $copy_folder . DIRECTORY_SEPARATOR . get_last_element($value));
    }
    $_POST[$name] = '';
  }}
}
else if ($action === 'cut') {
  foreach ($_POST as $name => $value) { if (substr($name, 0, 9) === '_selected') {
    if (!is_dir($value)) {
      rename($value, $copy_folder . DIRECTORY_SEPARATOR . get_last_element($value));
    }
    else {
      if (is_dir($copy_folder . DIRECTORY_SEPARATOR . get_last_element($value))) unlink_folder($copy_folder . DIRECTORY_SEPARATOR . get_last_element($value));
      mkdir($copy_folder . DIRECTORY_SEPARATOR . get_last_element($value), 0777, true);
      rename_folder($value, $copy_folder . DIRECTORY_SEPARATOR . get_last_element($value));
      rmdir($value);
    }
    $_POST[$name] = '';
  }}
}
else if ($action === 'delete') {
  foreach ($_POST as $name => $value) { if (substr($name, 0, 9) === '_selected') {
    if (!is_dir($value)) {
      rename($value, $trash_folder . DIRECTORY_SEPARATOR . get_last_element($value));
    }
    else {
      if (is_dir($trash_folder . DIRECTORY_SEPARATOR . get_last_element($value))) unlink_folder($trash_folder . DIRECTORY_SEPARATOR . get_last_element($value));
      mkdir($trash_folder . DIRECTORY_SEPARATOR . get_last_element($value), 0777, true);
      rename_folder($value, $trash_folder . DIRECTORY_SEPARATOR . get_last_element($value));
      rmdir($value);
    }
    $_POST[$name] = '';
  }}
}
else if ($action === 'paste') {
  $copy_contents = scandir($copy_folder);
  foreach ($copy_contents as $name) { if ($name !== '.' && $name !== '..') {
    if (!is_dir($copy_folder . DIRECTORY_SEPARATOR . $name)) {
      copy($copy_folder . DIRECTORY_SEPARATOR . $name, $cwd . DIRECTORY_SEPARATOR . $name);
    }
    else {
      if (is_dir($cwd . DIRECTORY_SEPARATOR . $name)) unlink_folder($cwd . DIRECTORY_SEPARATOR . $name);
      mkdir($cwd . DIRECTORY_SEPARATOR . $name, 0777, true);
      copy_folder($copy_folder . DIRECTORY_SEPARATOR . $name, $cwd . DIRECTORY_SEPARATOR . $name);
    }
  }}
}
