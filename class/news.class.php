<?php
/**
 * Description of News
 *
 * @author Victor ANTOINE
 */
class News {
    private $db;
    
    private $newsByPage = 20;
    
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
        else
        {
            if($res = $q->fetch(PDO::FETCH_ASSOC))
                return $res;
            else
                throw new Exception("No match for id(".$id.").");
        }
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
    
    public function getAll($page = 1)
    {
        if($page < 1) $page = 1;
        $q = $this->db->prepare('SELECT * FROM news ORDER BY id DESC LIMIT :start, :newsByPage ');
        $q->bindValue(':start', ($page - 1) * $this->newsByPage, PDO::PARAM_INT);
        $q->bindValue(':newsByPage', $this->newsByPage, PDO::PARAM_INT);
        if(!$q->execute())
        {
            $errors = $q->errorInfo();
            throw new Exception("Error while getting a news's page(".$errors[2].").");
        }
        else
        {
            if($res = $q->fetchAll(PDO::FETCH_ASSOC))
                return $res;
            else
                throw new Exception("No match for page(".$page.").");
        }
        $q->closeCursor();
    }
    
    public function paginationLinks()
    {
        $outputString = "";
        $q = $this->db->query('SELECT COUNT(*) FROM news');
        $res = $q->fetch();        
        $newsNumber = $res[0];
        $q->closeCursor();
        for($i = 1; $i <= ceil($newsNumber / $this->newsByPage); $i++)
        {
            $outputString .= "<a href='?page=".$i."'>".$i."</a> ";
        }
        return $outputString;
    }
    
    public function setNewsByPage($newsByPage)
    {
        $this->newsByPage = $newsByPage;
    }
    
    public function getNewsByPage()
    {
        return $this->newsByPage;
    }
}

?>
