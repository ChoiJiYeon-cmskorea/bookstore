<?php
require_once "./../../library/searchfile.php";
$DBadminbook = new DBbookclass();
//전체 도서 데이터 조회
if (isset($_POST["inputTitle"]) && !empty($_POST['inputTitle'])) {
    $strip = mysqli_real_escape_string($DBadminbook->getDBconnect(), strip_tags($_POST["inputContent"] , '<br>'));
    $repath = preg_replace("/\\\\/", "/", $_POST["inputPath"]);
    $DBadminbook->getDbInsert("book", "(title, writer, content, path)", "( '". $_POST["inputTitle"]."' ,'". $_POST["inputWriter"] ."' ,'". $strip  ."', '/bookstore/"  . $repath . "')");
    header("location:./bookstoreadmin.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../../jQuery/jquery-3.6.3.min.js"></script>
        <link href="../../bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="../../bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/main.css" type="text/css">
        <title>도서 추가 페이지</title>
    </head>
    <body>
        <div class="container border border-secondary listcontainer">
            <div class="header row bg-secondary">
                <h3 class="align-self-center fw-bold"><a class="text-white text-decoration-none" href="bookstoreadmin.php">CMSKOREA bookstore</a></h3>
            </div>
            <div class="m-4">
                <div class=" text-start mb-5">
                    <span class="fs-5 pagetitle">서점 관리자 페이지</span>
                    <span class="text-primary text-opacity-75 pagedescription">- 도서 추가 -</span>
                </div>
                <div>
                    <form method="POST" action="bookaddpage.php">
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">제목</span>
                            <input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="책 제목을 입력하세요">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">작가</span>
                            <input type="text" class="form-control" id="inputWriter" name="inputWriter" placeholder="글쓴이를 입력하세요"">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">줄거리</span>
                            <textarea class="form-control" id="inputContent" name="inputContent" placeholder="줄거리 또는 책 설명을 입력하세요(생략 가능)"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-25">해당 폴더 이름</span>
                            <input type="text" class="form-control" id="inputPath" name="inputPath" placeholder="file/">
                        </div>
                        <div class="mx-5 row">
                            <button type="submit" class="btn btn-primary col rounded-0 mx-1" id="bookAdd">등 록</button>
                            <button type="button" class="col mx-1" style="border: solid 1px lightgray;" id="addCancel">취소</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function () {
            //폴더 위치 자동 입력
            $("#inputPath").focus(function(){
                if (!$(this).val()) {
                    $(this).val("file/");
                }
            });
            $(document).on('click', '#addCancel',function(){
                location.href = 'bookstoreadmin.php'; 
            });
        });
        </script>
    </body>
</html>