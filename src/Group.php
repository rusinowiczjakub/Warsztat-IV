<?php

require __DIR__."/../connection.php";
require_once __DIR__."/render.php";

Class Groups
{
    private $id;
    private $name;

    /**
     * Groups constructor.
     * @param $id
     * @param $name
     */
    public function __construct($name = "")
    {
        $this->id = -1;
        $this->setName($name);
    }

    public static function showGroupById($conn, $id)
    {
    $sql = 'SELECT * FROM Groups WHERE id:='.$id;
    $stmt = $conn->prepare($sql);
    $result = $stmt->fetch();

    return $result;
    }

    public function createGroup(PDO $conn)
    {

        $sql = 'INSERT INTO Groups(name) VALUES(:name)';
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            'name' => $this->name
        ]);
        if($result !== false){
            $this->id = $conn->lastInsertId();
            return true;
        }
        return false;

    }

    public static function showGroups(PDO $conn)
    {
    $sql = 'SELECT * FROM Groups';
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll();

        $arr = [];
        $html="";
        foreach ($result as $key) {
            $arr['name']=$key['name'];
            $arr['id']=$key['id'];
            $html.= render('../html/groups.html',$arr);
        }

    return $html;

    }

    public static function deleteGroup(PDO $conn, $id)
    {
        if($id != -1 && is_int($id)){
            $sql = 'DELETE FROM Groups WHERE id='.$id;
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute();

            return $result;
        }
        return false;
    }



    //SETTERS AND GETTERS

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
//echo Groups::showGroups($conn);




