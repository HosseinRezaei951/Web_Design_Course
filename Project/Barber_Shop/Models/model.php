<?php

require_once "database.php";

class model{
  private $photo;
  private $modelName;
  private $price;
  private $modelType;
  private $ID;
  private $description;

  function setPhotoUrl($newPhotoUrl){
        
    $target_dir = "Project/uploads/models/";
    $target_file = $target_dir . basename($newPhotoUrl["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($newPhotoUrl["tmp_name"]);
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
        if (move_uploaded_file($newPhotoUrl["tmp_name"], 'D:/web/localserver/Apache24/htdocs/'.$target_file)) {
            $this->photo = "http://localhost/" . $target_file;
            echo "The file ". basename( $newPhotoUrl["name"]). " has been uploaded.";
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }

}
function getPhotoUrl(){

    return $this->photo;
    
}

function setPhotoUrlWithoutFile($newPhotoUrl){
  $this->photo = $newPhotoUrl;
}

function setModelName($newModelName){
  $this->modelName = $newModelName;

}
function getModelName(){
  return $this->modelName ;

}

function setPrice($newPrice){
  $this->price = $newPrice;
}

function getPrice(){
  return $this->price;
}

function setModelType($newModelType){
  $this->modelType = $newModelType;


}

function getModelType(){
  return $this->modelType;

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
  $paramTypes = "sssss";
  $Parameters = array($this->modelName, $this->modelType,
   $this->price,$this->photo, $this->description);
  $id = database::ExecuteQuery('addModel', $paramTypes, $Parameters);
  $row = $id->fetch_array();
  $this->ID= $row[0];
  return true;
}

function GetAll(){
  $paramTypes = "";
  $Parameters = array();
  $data = database::ExecuteQuery('getAllModels', $paramTypes, $Parameters);
  $models = array();
  $i = 0;
  while ($row = $data->fetch_array())
  {
      $tempModel = new model();
      $tempModel->setID($row[0]);
      $tempModel->setModelName($row[1]);
      $tempModel->setModelType($row[2]);
      $tempModel->setPrice($row[3]);
      $tempModel->setPhotoUrlWithoutFile($row[4]);
      $tempModel->setDescription($row[5]);
      $models[$i++] = $tempModel;
  }
  return $models;
}

function GetAllAngular(){
  $paramTypes = "";
  $Parameters = array();
  $data = database::ExecuteQuery('getAllModels', $paramTypes, $Parameters);
  $models = array();
  $i = 0;
  while ($row = $data->fetch_array())
  {
      $tempModel = new model();
      $tempModel->setID($row[0]);
      $tempModel->setModelName($row[1]);
      $tempModel->setModelType($row[2]);
      $tempModel->setPrice($row[3]);
      $tempModel->setPhotoUrlWithoutFile($row[4]);
      $tempModel->setDescription($row[5]);
      $models[$i++] = get_object_vars($tempModel);
  }
  return $models;
}

function Update(){
  $paramTypes = "ssssss";
  $Parameters = array($this->ID, $this->modelName, $this->modelType,
  $this->price,$this->photo, $this->description);
  database::ExecuteQuery('updateModel', $paramTypes, $Parameters);
  return true;
}

function Delete(){
  $paramTypes = "s";
  $Parameters = array($this->ID);
  database::ExecuteQuery('deleteModel', $paramTypes, $Parameters);
  return true;
}




}
