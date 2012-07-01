<!DOCTYPE html>
<html>
    <head>
        <title>News System - Example - Update</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        include '../class/connection.class.php';
        include '../class/news.class.php';
        $connection = new Connection('localhost', 'news', 'root', '');        
        $news = new News($connection->getDb());
        if(isset($_POST['send']))
        {
            try {
                $news->update($_POST['id'], $_POST["title"], $_POST["text"], $_POST["author"]);
                echo "News ".$_POST['id']." updated";
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        else
        {
            $newsData = $news->get(4);
            ?>
            <form action="" method="POST">
                <label for="title">Title :</label><br/>
                <input type="text" name="title" id="title" value="<?php echo $newsData['title']; ?>"/>
                <br/>
                <label for="text">Text :</label><br/>
                <textarea name="text" id="text"><?php echo $newsData['text']; ?></textarea>
                <br/>
                <label for="author">Author :</label><br/>
                <input type="text" name="author" id="author" value="<?php echo $newsData['author']; ?>"/>
                <br/>
                <input type="hidden" name="send" value="1"/>
                <input type="hidden" name="id" value="4"/>
                <input type="submit" value="submit"/>
            </form>
            <?php
        }        
        ?>
    </body>
</html>