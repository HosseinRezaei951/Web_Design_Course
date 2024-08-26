<?php
require_once "database.php";


class reserveTime{
  private $date;


  //format yy-mm-dd hh:mm:ss
  function setDate($newDate){
    $this->date = $newDate;
  }

  function setDateWithoutZero($newDate){
    $this->date = $newDate;
  }

  function getDate(){
    return $this->date;
  }



  function Save(){
    $paramTypes = "s";
    $Parameters = array($this->date );
    $data = database::ExecuteQuery('addReservationTime', $paramTypes, $Parameters);
    $res = $data->fetch_array();
    return $res[0];
  }


  function Delete(){
    $paramTypes = "s";
    $Parameters = array($this->date );
    database::ExecuteQuery('deleteReservationTime', $paramTypes, $Parameters);
    return true;
  }


  function Update($newDate){
    $paramTypes = "s";
    $Parameters = array($this->date,$newDate );
    database::ExecuteQuery('updateReservationTime', $paramTypes, $Parameters);
    return true;
  }

  
  function GetAll(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservationTimes', $paramTypes, $Parameters);
    $times = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempTime = new reserveTime();
        $tempTime->setDate($row[0]);
        $times[$i++] = $tempTime;
    }
    return $times;
  }

  function GetAllAngular(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservationTimes', $paramTypes, $Parameters);
    $times = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempTime = new reserveTime();
        $tempTime->setDate($row[0]);
        $times[$i++] =  get_object_vars($tempTime);
    }
    return $times;
  }

  function GetByDate($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationTimesByDate', $paramTypes, $Parameters);
    $times = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempTime = new reserveTime();
        $tempTime->setDate($row[0]);
        $times[$i++] = $tempTime;
    }
    return $times;
  }

  function GetByDateAngular($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationTimesByDate', $paramTypes, $Parameters);
    $times = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempTime = new reserveTime();
        $tempTime->setDate($row[0]);
        $times[$i++] = get_object_vars($tempTime);
    }
    return $times;
  }
}

?>