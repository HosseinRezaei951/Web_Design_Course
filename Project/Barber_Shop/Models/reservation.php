<?php

require_once "database.php";

class reservation{
  private $username;
  private $date;
  private $modelID;
  private $description;

  
  function getUsername(){
      return $this->username;
  }

  function setUsername($newUsername){
      $this->username = $newUsername;
  }

  function getdate(){
    return $this->date;
  }

  function setDate($newDate){
    $this->date = $newDate;
  }

  function getModelId(){
    return $this->modelId;
  }

  function setModelId($newModelId){
    if($newModelId == -1){
      $this->modelID = null;
    }else{
      $this->modelID = $newModelId;
    }
    
  }

  function getDescription(){
    return $this->description;
  }

  function setDescription($newDescription){
    $this->description = $newDescription;
  }

  function Save(){
    $paramTypes = "ssss";
    $Parameters = array($this->username, $this->date,
    $this->modelID,$this->description);
    database::ExecuteQuery('addReservation', $paramTypes, $Parameters);
    return true;
}

  function Delete(){
    $paramTypes = "ss";
    $Parameters = array($this->username, $this->date);
    database::ExecuteQuery('deleteReservation', $paramTypes, $Parameters);
    return true;
  }


  function Cancel(){
    $paramTypes = "ss";
    $Parameters = array($this->username, $this->date);
    database::ExecuteQuery('cancelReservation', $paramTypes, $Parameters);
    return true;
  }

  function GetAll(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservations', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = $tempRes;
    }
    return $reservations;
  }

  function GetAllAngular(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservations', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] =  get_object_vars($tempRes);
    }

    return $reservations;
   
  }

  function GetByDate($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationsByDate', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = $tempRes;
    }
    return $reservations;
  }

  function GetByDateAngular($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationsByDate', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = get_object_vars($tempRes);
    }
    return $reservations;
  }

  function GetAllDone(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservationHistory', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = $tempRes;
    }
    return $reservations;
  }

  function GetAllDoneAngular(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllReservationHistory', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = get_object_vars($tempRes);
    }
    return $reservations;
  }
  function GetDoneByDate($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationsHistoryByDate', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = $tempRes;
    }
    return $reservations;
  }

  function GetDoneByDateAngular($start,$end){
    $paramTypes = "ss";
    $Parameters = array($start,$end);
    $data = database::ExecuteQuery('getReservationsHistoryByDate', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = get_object_vars($tempRes);
    }
    return $reservations;
  }

  function getReservationByUsername(){
    $paramTypes = "s";
    $Parameters = array($this->username);
    $data = database::ExecuteQuery('getReservationCostumer', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = $tempRes;
    }
    return $reservations;
  }


  function getReservationByUsernameAngular(){
    $paramTypes = "s";
    $Parameters = array($this->username);
    $data = database::ExecuteQuery('getReservationCostumer', $paramTypes, $Parameters);
    $reservations = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempRes = new reservation();
        $tempRes->setUsername($row[0]);
        $tempRes->setDate($row[1]);
        $tempRes->setModelId($row[2]);
        $tempRes->setDescription($row[3]);
        $reservations[$i++] = get_object_vars($tempRes);
    }
    return $reservations;
  }

}

?>