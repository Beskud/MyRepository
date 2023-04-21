<?php

$response = [];

if (!empty($_POST['username']) && !empty($_POST['text_comment'])) {

  $username = $_POST['username'];
  $text_comment = $_POST['text_comment'];

  $name = htmlspecialchars($username);
  if (preg_match('/^[a-zA-Z-0-9_.-]{4,40}$/', $name)) {
    $dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
    $sth = $dbh->query("INSERT INTO Comment(text_comment, name) VALUES ('$text_comment', '$name')");
    $response['status'] = 'success';
    echo json_encode($response);
  } else {
    $response['status'] = 'bad';
    echo json_encode($response);
  }
} else {
  $response['status'] = 'bad';
  echo json_encode($response);
}






// echo '<pre>';
// echo '<div>';
// foreach ($row as $key => $value) {
//   echo "<br/>";
//   echo '<div style="width: 700px;
//   border-color: darkgray;
//   background-color: lavender;
//   height: 70px;
//   font-size: large;
//   font-family: monospace;
//   border-radius: 10px; >';
//   echo $value['name'];
//   echo $value['text-comment'];
//   echo '</div>';
//   echo "<br/>";
// }
// echo '</div>';
