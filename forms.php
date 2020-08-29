<?php

echo "<form id='_cwd' method='POST'>";
  generate_input('_cwd', '_select_all');
echo "</form>";

echo "<form id='_select_all' method='POST'>";
  generate_input('_select_all');
echo "</form>";

echo "<form id='_open_file' method='POST'>";
  generate_input('_open_file', '_select_all');
echo "</form>";

echo "<form id='_show_hidden' method='POST'>";
  generate_input('_show_hidden');
echo "</form>";

echo "<form id='_display' method='POST'>";
  generate_input('_display');
echo "</form>";

echo "<form id='_new_content' method='POST'>";
  generate_input('_new_content', '$select_all');
echo "</form>";

echo "<form id='_sort_by' method='POST'>";
  echo "<input type='hidden' name='_sort_order' value='$sort_order'>";
  generate_input('_sort_by', '_sort_order');
echo "</form>";

echo "<form id='_action' method='POST'>";
  generate_input('_action', '_select_all');
echo "</form>";

echo "<form id='upload' method='post' enctype='multipart/form-data'>";
  generate_input('_select_all');
echo "</form>";

echo "<form id='return' method='post' enctype='multipart/form-data'>";
  generate_input();
echo "</form>";
