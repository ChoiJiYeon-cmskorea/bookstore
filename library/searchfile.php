<?php
class DBbookclass{
    private $host = 'localhost';
    private $userid = "root";
    private $password = "cmskorea";
    private $database = "bookstore";
    protected $db;
    
    //생성자
    public function __construct(){
        $this->db = $this->classConnectDB();
    }
    //소멸자
    function __destruct() {
        mysqli_close($this->classConnectDB());
    }	
    
    private function classConnectDB() {
        $classdbconn = mysqli_connect($this->host, $this->userid, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            return $classdbconn;
        }
    }
    // DB 책 전체 조회 함수
    function DbBookList($table, $column){
        $result = mysqli_query($this->db,'select ' . $column . ' from ' . $table . ";");
        if ($result) {
            return $result;
        } else {
            return mysqli_error($this->db);
        }
    }
    // DB 책 검색 함수
    function DbsearchBook($table, $row, $var, $column){
        $result = mysqli_query($this->db,'select ' . $column . ' from ' . $table . ' where ' . $row . " LIKE '%" . $var . "%';");
        if ($result) {
            return $result;
        } else {
            return mysqli_error($this->db);
        }
    }
    // DB 책 확인 함수
    function DbdetailBook($table, $row, $var, $column){
        $result = mysqli_query($this->db,'select ' . $column . ' from ' . $table . ' where ' . $row . "=" . $var . ";");
        if ($result) {
            return $result;
        } else {
            return mysqli_error($this->db);
        }
    }
    //DB삽입
    function getDbInsert($table,$key,$val){
        $rs = mysqli_query($this->db,"insert into " . $table . " " . $key . " values" . $val);
        if (!$rs) {
            echo "등록실패 : " . mysqli_error($this->db);
        }
    }
    //DB업데이트
    function getDbUpdate($table,$set, $row, $var){
        $query = "update " . $table . " set " . $set . "where " . $row . "=" . $var . ";";
        $rs = mysqli_query($this->db,"update " . $table . " set " . $set . "where " . $row . "=" . $var . ";");
        if (!$rs) {
            echo $query;
            echo "등록실패 : " . mysqli_error($this->db);
        }
    }
    //DB삭제
    function getDbDelete($table, $row, $var){
        $rs = mysqli_query($this->db,"delete from " . $table . ' where ' . $row . "=" . $var . ";");
        if (!$rs) {
            echo "등록실패 : " . mysqli_error($this->db);
        }
    }
    //DB 불러오기    
    function getDBconnect(){
        return $this->db;
    }
}