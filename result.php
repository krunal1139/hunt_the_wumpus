<!DOCTYPE html>
<html>

<head>
    <title>Hunt The Wumpus</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- Name:- Krunal patel
	     Student number :- 000826784
	     Program description:- The below program will get the row and column from the index.php and display that player found the Wampus or does not. --> 
</head>

<body>
    <?php
	include 'connection.php';
    /** Geting row and coloumn from index.php **/
    $row = filter_input(INPUT_GET, "row",FILTER_VALIDATE_INT);
	$column = filter_input(INPUT_GET, "col",FILTER_VALIDATE_INT);
	

	try { 
        //** Select rows and column to define wining and losing columns and rows as per database **// 
		$sql = "SELECT `rows`, `columns` FROM `wumpuses` WHERE `rows` = ? and `columns`= ?";
		$result = $dbh->prepare($sql);
        $params = [$row,$column];
		$success = $result->execute($params);
	} catch(PDOException $e) {
		echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
		exit;
	}
    
    /* 
    Counts the rows
    */

	$number_of_rows = $result->rowCount(); 
    
    /**************** Wining part *******************/

	if($number_of_rows > 0){ ?>
    <div class="win">
        <div id='main_image'>
            <img src="images/icon.jpg">
        </div>
        <div id='output'>
            <p id='message'>
                You found the wumpus!!
            </p>
            <p class="wining">
                <i> Congratulations!!<br /> You Won !!</i>
            </p>
            
            <form action="save.php" method="POST">
                <input type="hidden" name="status" value="1">
                <input type="email" required="" name="email" placeholder="Enter Your Email">
                <input type="submit" id="contBtn" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php  } 
    /**************** Losing part *******************/
    else { ?>
    <div id='card' class="lose">
        <div id='upper-side' class="lose">
            <img src="images/sad.png">
        </div>
        <div id='lower-side'>
            <p id='message'>
                Oh no.
            </p>
            <p class="cong">
                <i>Sorry for Bad luck !! <br /> You Lost !!</i>
            </p>
            <p id='message'>
                I wish you better luck next time 👍
            </p>
    <!-- Geting input of input from user -->
            <form action="save.php" method="POST">
                <input type="hidden" name="status" value="0">
                <input type="email" required="" name="email" placeholder="Enter Your Email">
                <input type="submit" id="contBtn" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php  } ?>
</body>

</html>
