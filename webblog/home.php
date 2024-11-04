<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>WebBlog - Home</title>
        <link rel="icon" type="image/x-icon" href="src/img/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="src/css/font.css">
        <link rel="stylesheet" href="src/css/style.css">
        <link rel="stylesheet" href="src/css/home.css">
        <script src="src/js/script.js"></script>
    </head>
    <body>
        <header>
            <a href="login.php"><img class="home-logo" src="src/img/logo2.png" width="150" alt="WebBlog"></a>
        </header>
        <?php
        $conn = new mysqli("localhost", "root", "", "webblogdb");
        if ($conn->connect_error) {
            die("connect error: " . $conn->connect_error);
        }
        $sql = file_get_contents('src/sql/home-post.sql');
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($data = $result->fetch_assoc()) {
                echo "<article>";
                echo "<h1>" . htmlspecialchars($data["post_title"]) . "</h1>";
                echo "<div class='post-info'>Written by <a class='post-author'>" . htmlspecialchars($data["user_name"]) . "</a> | <span class='post-date'>" . htmlspecialchars($data["post_date"]) . "</span></div>";
                echo "<div class='post-content'>";
                echo "<p>" . htmlspecialchars($data["post_content"]) . "</p>";
                echo "</div>";
                echo "<div class='post-reactions'>";
                echo "<span class='post-reactions-container'>";
                echo "<span class='like-icon'></span><span class='like-count'>" . $data["like_count"] . "</span>";
                echo "</span>";
                echo "</div>";
                echo "</article>";
            }
        } else {
            echo "There are no posts to display.";
        }
        $conn->close();
        ?>
    </body>
</html>