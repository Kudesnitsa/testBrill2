<?php

class model
{
    protected $linkDB;
    protected $tables = array(
        'client' => 'fullNameClient',
        'phone' => 'phone'
    );

    function __construct()
    {
       // mysql://b62ff97167ba14:d915f3dc@us-cdbr-iron-east-04.cleardb.net/heroku_77c71843ce5e91a?reconnect=true

        $this->linkDB = mysqli_connect("us-cdbr-iron-east-04.cleardb.net", "b62ff97167ba14", "d915f3dc");
        mysqli_select_db($this->linkDB, "heroku_77c71843ce5e91a") or die("Error:" . mysqli_error($this->linkDB));
        mysqli_query($this->linkDB, "SET NAMES 'utf8'");

    }

    function getFromMySQL()
    {
        $query = "SELECT `" . $this->tables['client'] . "`.*,  GROUP_CONCAT(`phone` SEPARATOR ', ')as phones FROM `" .
            $this->tables['client'] . "`LEFT OUTER JOIN `" . $this->tables['phone'] . "` ON`" .
            $this->tables['client'] . "`.id=`" . $this->tables['phone'] . "`.idClient " .
            "GROUP BY `" . $this->tables['client'] . "`.id,name,surname,idClient ";
        $result = mysqli_query($this->linkDB, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function add($name, $surname, $phones)
    {
        $id = null;
        try {
//            mysqli_autocommit($this->linkDB,FALSE);
            mysqli_begin_transaction($this->linkDB);
            $query = "INSERT INTO `" . $this->tables['client'] . "` ( `name`, `surname`) VALUES ( '$name', '$surname');";
            $first = mysqli_query($this->linkDB, $query);
            if (!empty($phones) && is_array($phones)) {
                $id = mysqli_insert_id($this->linkDB);
                $query = "INSERT INTO `" . $this->tables['phone'] . "` ( `phone`, `idClient`) VALUES ";
                foreach ($phones as $phone) {
                    $query .= "( '$phone', '$id'),";
                }
                $query = substr_replace($query, ';', strlen($query) - 1);
                $second=mysqli_query($this->linkDB, $query);
                if(!$first || !$second) {
                    throw new Exception("Error:" . mysqli_error($this->linkDB));
                }
            }
            mysqli_commit($this->linkDB);
        } catch (Exception $e) {
            mysqli_rollback($this->linkDB);
            return $e->getMessage();
        }
        return $this->getByID($id);
    }

    function getByID($id = null)
    {
        if (empty($id)) {
            return 'error';
        }
        $query = "SELECT `" . $this->tables['client'] . "`.*,  GROUP_CONCAT(`phone` SEPARATOR ', ')as phones FROM `" .
            $this->tables['client'] . "` LEFT OUTER JOIN `" . $this->tables['phone'] . "` ON`" .
            $this->tables['client'] . "`.id=`" . $this->tables['phone'] . "`.idClient  WHERE " .
            $this->tables['client'] . "id=$id" .
            "GROUP BY `" . $this->tables['client'] . "`.id,name,surname,idClient ";
        $result = mysqli_query($this->linkDB, $query);
        if($result){
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

}

