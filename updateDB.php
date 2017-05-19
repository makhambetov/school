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
            mysqli_query($link, "UPDATE classes SET students_count = students_count + 1 WHERE 'name' = " . $data["class_id"]);
            echo getAve($data["class_id"]);
        }
    }

    if($_POST["q"]=="edit_s")
    {
        if($data["start_date"] == '-') $data["start_date"] = null;
        if($data["end_date"] == '-') $data["end_date"] = null;
        mysqli_query($link, "UPDATE students SET student_name = '" . $data["student_name"] .
            "', class_id = '" .$data["class_id"]. "', mark = '" . $data["mark"].
            "', start_date = '" . $data["start_date"] . "', end_date = '" . $data["end_date"] . "' WHERE id = '" . $data['id'] . "'");

        $students_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM students WHERE class_id ='" . $data["class_id"]. "'"));
        mysqli_query($link, "UPDATE classes SET students_count =" .$students_count[0]. " WHERE name = '" . $data["class_id"] . "'");
        echo getAve($data["class_id"]);
    }

    if ($_POST["q"]=="remove_s")
    {
        mysqli_query($link, "DELETE FROM students WHERE id =" . $_POST["id"]);
        mysqli_query($link, "UPDATE classes SET students_count = students_count - 1 WHERE 'name' = " . $_POST["class_id"]);
        echo "res " . $_POST["id"];
    }

//обработка таблицы классы
    if($_POST["q"]=="new_c")
    {
        {
            mysqli_query($link, "INSERT INTO classes ('name', 'teacher_name') VALUES('" .
                $data["name"] . "','" . $data["teacher_name"] . "')");
            echo "<p>Added</p> <br>". $data["id"] . $qRes;
        }
    }

    if($_POST["q"]=="edit_c")
    {
        mysqli_query($link, "UPDATE classes SET name = '" . $data["name"] .
            "', teacher_name = '" .$data["teacher_name"]. "' WHERE name = '" . $data["id"] ."'");
        echo $data["id"] . $qRes;
    }

    if ($_POST["q"]=="remove_c")
    {
        mysqli_query($link, "DELETE FROM classes WHERE 'name' ='" . $_POST["id"] . "'");
        echo "res " . $_POST["id"];
    }

}


?>