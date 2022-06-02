<?php

class Post {
    private $filename;
    private $title;
    private $description;
    private $image1;
    private $image2;

    /**
     * Get the value of filename
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */ 
    public function setImage1($image1)
    {
        $this->image1 = $image1;

        return $this;
    }
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */ 
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of tags
     */ 
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */ 
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    //uploaden van post
    public function addPost() {
        //het pad om de geuploade afbeelding in op te slagen
        // $target = "image/" . basename($_FILES["uploadfile"]["name"]);
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "images/".date('YmdHis')."_".$filename; //.date('YmdHis')."_"

        $filename1 = $_FILES["uploadfile1"]["name"];
        $tempname1 = $_FILES["uploadfile1"]["tmp_name"];	
		$folder1 = "images/".date('YmdHis')."_".$filename1; //.date('YmdHis')."_"

        $filename2 = $_FILES["uploadfile2"]["name"];
        $tempname2 = $_FILES["uploadfile2"]["tmp_name"];	
		$folder2 = "images/".date('YmdHis')."_".$filename2; //.date('YmdHis')."_"


        //het type bestand uitlezen zodat we later non-images kunnen tegenhouden
        $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
        $imageFileType1 = strtolower(pathinfo($folder1,PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($folder2,PATHINFO_EXTENSION));


        //connectie naar db
        $conn = DB::getInstance();

        //alle data ophalen uit het ingestuurde formulier
        $filename = $this->getFilename();
        $title = $this->getTitle();
        $description = $this->getDescription();
        //$tags = $this->getTags();

        if(!empty($imageFileType)){
            if($imageFileType === "jpg" || $imageFileType === "jpeg" || $imageFileType === "png") {
                $filename = $_FILES["uploadfile"]["name"];
            } else {
                throw new Exception("Please choose a valid png, jpg or jpeg file");
            }
        } else {
            throw new Exception("The image cannot be empty");
        }

        //opgehaalde data opslagen in databank
        $statement = $conn->prepare("insert into `message` (thumbnail, title, description, username,afbeelding2, afbeelding3) VALUES (:thumbnail, :title, :description, :username, :afbeelding2, :afbeelding3)");
        $statement->bindValue(":thumbnail",$folder);
        $statement->bindValue(":title",$title);
        $statement->bindValue(":description",$description);
        //$statement->bindValue(":tags",$tags);
        $statement->bindValue(":username", "Jeffrey");
        $statement->bindValue(":afbeelding2", $folder1);
        $statement->bindValue(":afbeelding3", $folder2);
        //var_dump($_SESSION['name']);
        $statement->execute();

        //geuploade afbeelding in de images folder zetten
		if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
	    }
        if (move_uploaded_file($tempname1, $folder1)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
	    }
        if (move_uploaded_file($tempname2, $folder2)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
	    }

                
        if ($imageFileType === "jpg" || $imageFileType === "jpeg") {
            $image = imagecreatefromjpeg($folder);
        } else {
            $image = imagecreatefrompng($folder);
        }
        if ($imageFileType1 === "jpg" || $imageFileType1 === "jpeg") {
            $image = imagecreatefromjpeg($folder1);
        } else {
            $image = imagecreatefrompng($folder1);
        }
        if ($imageFileType2 === "jpg" || $imageFileType2 === "jpeg") {
            $image2 = imagecreatefromjpeg($folder2);
        } else {
            $image2 = imagecreatefrompng($folder2);
        }
                
                
        imagejpeg($image, $folder, 60);


                
        //de gebruiker terug naar de feed sturen
        header("location: community.php");
        
    }
   
}