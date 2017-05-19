<?php
include "lib.php";
$link = connect_db();

if(isset($_POST))
{
    $data = [];
    if(isset($_POST["data"]))
        $data = json_decode($_POST["data"], true);

    //обработка таблицы студенты
    if($_POST["q"]=="new_s")
    {
        {
            $qRes = mysqli_query($link, "INSERT INTO students VALUES('','" . $data["student_name"] . "','" .$data["class_id"]. "','" .
                $data["mark"]. "','" . $data["start_date"] . "','" . $data["end_date"] . "')");
            mysqli_query($link, "UPDATE classes SET students_count = students_count + 1 WHERE id = " . $data["class_id"]);
            echo getAve($data["class_id"]);
            //echo "<p>Added</p> <br>" . $qRes;
        }
    }

    if($_POST["q"]=="edit_s")
    {
        $qRes = mysqli_query($link, "UPDATE students SET student_name = '" . $data["student_name"] .
            "', class_id = '" .$data["class_id"]. "', mark = '" . $data["mark"].
            "', start_date = '" . $data["start_date"] . "', end_date = '" . $data["end_date"] . "' WHERE id = '" . $data['id'] . "'");
        //echo "<p>Added</p> <br>" . $data["student_name"] . $qRes;
        echo getAve($data["class_id"]);
    }

    if ($_POST["q"]=="remove_s")
    {
        mysqli_query($link, "DELETE FROM students WHERE id =" . $_POST["id"]);
        mysqli_query($link, "UPDATE classes SET students_count = students_count - 1 WHERE id = " . $_POST["class_id"]);
        echo "res " . $_POST["id"];
        //echo getAve($_POST["class_id"]);
    }

//обработка таблицы классы
    if($_POST["q"]=="new_c")
    {
        {
            $qRes = mysqli_query($link, "INSERT INTO classes (id, teacher_name) VALUES('" .
                $data["id"] . "','" . $data["teacher_name"] . "')");
            echo "<p>Added</p> <br>". $data["id"] . $qRes;
        }
    }

    if($_POST["q"]=="edit_c")
    {
        $qRes = mysqli_query($link, "UPDATE classes SET id = '" . $data["id"] .
            "', teacher_name = '" .$data["teacher_name"]. "' WHERE id = '" . $_POST["oldId"] ."'");
        //echo "<p>Added</p> <br>" . $data["student_name"] . $qRes;
        echo $data["id"] . $qRes;
    }

    if ($_POST["q"]=="remove_c")
    {
        mysqli_query($link, "DELETE FROM classes WHERE id ='" . $_POST["id"] . "'");
        echo "res " . $_POST["id"];
        //echo getAve($_POST["class_id"]);
    }

}


?>