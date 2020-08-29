<?php

include 'functions.php';
include 'header.php';
include 'init.php';
include $root . DIRECTORY_SEPARATOR . 'action.php';
include $root . DIRECTORY_SEPARATOR . 'forms.php';
include $root . DIRECTORY_SEPARATOR . 'extract.php';


div('container');
  div('breadcrumb mt-3');
    $dir_elements = explode(DIRECTORY_SEPARATOR , $cwd);
    $actual_dir = '';
    $arrow = false;
    $is_in_home = false;
    foreach ($dir_elements as $dir) {
      $actual_dir .= $dir . DIRECTORY_SEPARATOR;
      if ($dir === $home) $is_in_home = true;
      if($is_in_home){
        if ($arrow) echo "<a>></a>";
        $arrow = true;
        generate_submit_button('_cwd', substr($actual_dir, 0, -1), $dir);
      }
    }
  end_div();
  if ($open_file !== '') {
    include $root . DIRECTORY_SEPARATOR . 'file.php';
  }
  else {
    div('breadcrumb');
      echo "New content: <input form='_new_content' type='text' name='_new_content'>";

      generate_submit_button('_display', $display, "Display as $display", 'd-flex mr-auto ml-auto');

      if ($show_hidden === 'show') generate_submit_button('_show_hidden', $show_hidden, 'Show hidden file', 'd-flex mr-2 ml-auto');
      else generate_submit_button('_show_hidden', $show_hidden, 'Hide hidden file', 'd-flex mr-2 ml-auto');

      if ($cwd !== $trash_folder) generate_submit_button('_cwd', $trash_folder, 'Open trash folder', 'd-flex mr-2');
      else generate_submit_button('_action', 'clean', 'Clean trash folder', 'd-flex mr-2 bg-red text-white');
    end_div();
    div('breadcrumb');
      div('w-50');
        generate_submit_button('_select_all', $select_all, "$select_all All", 'mr-2 ml-2');
        generate_submit_button('_action', 'paste', 'Paste', 'mr-2 ml-2');
        generate_submit_button('_action', 'copy', 'Copy', 'mr-2 ml-2');
        generate_submit_button('_action', 'cut', 'Cut', 'mr-2 ml-2');
        generate_submit_button('_action', 'delete', 'Delete', 'mr-2 ml-2');
      end_div();
      div('w-50 row');
        div('ml-auto');
          echo '<input form="upload" type="file" name="file">';
          echo '<input form="upload" type="submit" value="Upload Image" name="submit">';
        end_div();
      end_div();
    end_div();
    if ($display === 'icon') {
      include $root . DIRECTORY_SEPARATOR . 'list.php';
    }
    else if ($display === 'list') {
      include $root . DIRECTORY_SEPARATOR . 'icon.php';
    }
  }


end_div();















include 'footer.php';
