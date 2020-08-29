<?php

div('row mr-0 ml-0');
  foreach ($sorted_contents as $name => $value) { if (!($name[0] === '.' && $show_hidden === "show")) {
    div('d-flex w-10');
    div('d-flex w-80 mr-auto mt-auto mb-auto icon-container');
      $size = $contents_size[$name];
      if ($size === 0) {
        $size = '0 Ko';
      }
      else if ($size !== '') {
        $size = ceil($size / 1000);
        $size = "$size Ko";
      }
      $type = $contents_type[$name];
      $date = date('d-m-Y G:i', $contents_date[$name]);

      $fileIcon = 'img' . DIRECTORY_SEPARATOR . $type . '.png';
      if ($contents_type[$name] === 'folder') {
        echo "<button class='bg-alpha w-100 h-100' type='submit', form='_cwd', name='_cwd' value='" . $cwd . DIRECTORY_SEPARATOR . $name . "'>";
          echo "<img class='icon-icon' src='$fileIcon'>";
          echo "<div class='h-25'><a class='under-icon-text'>$name</a></div>";
        echo "</button>";
      }
      else {
        echo "<button class='bg-alpha w-100 h-100' type='submit', form='_open_file', name='_open_file' value='" . $cwd . DIRECTORY_SEPARATOR . $name . "'>";
          echo "<img class='d-flex icon-icon' src='$fileIcon'>";
          echo "<div class='h-25'><a class='under-icon-text'>$name</a></div>";
        echo "</button>";
      }
      $selected_name = '_selected' . $name;
      $selected_path = $cwd . DIRECTORY_SEPARATOR . $name;
      if ($select_all === 'Unselect') echo "<input class='mt-4' type='checkbox' form='_action' name='$selected_name' value='$selected_path' checked>";
      else echo "<input class='mt-4' type='checkbox' form='_action' name='$selected_name' value='$selected_path'>";
    end_div();
    end_div();
  }}
end_div();
