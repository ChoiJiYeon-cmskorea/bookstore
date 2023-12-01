<?php
require_once "./../../library/searchfile.php";
$DBadminbook = new DBbookclass();
//전체 도서 데이터 조회
$dbbooklist = $DBadminbook->DbBookList("book", "*");
if(isset($_POST["deletePk"])){
	$DBadminbook->getDbDelete("book", "pk", $_POST["deletePk"]);
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
        <title>서점 관리 페이지</title>
    </head>
    <body>
        <div class="container border border-secondary listcontainer">
	        <div class="header row bg-secondary">
				<h3 class="align-self-center fw-bold"><a class="text-white text-decoration-none" href="bookstoreadmin.php">CMSKOREA bookstore</a></h3>
			</div>
			<div class="m-4">
				<div class="mb-3 d-flex justify-content-between">
					<div>
	                    <span class="fs-5 pagetitle">서점 관리자 페이지</span>
	                    <span class="text-primary text-opacity-75 pagedescription">- 도서 리스트 -</span>
                    </div>
                    <div>
                    	<button class="btn btn-primary ms-5 "  id="bookWrite">새 도서 추가</button>
                    </div>
                </div>
                <div style="height: 700px;  overflow :auto;">
					<table class="table border table-hover justify-content-center" id="bookadminlist">
						<thead>
						    <tr>
						      <th class="col-1">번호</th>
						      <th class="col-5">제목</th>
						      <th class="col-2">글쓴이</th>
						      <th class="col-2">작업</th>
						    </tr>
						</thead>
						<tbody>
						<?php foreach($dbbooklist as $value ) { ?>  
			                <tr class='align-middle' >
				                <th scope='row'><?php echo $value["pk"];?></th>
				                <td><?php echo $value["title"];?></td>
				                <td><?php echo $value["writer"];?></td>
				                <td><button type='button' class='btn btn-warning text-white viewButton'>정보</button>
				                <button type='button' class='btn btn-danger deleteButton ms-1'>삭제</button></td>
			                </tr>
			        	<?php }?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <script>
        $(document).ready(function () {
            //새 도서 작성
            $(document).on('click', '#bookWrite',function(){
               location.href = 'bookaddpage.php'; 
            });
            
            //도서 정보 확인
            $(document).on('click', 'body div.container .viewButton', function() {
                var thisRow = $(this).closest('tr'); 
                var detailPk = parseInt(thisRow.find('th').text());
                location.href = "bookdetailpage.php?detailPk="+detailPk; 
            });
            
            //도서 정보 삭제
            $(document).on('click', 'body div.container .deleteButton', function() {
                thisRow = $(this).closest('tr'); 
                var deletePk = parseInt(thisRow.find('th').text());
                $.ajax({
	            url : 'bookstoreadmin.php',
	            type : 'POST',
	            dataType : 'text',
	            data : {deletePk:deletePk},
	            error : function(e){
	            console.log(e);
	            }, success : function(result){
	                }
	            });
	            location.href = "bookstoreadmin.php";
            });
        });
        </script>
    </body>
</html>