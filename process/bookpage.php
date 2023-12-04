<?php

$directory = "";
$fileName = ""; 

if (isset($_POST['directory'])) {
    $directory = ($_POST['directory']);
}
if (isset($_POST['fileName'])) {
    $fileName= $_POST['fileName'];
}

//파일을 읽는다
// 검증
if (is_file($directory . "/" . $fileName)) {
    $content = file($directory . "/" .$fileName);
    echo json_encode($content);
}