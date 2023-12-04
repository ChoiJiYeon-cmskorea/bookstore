<?php
require_once "./../../library/searchfile.php";
$DBadminbook = new DBbookclass();

if (isset($_GET['detailPk']) && !empty($_GET['detailPk'])) {
	$detailPk = $_GET['detailPk'];
} else {
	$detailPk = null;
}
//도서 데이터 조회
$dbbooklist = $DBadminbook->DbdetailBook("book", "pk", $detailPk, "*");
$rows = mysqli_fetch_assoc($dbbooklist);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../../jQuery/jquery-3.6.3.min.js"></script>
        <link href="../../bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="../../bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/main.css" type="text/css">
        <title>도서 정보 확인 페이지</title>
    </head>
    <body>
        <div class="container border border-secondary listcontainer">
            <div class="header row bg-secondary">
                <h3 class="align-self-center fw-bold"><a class="text-white text-decoration-none" href="bookstoreadmin.php">CMSKOREA bookstore</a></h3>
            </div>
            <div class="m-4">
                <div class=" text-start mb-5">
                    <span class="fs-5 pagetitle">서점 관리자 페이지</span>
                    <span class="text-primary text-opacity-75 pagedescription">- 도서 세부 정보 -</span>
                </div>
                 <div>
                    <div class="row">
                        <div class="col-8 fs-4" id="bookDetailTitle">책 제목 : <?php echo $rows["title"]?></div>
                        <span  class="col-2  align-self-center" id="bookDetailWriter">글쓴이 : <?php echo $rows["writer"]?></span>
                    </div>
                    <hr>
                    <div class="fs-6" >-줄거리 - 
                        <p class="fs-6" id="boardViewContent"><?php echo $rows["content"]?></p>
                    </div>
                    <div class="fs-5" id="bookDetailPath">책 폴더 위치 : <?php echo $rows["path"]?></div>
                    <hr>
                </div>
                <div class="mx-5 mt-4 row">
                    <button class="btn btn-primary bg-warning border-warning col rounded-0 mx-1" id="postEdit">수 정</button>
                    <button class="col mx-1" style="border: solid 1px lightgray;" id="backList">리스트</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                //수정하기
                $(document).on('click', '#postEdit',function(){
                   location.href = "bookedit.php?detailPk="+<?php echo $detailPk?>;
                });
                //리스트 이동
                $(document).on('click', '#backList',function(){
                   location.href = 'bookstoreadmin.php'; 
                });
            });
        </script>
    </body>
</html>