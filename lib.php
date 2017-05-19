<?php

//подключение к базе данных
function connect_db()
{
    $link = mysqli_connect("localhost","root","")
    or die("Data base connection error");
    mysqli_select_db($link, "school");
    mysqli_set_charset($link, "utf8");
    return $link;
}

//вычисление и возврат среднего балла класса
//аргумент - название класса
function getAve($class_name)
{
    $link = connect_db();
    $res = mysqli_query($link, "SELECT AVG(mark) AS markAvg FROM students WHERE class_id = '" . $class_name . "'");
    $avg =  mysqli_fetch_array($res)[0];
    $qRes = mysqli_query($link, "UPDATE classes SET av_mark = " . $avg . " WHERE name = '" . $class_name ."'");
    if($qRes) return $avg;
    return false;
}