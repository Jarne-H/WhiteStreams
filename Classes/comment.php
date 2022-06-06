<?php 

class comment {
    //postId nodig
    //username
    //text

    private $comment;
    private $username;
    private $postId;

    public function getComment()
    {
    return $this->comment;
    }
    
    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
    $this->comment = $comment;
        
    return $this;
    }

    public function getUsername()
    {
    return $this->username;
    }
    
    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
    $this->username = $username;
        
    return $this;
    }

    public function getPostId()
    {
    return $this->postId;
    }
    
    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setPostId($postId)
    {
    $this->postId = $postId;
        
    return $this;
    }

    //Save comment

    public function saveComment() {

        $username = $this->getUsername();
        $comment = $this->getComment();
        $postId = $this->getPostId();

$conn = DB::getInstance();
$statement = $conn->prepare("insert into comments (comment, postDate, username, postId) values (:comment, Now(),:username, :postId)");
$statement->bindValue(":comment", $comment);
$statement->bindValue(":username",$username);
$statement->bindValue(":postId",$postId);

$statement->execute();



    }

    public static function showComment($postId) {
        $conn = DB::getInstance();
        //$postId = $this->getPostId();

        //$statement = $conn->prepare("select * from comment where postId = :postId");
        $statement = $conn->prepare("select * FROM comments WHERE postId = :postId"); 

        $statement->bindValue(":postId", $postId);
        $statement->execute();

        var_dump($postId);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;







    }








}