<?php

div('breadcrumb mt-3');
  div('d-flex w-40');
    generate_submit_button('_sort_by', 'name', 'Name', 'ml-4');
  end_div();
  div('d-flex w-20');
    generate_submit_button('_sort_by', 'date', 'Date');
  end_div();
  div('d-flex w-20');
    generate_submit_button('_sort_by', 'size', 'Size');
  end_div();
  div('d-flex w-20');
    generate_submit_button('_sort_by', 'type', 'Type');
  end_div();
end_div();

div('');
  foreach ($sorted_contents as $name => $value) { if (!($name[0] === '.' && $show_hidden === "show")) {
    div('list-row mr-2 ml-2 mt-2');
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
      div('d-flex w-5');
        $selected_name = '_selected' . $name;
        $selected_path = $cwd . DIRECTORY_SEPARATOR . $name;
        if ($select_all === 'Unselect') echo "<input class='checkbox w-40' type='checkbox' form='_action' name='$selected_name' value='$selected_path' checked>";
        else echo "<input class='checkbox w-40' type='checkbox' form='_action' name='$selected_name' value='$selected_path'>";
      end_div();
      div('d-flex w-35');
        $fileIcon = 'img' . DIRECTORY_SEPARATOR . $type . '.png';
        if ($contents_type[$name] === 'folder') {
          echo "<button class='style row bg-alpha' type='submit', form='_cwd', name='_cwd' value='" . $cwd . DIRECTORY_SEPARATOR . $name . "'>";
            echo "<img class='d-flex list-icon' src='$fileIcon'>";
            echo "<a class='pl-2'>$name</a>";
          echo "</button>";
        }
        else {
          echo "<button class='style row bg-alpha' type='submit', form='_open_file', name='_open_file' value='" . $cwd . DIRECTORY_SEPARATOR . $name . "'>";
            echo "<img class='d-flex list-icon' src='$fileIcon'>";
            echo "<a class='pl-2'>$name</a>";
          echo "</button>";
        }
      end_div();

      echo "<div class='d-flex w-20'><a class='fileDate'>$date</a></div>";
      echo "<div class='d-flex w-20'><a class='fileSize'>$size</a></div>";
      echo "<div class='d-flex w-20'><a class='fileType'>$type</a></div>";
    end_div();
  }}
end_div();
