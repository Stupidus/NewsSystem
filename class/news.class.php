<?php
/**
 * Description of News
 *
 * @author Victor ANTOINE
 */
class News {
    private $id;
    private $title;
    private $text;
    private $author;
    private $date;
    
    private $db;
    
    public function  __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            switch($key)
            {
                case 'id':
                    $this->$key = (int) $value;
                    break;               
                case 'title':
                case 'text':
                case 'author':
                    $this->$key = (string) $value;
                    break;
                case 'date':
                    $this->$key = $value;
                    break;
                default:
                    break;
            }
        }
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
    }
    
    public function getNews($id)
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
    }
}

?>
