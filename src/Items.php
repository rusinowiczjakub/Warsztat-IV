<?php

include __DIR__.'/../connection.php';

Class Items{

    static private $conn;
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

    public static function SetConnection($conn){
        Items::$conn = $conn;
    }
    public function saveToDB(PDO $conn)
    {
        if($this->id = -1){
            $sql = 'INSERT INTO Items(name, price, description, quantity, group_id) VALUES(:name, :price, :description, :quantity, :group_id)';
            $stmt = Items::$conn->query($sql);
            $result = $stmt->execute([
                'name'=>$this->getName(),
                'price'=>$this->getPrice(),
                'description'=>$this->getDescription(),
                'quantity'=>$this->getQuantity(),
                'group_id'=>$this->getGroupId()
            ]);
            if($result !== false){
                $this->id = $conn->lastInsertId();
                return true;
            }
        }else{
            $sql = 'UPDATE Items SET name=:name, price=:price, description=:description, quantity=:quantity, group_id=:group_id WHERE id=:id';
            $stmt = Items::$conn->prepare($sql);
            $result = $stmt->execute([
                'id'=>$this->id,
                'name'=>$this->name,
                'price'=>$this->price,
                'description'=>$this->description,
                'quantity'=>$this->quantity,
                'group_id'=>$this->groupId
            ]);

            if($result){
                return true;
            }
        }
        return false;
    }

    public function deleteFromDB(PDO $conn, $id){
        if($this->id != -1){
            $sql = 'DELETE FROM Items WHERE id=:id';
            $stmt = Items::$conn->prepare($sql);
            $result = $stmt->execute(['id'=>$id]);

            if($result === true){
                $this->id = -1;
                return true;
            }
        }
        return FALSE;
    }

    public function loadItemsById($id)
    {
        $stmt=Items::$conn->prepare('SELECT * FROM Items WHERE id=:id');
        $result=$stmt->execute(['id'=>$id]);

        if($result === true && $stmt->rowCount()>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedItem = new Items();
            $loadedItem->id = $row['id'];
            $loadedItem->name = $row['name'];
            $loadedItem->price = $row['price'];
            $loadedItem->description = $row['description'];
            $loadedItem->quantity = $row['quantity'];
            $loadedItem->groupId = $row['group_id'];

            return $loadedItem;
        }
        return NULL;
    }

    public static function loadAllItems()
    {

        $result = Items::$conn->query('SELECT * FROM Items');
        $res = [];

        if($result !== false && $result->rowCount()>0){
            foreach($result as $row){
                $loadedItem = new Item();
                $loadedItem->id = $row['id'];
                $loadedItem->name = $row['name'];
                $loadedItem->price = $row['price'];
                $loadedItem->description = $row['description'];
                $loadedItem->quantity = $row['quantity'];
                $loadedItem->groupId = $row['group_id'];

                $res[] = $loadedItem;
            }
            return $res;
        }

        return $res;
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