<?php
/**
 * Description of News
 *
 * @author Victor ANTOINE
 */
class News {
    private $db;
    
    public function  __construct(PDO $db)
    {
        $this->db = $db;
    }        
    
    public function add($title, $text, $author)
    {
        $q = $this->db->prepare("INSERT INTO news (title, text, author, date) VALUES (:title, :text, :author, CURDATE())");
        $q->bindValue(":title", $title);
        $q->bindValue(":text", $text);
        $q->bindValue(":author", $author);
        if(!$q->execute())
        {
            $errors = $q->errorInfo();
            throw new Exception("Error while adding a news (".$errors[2].").");
        }
        $q->closeCursor();
    }
    
    public function get($id)
    {
        $q = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $q->bindValue(":id", $id, PDO::PARAM_INT);
        if(!$q->execute())
        {
            $errors = $q->errorInfo();
            throw new Exception("Error while getting a news (".$errors[2].").");
        }
        if($res = $q->fetch(PDO::FETCH_ASSOC))
            return $res;
        else
            throw new Exception("No match for id(".$id.").");
        $q->closeCursor();
    }
    
    public function delete($id)
    {
        $q = $this->db->prepare('DELETE FROM news WHERE id = :id');
        $q->bindValue(':id', $id);
        if(!$q->execute())
        {
            $errors = $q->errorInfo();
            throw new Exception("Error while deleting a news (id:".$id.") (".$errors[2].").");
        }
        $q->closeCursor();
    }
    
    public function update($id, $title, $text, $author)
    {
        $q = $this->db->prepare("UPDATE news SET title = :title, text = :text, author = :author WHERE id = :id");
        $q->bindValue(":title", $title);
        $q->bindValue(":text", $text);
        $q->bindValue(":author", $author);
        $q->bindValue(":id", $id, PDO::PARAM_INT);
        if(!$q->execute())
        {
            $errors = $q->errorInfo();
            throw new Exception("Error while updating a news (id:".$id.") (".$errors[2].").");
        }
        $q->closeCursor();
    }
}

?>
