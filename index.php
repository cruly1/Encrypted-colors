<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/classified.jpg">
    <link rel="stylesheet" href="styles.css">
    <title>Classified Colors</title>
</head>
<body>
    <div>
        <form action="index.php" method="post">
            <label><h1>Username</h1></label><br>
            <input type="text" name="username"><br>
            <label><h1>Password</h1></label><br>
            <input type="password" name="password"><br>
            <input type="submit" name="login" value="Login" class="login"><br>
        </form>
    </div>
    <?php
        include("database.php");
        include("decode.php");
        include("colors.php");

        echo "<div class='scrpt'>";
        if (isset($_POST["login"])) {
            
            if (!empty($_POST["username"]) && !empty($_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                if (array_key_exists($username, $passwords)) {
                    
                    if ($passwords[$username] == $password) {
                        echo "Login successful. <br>";
                        $sql = "SELECT * FROM tabla WHERE username = '{$username}'";
                        $result = mysqli_query($conn, $sql);
                        $secret = mysqli_fetch_assoc($result)["titkos"];
                        $color = getSecretColor($secret);
                    } else {
                        echo "Error: Incorrect password.";
                        echo("<script>setTimeout(function(){location.href='https://www.police.hu/'} , 3000);</script>");
                    }
                } else {
                    echo "Error: No such username {$username}.";
                }
            } else {
                echo "Error: Missing username or password. <br>";
            }
        }
        echo "</div>";

        mysqli_close($conn);
    ?>
    <style>
        body {
            background-color: <?php echo $color; ?>;
        }
    </style>
</body>
</html>
