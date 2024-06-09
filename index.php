<?php
    include_once("./connect.php");
    if (isset($_POST["submit"])) {

        $name = mysqli_real_escape_string($db, $_POST["name"]);
        $comment = mysqli_real_escape_string($db, $_POST["comment"]);

        // insert data
        $stmt = $db->prepare("INSERT INTO user (user, comment) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $comment);

        if ($stmt->execute()) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
    }
    $query = mysqli_query($db, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main-container">
        <div class="img">
            <img src="assets/9786020633176_.Atomic_Habit.jpg" alt="Atomic Habits Book Cover">
        </div><br>
    
        <p class="desk">Atomic Habits is a nonfiction book written by James Clear. Released in 2018, it tells the reader how to improve their life by breaking bad habits.</p>
    
        <h2>Publisher's Summary</h2>
        <p class="desk">No matter your goals, Atomic Habits offers a proven framework for improving--every day. James Clear, one of the world's leading experts on habit formation, reveals practical strategies that will teach you exactly how to form good habits, break bad ones, and master the tiny behaviors that lead to remarkable results.</p>
    
        <div class="container">
            <form action="" method="POST">
                <label for="name">Name</label><br>
                <input type="text" name="name" required> <br> <br>
                <label for="comment">Comment</label> <br>
                <textarea name="comment" cols="40" rows="10" required></textarea> <br>
                <input type="submit" name="submit" value="Submit">
            </form>
            <h4>People Review</h4>
            <hr class="form">
            <?php foreach($query as $comment) { ?>
                <div class="comment">
                    <h4><?php echo $comment["user"]; ?></h4>
                    <p><?php echo $comment["comment"]; ?></p>
                </div>
                <?php } ?>
        </div>
    </div>
</body>
</html>
