<!DOCTYPE html>
<html>
    <head>
        <title>News System - Example - Add</title>
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
                $news->add($_POST["title"], $_POST["text"], $_POST["author"]);
                echo "News added";
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        else
        {
            ?>
            <form action="" method="POST">
                <label for="title">Title :</label><br/>
                <input type="text" name="title" id="title"/>
                <br/>
                <label for="text">Text :</label><br/>
                <textarea name="text" id="text"></textarea>
                <br/>
                <label for="author">Author :</label><br/>
                <input type="text" name="author" id="author"/>
                <br/>
                <input type="hidden" name="send" value="1"/>
                <input type="submit" value="submit"/>
            </form>
            <?php
        }        
        ?>
    </body>
</html>