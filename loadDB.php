<?php
/*
 * Загрузка с БД
 * */
include "lib.php";
$link = connect_db();

//загрузка данных с базы
if (isset($_GET["loadDB"]))
{
    if($_GET["loadDB"] == "classes")
    {
        $arr = [];
        $res = mysqli_query($link, "SELECT * FROM classes");

        //формируем строку json
        while ($row = mysqli_fetch_array($res))
            $arr[] = '{"id":"' . $row["id"] . '","name":"'. $row["name"] . '","teacher_name":"' . $row["teacher_name"] .
                '","av_mark":"' . $row["av_mark"] . '","stud_count":"' . $row["students_count"] . '"}';

        $json = "[" . implode(",", $arr) . "]";
        echo $json;
    }

    if($_GET["loadDB"] == "students")
    {
        $arr = [];
        $res = mysqli_query($link, "SELECT * FROM students");

        //формируем строку json
        while ($row = mysqli_fetch_array($res))
            $arr[] = '{"id":"' . $row["id"] . '","student_name":"' . $row["student_name"] .
                '","class_id":"'. $row["class_id"] . '","mark":"'. $row["mark"] .
                '","start_date":"'. $row["start_date"].'","end_date":"'. $row["end_date"].'"}';

        $json = "[" . implode(",", $arr) . "]";
        echo $json;
    }

}

?>