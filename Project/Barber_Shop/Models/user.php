<?php

require_once "database.php";

abstract class person
{
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $phoneNumber;


    function getUsername()
    {
        return $this->username;
    }

    function setUsername($uname)
    {
        $this->username = $uname;
    }

    function setPassword($password)
    {
        $algo = "sha256";
        $data = "today is good day but" . $password . "is not easy!!";
        $this->password = hash($algo, $data);
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




    protected function IsUsernameExist($procedure)
    {
        $paramTypes = "s";
        $Parameters = array($this->username);
        $result = database::ExecuteQuery($procedure, $paramTypes, $Parameters);
        if (mysqli_num_rows($result) > 0)
            return true;
        return false;
    }
}


class admin extends person
{
    private $photoURL;




    function setPhotoUrl($newPhotoUrl){
        $target_dir = "Project/uploads/admin/photo/";
        $target_file = $target_dir . basename($newPhotoUrl["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($newPhotoUrl["fileToUpload"]["tmp_name"]);
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
            if (move_uploaded_file($newPhotoUrl["fileToUpload"]["tmp_name"], 'D:/web/localserver/Apache24/htdocs/'.$target_file)) {
                $this->photoURL = "http://localhost/" . $target_file;
                echo "The file ". basename( $newPhotoUrl["fileToUpload"]["name"]). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
    function getPhotoUrl()
    {

        return $this->photoURL;
    }

    function Save()
    {
        if (!person::IsUsernameExist('isAdminExist')) {
            echo "s";
            $paramTypes = "ssssss";
            $Parameters = array(
                $this->username, $this->password,
                $this->phoneNumber, $this->firstName, $this->lastName, $this->photoURL
            );
            database::ExecuteQuery('addAdmin', $paramTypes, $Parameters);
            return true;
        }
        return false;
    }

    function Update()
    {

        $paramTypes = "ssssss";
        $Parameters = array(
            $this->username, $this->password,
            $this->phoneNumber, $this->firstName, $this->lastName, $this->photoURL
        );
        database::ExecuteQuery('updateAdmin', $paramTypes, $Parameters);
        return true;
    }


    function checkUserPass()
    {
        $paramTypes = "ss";
        $Parameters = array($this->username, $this->password);
        $result = database::ExecuteQuery("checkAdminUserPass", $paramTypes, $Parameters);

        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_array();
            $this->setFirstname($row[2]);
            $this->setLastname($row[3]);
            $this->setPhonenumber($row[4]);
            $this->setPhotoUrl($row[5]);
            return true;
        }
        return false;
    }
}

class customer extends person
{


    function Save()
    {
        if (!person::IsUsernameExist('isCostumerExist')) {
            $paramTypes = "sssss";
            $Parameters = array(
                $this->username, $this->password,
                $this->phoneNumber, $this->firstName, $this->lastName
            );
            database::ExecuteQuery('addCostumer', $paramTypes, $Parameters);
            return true;
        }
        return false;
    }

    function Update()
    {
        $paramTypes = "sssss";
        $Parameters = array(
            $this->username, $this->password,
            $this->phoneNumber, $this->firstName, $this->lastName
        );
        database::ExecuteQuery('updateCostumer', $paramTypes, $Parameters);
        return true;
    }

    function checkUserPass()
    {
        $paramTypes = "ss";
        $Parameters = array($this->username, $this->password);
        $result = database::ExecuteQuery("checkCostumerUserPass", $paramTypes, $Parameters);

        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_array();
            $this->setFirstname($row[2]);
            $this->setLastname($row[3]);
            $this->setPhonenumber($row[4]);
            return true;
        }
        return false;
    }
}
