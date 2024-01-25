<?php
include_once('pdo-connect.php');
var_dump($pdo);
session_start();

$UserID = $_SESSION["UserID"];
$RecipeID = $_GET["RecipeID"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recipe-page-styles.css">
    <link rel="stylesheet" href="colors.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js>](<https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js>)">
    </script>
    <script>

// how tf make it change in the database, ajax shit?
    $(document).ready(function(){
      $('#saveButton').click(function(){
        if ((this).attr("src") == "/recipe-images/unsaved.png") {
            $(this).attr("src", "/recipe-images/saved.png");
        } else {
            $(this).attr("src", "/recipe-images/unsaved.png")
        }
      });
    });
  </script>
</head>

<body>
    <header>
        <div class="logoCombo">
            <img src="/pictures/avosave_logo-removebg-preview.png" class="logo">
            <img src="/pictures/Logo-PhotoRoom(3).png" class="logo">
        </div>
        <nav class="navbar">
            <ul id="pageNav">
                <li class="pageTraversal" id="home"><a href="#">Home</a></li>
                <li class="pageTraversal" id="search"><a href="#">Search</a></li>
            </ul>
            <ul id="accountNav">
                <li class="pageTraversal" id="login"><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-page">
        <div class="column1">
            <div class="back-title-grid">
                <a id="back-button" href="javascript:window. history. back();">
                    <img class=button src="/recipe-images/back-arrow.png" alt="&lt back">
                </a>
                <div class="title-bar"> <!--get title from database-->
                    <h1>
                        <?php
                        global $pdo, $RecipeID;
                        $result = $pdo -> query("SELECT Title FROM Recipe WHERE RecipeID = $RecipeID");
                        $title = $result->fetch_assoc();
                        echo $title;
                        ?>
                    </h1>
                </div>
            </div>
            <div class="side-block"> <!--get description from database-->
                <h2>Description</h2>
                <?php
                    global $pdo, $RecipeID;
                    $result = $pdo -> query("SELECT R.Description FROM Recipe R WHERE RecipeID = $RecipeID");
                    $description = $result->fetch_assoc();
                    echo $description?>
            </div>
        </div>
        <div class="column2">
            <div>
                <!-- get pictureURL from database, alt=title-->
                <?php
                    global $pdo, $RecipeID;
                    $imgResult = $pdo -> query("SELECT ImageURL FROM Image WHERE Image.RecipeID = $RecipeID");
                    $titleResult = $pdo -> query("SELECT Title FROM Recipe WHERE RecipeID = $RecipeID");
                    $image = $imgResult->fetch_assoc();
                    $title = $titleResult->fetch_assoc();
                    echo "<img class='title-image' src='".$image."' alt='Picture of ".$title."'>"
                    ?>
            </div>
            <div class="recipe-card recipe-grid">
                <div class="column1">
                    <h2>Recipe card</h2>
                    <!--get prep time and servings from database-->
                    <?php global $pdo, $RecipeID;
                    $timeRes = $pdo -> query("SELECT Time FROM Recipe WHERE RecipeID = $RecipeID");
                    $servRes = $pdo -> query("SELECT Servings FROM Recipe WHERE RecipeID = $RecipeID");
                    $time = $timeRes->fetch_assoc();
                    $servings = $servRes->fetch_assoc();
                    echo "<p>Preparation time: ".$time." mins, servings: ".$servings."</p>";
                    ?>
                    <h3>Ingredients</h3>
                    <ul> <!--get amount ingredient, amount ingredient, etc, etc from database-->
                    <?php global $pdo, $RecipeID;
                    $ingredients = $pdo -> query("SELECT IngredientName, Amount FROM RecipeIngredient WHERE RecipeID = $RecipeID");

                    if ($ingredients -> num_rows > 0) {
                        while($id = $ingredients -> fetch_assoc()) {
                            $amount = $id["Amount"];
                            $name = $id["IngredientName"];
                            echo "<li>".$amount." ".$name."</li>";
                        }
                    }
                    ?>
                    </ul>
                    <ol> <!--get steps from database, line break=next li?-->
                        <li>Set the oven to 200 degrees celcius.</li>
                        <li>Cut the apples.</li>
                        <li>Whatever the next step is in baking an apple pie. Something with the flour I think. Doesn't
                            really
                            matter all that much, just trying to make this item long.</li>
                    </ol>
                </div>
                <div class="column2">
                    <button id="saveButton" title="Add to favourites"> <!--button changes png, and saved status, check login!-->
                        <?php
                        global $pdo, $RecipeID, $UserID;
                        $status = $pdo->query("SELECT SavedStatus FROM UserRecipe WHERE UserRecipe.UserID = $UserID AND WHERE UserRecipe.RecipeID = $RecipeID");
                        $stat = $status->fetch_assoc();
                        if ($status = 1) {
                            $image = "/recipe-images/saved.png";
                        } else {
                            $image = "/recipe-images/unsaved.png";
                        }
                        echo "<img id='favourite-button' src=$image alt='&lt;3'>";
                        ?>
                </button>
                </div>
            </div>
        </div>
    </div>
    <div class="comment-section">
        <h2>Comment section</h2>
        <div class="new-comment">
            <form method="post" action="place-comment.php">
                <label>New comment:</label>
                <br>
                <textarea maxlength='1024' id="commentinput" placeholder="Write your comment..."></textarea>
                <div id="the-count">
                    <span id="current">0</span>
                    <span id="maximum">/ 1024</span>
                </div>
                <script type="text/javascript">
                    var textArea = $("#commentinput");
                    var userText = trim(textArea.val());
                    var charCount = userText.length;
                    var countDisp = $("#current");
                    countDisp.text("${charCount}");
                </script>
                <br>
                <input type="submit" value="Post">
            </form>
        </div>
        <?php
        global $pdo, $RecipeID;
        $comments = $pdo -> query("SELECT CommentID, CreatedAt, CommentText, UserID FROM Comment WHERE RecipeID = $RecipeID ORDER BY CreatedAt DESC");

        if ($comments -> num_rows > 0) {
            while($id = $comments -> fetch_assoc()) {
                $commenterid = $id["UserID"];
                $result = $pdo -> query("SELECT Username FROM User WHERE User.UserID = $commenterid");
                $commenter = $result->fetch_assoc();
                echo "<div class='comment'>";
                echo "<p class='comment-info'>" . $commenter. " commented on " . $id["CreatedAt"]."</p>";
                echo "<p class='comment-text'>".$id["CommentText"]."</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>