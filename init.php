<?php
$root = getcwd();
$root_dir = get_last_element(getcwd());
$home = 'Home';
if (!is_dir(getcwd() . DIRECTORY_SEPARATOR . $home)) mkdir(getcwd() . DIRECTORY_SEPARATOR . $home);

if (!is_dir(getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.trash')) mkdir(getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.trash', 0777, true);
$trash_folder = getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.trash';

if (!is_dir(getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.copyed')) mkdir(getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.copyed', 0777, true);
$copy_folder = getcwd() . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR . '.copyed';

if(!isset($_POST['_cwd'])){
  $_POST['_cwd'] = getcwd() . DIRECTORY_SEPARATOR . $home;
}

if (!isset($_POST['_show_hidden'])) $_POST['_show_hidden'] = 'show';
$show_hidden = 'show';
if ($_POST['_show_hidden'] === 'show') $show_hidden = 'hide';

if (!isset($_POST['_display'])) $_POST['_display'] = 'icon';
$display = 'list';
if ($_POST['_display'] === 'list') $display = 'icon';

if (!isset($_POST['_select_all'])) $_POST['_select_all'] = 'Unselect';
$select_all = 'Select';
if ($_POST['_select_all'] === 'Select') $select_all = 'Unselect';

if (!isset($_POST['_sort_by'])) $sort_by = 'name';
else $sort_by = $_POST['_sort_by'];

if (!isset($_POST['_sort_order'])) $_POST['_sort_order'] = 'down';
$sort_order = 'up';
if ($_POST['_sort_order'] === 'up') $sort_order = 'down';

if (!isset($_POST['_new_content'])) $new_content = '';
else $new_content = $_POST['_new_content'];
$_POST['_new_content'] = '';

$action = '';
if (isset($_POST['_action'])) $action = $_POST['_action'];
$_POST['_action'] = '';

$open_file = '';
if (isset($_POST['_open_file'])) $open_file = $_POST['_open_file'];
$_POST['_open_file'] = '';
