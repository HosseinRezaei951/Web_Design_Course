<?php

require_once "database.php";

class workSample{
  private $photo;
  private $modelName;
  private $ID;
  private $description;


  function setPhoto($newPhoto){
    $target_dir = "Project/uploads/worksamples/";
    $target_file = $target_dir . basename($newPhoto["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($newPhoto["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    }else{
        
        if (move_uploaded_file($newPhoto["tmp_name"], 'D:/web/localserver/Apache24/htdocs/'.$target_file)) {
          
            $this->photo = "http://localhost/" . $target_file;
            echo "The file ". basename($newPhoto["name"]). " has been uploaded.";
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }
  }

  function setPhotoWithoutFile($newPhotoUrl){
    $this->photo = $newPhotoUrl;
  }

  function getPhoto(){

    return $this->photo;

  }

  function setModelName($newModelName){

    $this->modelName = $newModelName;

  }

  function getModelName(){

    return $this->modelName;

  }

  private function setID($newID){
    $this->ID=$newID;
 }
 
 function getID(){

  return $this->ID;

}
  function setDescription($newDescription){

    $this->description = $newDescription;

  }

  function getDescription(){

    return $this->description;

  }

  
  function Save(){
    $paramTypes = "sss";
    $Parameters = array($this->modelName,
    $this->photo, $this->description);
    $id = database::ExecuteQuery('addWorkSample', $paramTypes, $Parameters);
    print_r( $id);
    $row = $id->fetch_array();
    $this->ID= $row[0];
    return true;
  }

  function GetAll(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllWorkSamples', $paramTypes, $Parameters);
    $workSamples = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempWorkSample = new workSample();
        $tempWorkSample->setID($row[0]);
        $tempWorkSample->setModelName($row[1]);
        $tempWorkSample->setPhotoWithoutFile($row[2]);
        $tempWorkSample->setDescription($row[3]);
        $workSamples[$i++] = $tempWorkSample;
    }
    return $workSamples;
  }

  function GetAllAngular(){
    $paramTypes = "";
    $Parameters = array();
    $data = database::ExecuteQuery('getAllWorkSamples', $paramTypes, $Parameters);
    $workSamples = array();
    $i = 0;
    while ($row = $data->fetch_array())
    {
        $tempWorkSample = new workSample();
        $tempWorkSample->setID($row[0]);
        $tempWorkSample->setModelName($row[1]);
        $tempWorkSample->setPhotoWithoutFile($row[2]);
        $tempWorkSample->setDescription($row[3]);
        $workSamples[$i++] = get_object_vars($tempWorkSample);
    }
    return $workSamples;
  }

  function Update(){
      $paramTypes = "ssss";
      $Parameters = array($this->ID, $this->modelName,
      $this->photo, $this->description);
      database::ExecuteQuery('updateWorkSample', $paramTypes, $Parameters);
      return true;
  }
  
  function Delete(){
    $paramTypes = "s";
    $Parameters = array($this->ID);
    database::ExecuteQuery('deleteWorkSample', $paramTypes, $Parameters);
    return true;
  }

}

?>