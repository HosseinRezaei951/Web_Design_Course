<?php 
require_once "database.php";


class reservationCustomer  {
    public $username;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    private $date;
    private $modelID;
    private $description;

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($uname)
    {
        $this->username = $uname;
    }
    function getFirstname()
    {
        return $this->firstName;
    }

    function setFirstname($fName)
    {
        $this->firstName = $fName;
    }

    function getLastname()
    {
        return $this->lastName;
    }

    function setLastname($lName)
    {
        $this->lastName = $lName;
    }

    function getPhonenumber()
    {
        return $this->phoneNumber;
    }

    function setPhonenumber($pNumber)
    {
        $this->phoneNumber = $pNumber;
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
        $this->modelID = $newModelId;
      }
    
      function getDescription(){
        return $this->description;
      }
    
      function setDescription($newDescription){
        $this->description = $newDescription;
      }

      function GetAll(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getAllReservationCostumer', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = $tempRes;
        }
        return $reservations;
      }


      function GetAllAngular(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getAllReservationCostumer', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] =get_object_vars($tempRes);
        }
        return $reservations;
      }

    
      function GetByDate($start,$end){
        $paramTypes = "ss";
        $Parameters = array($start,$end);
        $data = database::ExecuteQuery('getReservationsCostumerByDate', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = $tempRes;
        }
        return $reservations;
      }
    
      function GetByDateAngular($start,$end){
        $paramTypes = "ss";
        $Parameters = array($start,$end);
        $data = database::ExecuteQuery('getReservationsCostumerByDate', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = get_object_vars($tempRes);
        }
        return $reservations;
      }
    
      function GetAllDone(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getAllReservationHistoryCustomer', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = $tempRes;
        }
        return $reservations;
      }
    
          
      function GetAllDoneAngular(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getAllReservationHistoryCustomer', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] =get_object_vars($tempRes);
        }
        return $reservations;
      }
    
      function GetDoneByDate($start,$end){
        $paramTypes = "ss";
        $Parameters = array($start,$end);
        $data = database::ExecuteQuery('getReservationsHistoryCostumerByDate', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = $tempRes;
        }
        return $reservations;
      }

      function GetDoneByDateAngular($start,$end){
        $paramTypes = "ss";
        $Parameters = array($start,$end);
        $data = database::ExecuteQuery('getReservationsHistoryCostumerByDate', $paramTypes, $Parameters);
        $reservations = array();
        $i = 0;
        while ($row = $data->fetch_array())
        {
            $tempRes = new reservationCustomer();
            $tempRes->setUsername($row[0]);
            $tempRes->setDate($row[1]);
            $tempRes->setModelId($row[2]);
            $tempRes->setDescription($row[3]);
            $tempRes->setPhonenumber($row[6]);
            $tempRes->setFirstname($row[7]);
            $tempRes->setLastname($row[8]);
            $reservations[$i++] = get_object_vars($tempRes);
        }
        return $reservations;
      }

}