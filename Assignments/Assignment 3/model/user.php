<?php
abstract class person
{
    public $name;
    public $family;

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getFamily()
    {
        return $this->family;
    }

    function setFamily($family)
    {
        $this->family = $family;
    }
}

class user extends person
{
    private $username;
    private $password;

    function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password, $hashit = true)
    {
        if ($hashit)
            $this->password = md5($password);
        else
            $this->password = $password;
    }

    function checkUserPass()
    {
        $myfile = fopen("users.txt", "r");
        while (!feof($myfile)) {
            $temp = fgets($myfile);
            $userinfo = preg_split('/[\s]+/', $temp);
            if ($this->username == $userinfo[0] && $this->password == $userinfo[1]) {
                $this->name = $userinfo[2];
                $this->family = $userinfo[3];
                fclose($myfile);
                return true;
            }
        }

        fclose($myfile);
        return false;
    }

    private function getUserAsaText()
    {
        return $this->username . ' ' . $this->password . ' ' . $this->name . ' ' . $this->family . PHP_EOL;
    }

    private function IsUsernameExist()
    {
        $myfile = fopen("users.txt", "r");
        while (!feof($myfile)) {
            $temp = fgets($myfile);
            $userinfo = preg_split('/[\s]+/', $temp);
            if ($this->username == $userinfo[0]) {
                fclose($myfile);
                return true;
            }
        }
        fclose($myfile);
        return false;
    }

    function IsUserExist()
    {
        $myfile = fopen("users.txt", "r");
        while (!feof($myfile)) {
            $temp = fgets($myfile);
            $userinfo = preg_split('/[\s]+/', $temp);
            if (
                $this->username == $userinfo[0] &&
                $this->name == $userinfo[2] &&
                $this->family == $userinfo[3]
            ) {
                fclose($myfile);
                return true;
            }
        }
        fclose($myfile);
        return false;
    }

    function UpdatePassword()
    {
        $reading = fopen('users.txt', 'r');
        $writing = fopen('myfile.tmp', 'w');

        $replaced = false;

        while (!feof($reading)) {
            $line = fgets($reading);
            $userinfo = preg_split('/[\s]+/', $line);
            if ($this->username == $userinfo[0]) {
                $line = $this->getUserAsaText();
                $replaced = true;
            }
            fputs($writing, $line);
        }
        fclose($reading);
        fclose($writing);
        // might as well not overwrite the file if we didn't replace anything
        if ($replaced) {
            rename('myfile.tmp', 'users.txt');
            return true;
        } else {
            unlink('myfile.tmp');
            return false;
        }
    }

    function Save()
    {
        if (!$this->IsUsernameExist()) {
            $myfile = fopen("users.txt", "a");
            fwrite($myfile, $this->getUserAsaText());
            fclose($myfile);
            return true;
        }
        return false;
    }
}
