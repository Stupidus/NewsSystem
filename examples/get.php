<!DOCTYPE html>
<html>
    <head>
        <title>News System - Example - Get</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        include '../class/connection.class.php';
        include '../class/news.class.php';
        $connection = new Connection('localhost', 'news', 'root', '');        
        $news = new News($connection->getDb());               
        ?>
        <pre>
            <?php 
            try {
                print_r($news->getNews(2)); 
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            ?>
        </pre>
    </body>
</html>