<?php

$increase = '';
if (isset($_POST['increase'])) {
  $increase = $_POST['increase'];
}


if (!isset($_POST['i'])) {
  $_POST['i'] = 0;
}
$i = intval($_POST['i']);

if (!isset($_POST['j'])) {
  $_POST['j'] = 0;
}
$j = intval($_POST['j']);
if (!isset($_POST['k'])) {
  $_POST['k'] = 0;
}
$k = intval($_POST['k']);


if($increase === 'j')
  $j++;
else if ($increase === 'k')
  $k++;


//echo 'i = ' . $i . '<br>';
echo 'j = ' . $j . '<br>';
echo 'k = ' . $k . '<br>';

$i++;

echo "<form id='form' method='POST'>";

echo "</form>";

echo "<div id='buttons'>";

  echo "<button type='submit' form='form' name='increase' value='j'>";

    echo "increase j";

  echo "</button>";

  echo "<button type='submit' form='form' name='increase' value='k'>";

    echo "increase k";

  echo "</button>";

echo "</div>";

echo "<input type='hidden' form='form' name='i' value='$i'>";
echo "<input type='hidden' form='form' name='k' value='$k'>";
echo "<input type='hidden' form='form' name='j' value='$j'>";
