<?php
$directory="./../file/hong";
// 저장된 디렉토리를 연다. "@"에러 생격도 출력 안하는데 @는 해결책이 아님
$handle = @opendir($directory);
// 디렉토리가 존재하면(is_dir)
if (is_dir($directory)) {
while(false !== ($file = readdir($handle))) {
/*주의 !
readdir은 모든 디렉토리 안에 기본적으로 존재하는 "."과 ".."또한 반환하는데 
이를 조건을 추가하여 제거 해주면 된다.*/
	if ($file != "." && $file != "..") {
		
		echo "file : $file";
		}
	}
}
// 열었으면 닫는다.
@closedir($handle);



require_once "./../library/searchfile.php";
$DBbook = new DBbookclass();

$dblist = $DBbook->DbsearchBook("book", "title", "홍", "*");
$rows = mysqli_fetch_assoc($dblist);
echo "<pre>";
var_dump($rows);
echo "</pre>";
echo $rows['title'];

// 현재 파일의 절대경로
$absolute_path = realpath(__FILE__);
echo $absolute_path;
echo "<br>";
// 현재 파일의 디렉토리 경로
$dir_path = dirname(__FILE__);
echo $dir_path;
echo "<br>";
// 상대경로를 절대경로로 변환
$relative_path = "./images/picture.jpg";
$absolute_path = realpath($relative_path);
echo $absolute_path;
echo "<br>";
echo $_SERVER['PHP_SELF'];
echo $_SERVER['DOCUMENT_ROOT'];
/* $file_server_path = realpath(__FILE__);
// PHP 파일 이름이 들어간 절대 서버 경로

$php_filename = basename(__FILE__);
// PHP 파일 이름

$server_path = str_replace(basename(__FILE__), "", $file_server_path);
// PHP 파일 이름을 뺀 절대 서버 경로

$server_root_path = $_SERVER['DOCUMENT_ROOT'];
// 서버의 웹 뿌리(루트) 경로(절대 경로)

$relative_path = eregi_replace("\/[^/]*\.php$", "/", $_SERVER['PHP_SELF']);
$relative_path = preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']);
// 웹 문서의 뿌리 경로를 뺀 상대 경로

$relative_file_server_path = $relative_path.$php_filename;
// PHP 파일 이름이 들어간 상대 경로

$base_URL = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$base_URL .= ($_SERVER['SERVER_PORT'] != '80') ? $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'] : $_SERVER['HTTP_HOST'];
// 바탕 URL

$web_path = $base_URL.$relative_path;
// PHP 파일이 있는 곳의 웹 경로

$full_URL = $web_path.$php_filename;
$full_URI = $base_URL.$_SERVER['REQUEST_URI'];

echo "문서가 있는 곳의 절대 경로 : ".$server_path;
echo "\n";
echo "문서가 있는 곳의 전체 웹 경로 : ".$web_path;
echo "\n";
echo "문서가 있는 곳의 상대 경로 :  ".$relative_path;
echo "\n";
echo "문서의 절대 경로 :  ".$file_server_path;
echo "\n";
echo "문서의 상대 경로 :  ".$relative_file_server_path;
echo "\n";
echo "문서의 전체 URL :  ".$full_URL;
echo "\n";
echo "문서의 전체 URI :  ".$full_URI; */