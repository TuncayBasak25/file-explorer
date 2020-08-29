<?php
div('breadcrumb');
  generate_submit_button('return', '', 'Return', 'd-flex ml-2 mr-auto');
end_div();


div('w-100');
$file_name = get_last_element($open_file);
$file_type = $contents_type[$file_name];
$file_path = '';
$is_home_dir = false;
$path_elements = explode(DIRECTORY_SEPARATOR, $open_file);
foreach ($path_elements as $name) {
  if ($is_home_dir) $file_path .= DIRECTORY_SEPARATOR . $name;
  if ($name === $home) {
    $is_home_dir = true;
    $file_path .= $name;
  }
}
  if ($file_type === 'png' || $file_type === 'jpg' || $file_type === 'jpeg') {
    echo "<img class='w-100 mb-5' src='$file_path'>";
  }
  else if ($file_type === 'php' || $file_type === 'css' || $file_type === 'md' || $file_type === 'html' || $file_type === 'js') {
    $handle = fopen($open_file, 'r');
    if (fileSize($open_file) > 0) $text = fread($handle, fileSize($open_file));
    else $text = '';
    $tabulation = 0;
    for ($i=0; $i<strlen($text); $i++) {
      if ($text[$i] === '<') {
        echo '&lt';
      }
      else if ($text[$i] === '>') {
        echo '&gt';
      }
      else {
        echo $text[$i];
      }
      if ($text[$i] === ';') {
        echo '<br>';
        for ($t=0; $t<$tabulation; $t++) {
          echo '&nbsp&nbsp&nbsp&nbsp';
        }
      }
      else if ($text[$i] === '{') {
        echo '<br>';
        $tabulation += 1;
        for ($t=0; $t<$tabulation; $t++) {
          echo '&nbsp&nbsp&nbsp&nbsp';
        }
      }
      else if ($text[$i] === '}') {
        echo '<br>';
        $tabulation -= 1;
        for ($t=0; $t<$tabulation; $t++) {
          echo '&nbsp&nbsp&nbsp&nbsp';
        }
      }
    }
  }
  else if ($file_type === 'mp3') {
    echo "<audio controls>";
      echo "<source src='$file_path' type='audio/mpeg'>";
    echo "</audio>";
  }
  else if ($file_type === 'mkv') {
    echo "<video class='video-display' controls>";
      echo "<source src='$file_path' type='video/mp4'>";
    echo "</video>";
  }
  else if ($file_type === 'mp4') {
    echo "<video class='video-display' controls='controls'>";
      echo "<source src='$file_path' type='video/mp4'>";
    echo "</video>";
  }

end_div();
