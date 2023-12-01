<?php
require_once "./../../library/searchfile.php";
$DBadminbook = new DBbookclass();

if(isset($_GET['detailPk']) && !empty($_GET['detailPk'])){
	$detailPk = $_GET['detailPk'];
}else{
	$detailPk = null;
}
if(isset($_POST["inputTitle"]) && isset($_POST['detailPk'])){
	$detailPk = $_POST['detailPk'];
	$strip = mysqli_real_escape_string($DBadminbook->getDBconnect(), strip_tags($_POST["inputContent"] , '<br>'));
	$repath = preg_replace("/\\\\/", "/", $_POST["inputPath"]);
	$DBadminbook->getDbUpdate("book", "title='" . $_POST["inputTitle"] . "', writer='" . $_POST["inputWriter"] . "', content='" . $strip . "', path='". $repath  ."'" ,"pk", $detailPk);
	header("location:./bookstoreadmin.php");
}
//도서 데이터 조회
$dbbooklist = $DBadminbook-> DbdetailBook("book", "pk", $detailPk, "*");
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
        <title>도서 정보 수정 페이지</title>
    </head>
    <body>
        <div class="container border border-secondary listcontainer">
	        <div class="header row bg-secondary">
				<h3 class="align-self-center fw-bold"><a class="text-white text-decoration-none" href="bookstoreadmin.php">CMSKOREA bookstore</a></h3>
			</div>
			<div class="m-4">
				<div class=" text-start mb-5">
                    <span class="fs-5 pagetitle">서점 관리자 페이지</span>
                    <span class="text-primary text-opacity-75 pagedescription">- 도서 정보 수정 -</span>
                </div>
				<div>
					<form method="POST" action="bookedit.php">
					<input type="hidden" name="detailPk" value="<?php echo $detailPk?>">
						<div class="input-group mb-3">
						  <span class="input-group-text w-25">제목</span>
						  <input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="책 제목을 입력하세요" value="<?php echo $rows["title"]?>">
						</div>
						<div class="input-group mb-3">
						  <span class="input-group-text w-25">작가</span>
						  <input type="text" class="form-control" id="inputWriter" name="inputWriter" placeholder="글쓴이를 입력하세요" value="<?php echo $rows["writer"]?>">
						</div>
						<div class="input-group mb-3">
						  <span class="input-group-text w-25">줄거리</span>
						  <textarea class="form-control" id="inputContent" name="inputContent" placeholder="줄거리 또는 책 설명을 입력하세요(생략 가능)"><?php echo $rows["content"]?></textarea>
						</div>
						<div class="input-group mb-3">
						  <span class="input-group-text w-25">해당 폴더 이름</span>
						  <input type="text" class="form-control" id="inputPath" name="inputPath" placeholder="file/" value="<?php echo $rows["path"]?>">
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
            $(document).on('click', '#addCancel',function(){
               location.href = "bookdetailpage.php?detailPk="+<?php echo $detailPk?>;
            });
        });
        </script>
    </body>
</html>