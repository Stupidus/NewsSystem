<!DOCTYPE html>
<html>
    <head>
        <title>News System - Example - Delete</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        include '../class/connection.class.php';
        include '../class/news.class.php';
        $connection = new Connection('localhost', 'news', 'root', '');        
        $news = new News($connection->getDb());               
        try {
            $news->delete(1);
            echo "News deleted";
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        ?>
    </body>
</html>