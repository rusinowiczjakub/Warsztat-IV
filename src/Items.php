
<?php

require __DIR__.'/../connection.php';
require __DIR__.'/render.php';

Class Items{

    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;
    private $groupId;

    /**
     * Items constructor.
     */
    public function __construct($name = "", $price = null, $description = "", $quantity = null, $groupId = null )
    {
        $this->id = -1;
        $this->setName($name);
        $this->setPrice($price);
        $this->setDescription($description);
        $this->setQuantity($quantity);
        $this->setGroupId($groupId);
    }


    //Methods



    public function saveToDB(PDO $conn)
    {
        if ($this->id = -1) {
            $sql = 'INSERT INTO Items(name, price, description, quantity, group_id) 
                    VALUES(:name, :price, :description, :quantity, :group_id)';
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'group_id' => $this->groupId
            ]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }

        } else {
            $sql = 'UPDATE Items SET name=:name,group_id=:group_id,description=:description,price=:price WHERE id=:id';
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                'id' => $this->id,
                'name' => $this->name,
                'group_id' => $this->groupId,
                'description' => $this->description,
                'price' => $this->price
            ]);
            if ($result) {
                return true;
            }
            return false;
        }
    }

    public static function deleteItem(PDO $conn, $id){
        if($id != -1 && is_int($id)){
            $sql = 'DELETE FROM Items WHERE id='.$id;
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute();

            return $result;
        }
        return false;
    }

    public static function showItems(PDO $conn)
    {
        $sql = 'SELECT * FROM Items';
        $stmt = $conn->query($sql);
        $result = $stmt->fetchAll();

        $arr = [];
        $html ="";
        foreach($result as $key){
            $arr['name']=$key['name'];
            $html.= render('../html/items.html',$arr);
        }

        return $html;
    }

    public static function showItemById(PDO $conn, $id)
    {
        $sql = 'SELECT * FROM Items WHERE id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return render("../html/items.html", $row);

    }




    //Getters and Setters
    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

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

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}



Items::deleteItem($conn, 3);

