<!DOCTYPE html>
<html>
    <head>
        <title>News System - Example - GetAll</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        include '../class/connection.class.php';
        include '../class/news.class.php';
        $connection = new Connection('localhost', 'news', 'root', '');        
        $news = new News($connection->getDb());
        $news->setNewsByPage(20);
        if(isset($_GET['page']) && !empty($_GET['page']))
            $page = $_GET['page'];
        else 
            $page = null;
        echo "<pre>";
        try {
            foreach($news->getAll($page) as $newsData)
            {
                print_r($newsData);
            }            
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        echo "</pre>";
        echo $news->paginationLinks();
        ?>        
    </body>
</html>