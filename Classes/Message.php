<?php
class Message
{
    private $userId;
    private $text;
    private $postId;

    public function getPostId() {
        return $this->postId;
    }
    public function setPostId($postId) {
        $this->postId = $postId;
        return $this;
    }
	

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public static function getAll(){
        $conn = Db::getInstance();
        $result = $conn->query("select * from message order by id asc");

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function Save(){

        $userId = $this->getUserId();
        $text = $this->getText();
        $postId = $this->getPostId();


        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into message (text, userId, postId) values (:text, :userId, :postId)");
        $statement->bindValue(":userId",$userId );
        $statement->bindValue(":text", $text);
        $statement->bindValue(":postId",$postId );

        return $statement->execute();        
    }
}

?>