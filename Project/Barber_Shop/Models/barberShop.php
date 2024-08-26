<?php

require_once "database.php";

class barberShop{
    private $name;
    private $address;
    private $phoneNumber;
    private $photo;
    private $logo;
    private $licenseNumber;


    function getName()
    {
        return $this->name;
    }

    function setName($newName)
    {
        $this->name = $newName;
    }

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($newAddress)
    {
        $this->address = $newAddress;
    }

    function getPhonenumber()
    {
        return $this->phoneNumber;
    }

    function setPhonenumber($pNumber)
    {
        $this->phoneNumber = $pNumber;
    }

    function getPhoto()
    {
        return $this->photo;
    }

    //change after
    function setPhoto($newPhoto)
    {
        $target_dir = "Project/uploads/barbershop/photo/";
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
                echo "The file ". basename( $newPhoto["name"]). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
    }

    function getLogo()
    {
        return $this->logo;
    }

    //change after
    function setLogo($newLogo)
    {
        $target_dir = "Project/uploads/barbershop/logo/";
        $target_file = $target_dir . basename($newLogo["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($newLogo["tmp_name"]);
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
            if (move_uploaded_file($newLogo["tmp_name"], 'D:/web/localserver/Apache24/htdocs/'.$target_file)) {
                $this->logo = "http://localhost/" . $target_file;
                echo "The file ". basename( $newLogo["name"]). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }
        }

        
    }

    function getLicenseNumber()
    {
        return $this->licenseNumber;
    }

    function setLicenseNumber($newLicenseNumber)
    {
        $this->licenseNumber = $newLicenseNumber;
    }

    function Save(){
        $paramTypes = "ssssss";
        $Parameters = array($this->licenseNumber, $this->name,
        $this->phoneNumber,$this->photo, $this->logo,$this->address);
        database::ExecuteQuery('addBarberShop', $paramTypes, $Parameters);
        return true;
    }

    function Update($newLicenseNumber){
        $paramTypes = "sssssss";
        $Parameters = array($this->licenseNumber, $this->name,
        $this->phoneNumber,$this->photo, $this->logo,$this->address,$newLicenseNumber);
        database::ExecuteQuery('updateBarberShop', $paramTypes, $Parameters);
        return true;
    }

    function GetInfo(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getBarberShopInfo', $paramTypes, $Parameters);
        $row = $data->fetch_array();
        $this->licenseNumber = $row[0];
        $this->name = $row[1];
        $this->phoneNumber = $row[2];
        $this->photo = $row[3];
        $this->logo = $row[4];
        $this->address = $row[5];
        return true;
    }

    function GetInfoAngular(){
        $paramTypes = "";
        $Parameters = array();
        $data = database::ExecuteQuery('getBarberShopInfo', $paramTypes, $Parameters);
        $row = $data->fetch_array();
        $this->licenseNumber = $row[0];
        $this->name = $row[1];
        $this->phoneNumber = $row[2];
        $this->photo = $row[3];
        $this->logo = $row[4];
        $this->address = $row[5];
        return get_object_vars($this);
    }

}
