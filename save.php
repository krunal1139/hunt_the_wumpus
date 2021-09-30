<!DOCTYPE html>
<html>

<head>
	<title>Hunt The Wumpus</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php
    /** isset will check whether email is inserted or not **/
	if(isset($_POST) && isset($_POST['email']) && $_POST['email']!='' ){
        
        
        /** Include the database connection **/
		include 'connection.php';
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$status = filter_input(INPUT_POST, "status", FILTER_VALIDATE_INT);
        
        $info = array[$email,$status];
        
        /** Setting the number of game lose and win **/

		if($status == 0){
			$wins = 0;
			$losses = 1;
		} else {
			$wins = 1;
			$losses = 0;
		}
        
        /**
        The select statment is used to select the email of the player.
        **/
		try { 
			$sql = "SELECT `email`,`wins`,`losses` FROM `players` WHERE `email` = ?";
			$result = $dbh->prepare($sql);
            $success = $result->execute([$email]);
		} catch(PDOException $e) {
			echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
			exit;
		}
		$number_of_rows = $result->rowCount(); 
        
        
        
		if($number_of_rows == 0){ 
			try { 
                /**
                Insert will help to insert the new record of email, number of wins and lose and the last played date of the player
                **/
				$sql = "INSERT INTO players (email, wins, losses,last_played_date)  VALUES (?,?,?,'".date('Y-m-d')."')";
				$result = $dbh->prepare($sql);
                $params = [$info[0],$wins,$losses];
				$success = $result->execute($params);
			}
            /** This part will show error message if there is some problem while inserting the data **/
            catch(PDOException $e) {
				echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
				exit;
			}
		} else {
			$row = $result->fetch();
			$wins = $row['wins'] + $wins;
			$losses = $row['losses'] + $losses;
			try { 
                /**
                The update will help to update the record of players wining and losing games as well as the email if it already exist in the databse
                **/
				$sql = "UPDATE players SET wins=?,losses=? WHERE `email`=?";
				$result = $dbh->prepare($sql);
                $params = [$wins,$losses,$info[0]];
				$success = $result->execute($params);
			} catch(PDOException $e) {
				echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
				exit;
			}

		} 
		try { 
			$sql = "SELECT `email`,`wins`,`losses` FROM `players` WHERE `email` =?";
			$result = $dbh->prepare($sql);
            $result->execute([$info[0]]);
		} catch(PDOException $e) {
			echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
			exit;
		}
		$row = $result->fetch();
		?> 

		<p class="text-right">Your Wins : <?php echo $row['wins']; ?></p>
		<p class="text-right">Your Losses : <?php echo $row['losses']; ?></p>
		<p class="text-center">Your Score has been recorded </p>

		<?php
		try { 
            /** Selecting top 10 players in desending order who wins the game **/
			$sql = "SELECT `email`,`wins`,`losses`,`last_played_date` FROM `players` WHERE `wins`!=0 ORDER BY `wins` DESC LIMIT 0,10";
			$result = $dbh->prepare($sql);
			$result->execute();
		} catch(PDOException $e) {
			echo "<p class='err_msg'>Error: " . $e->getMessage()."<p>";
			exit;
		}
		$rows = $result->fetchAll();

		?>

		
            
			<table border="1" align="center" cellpadding="10" cellspacing="10">
				<tr>
					<th>Rank</th>
					<th>Email</th>
					<th>Wins</th>
					<th>Losses</th>
					<th>Date</th>
				</tr>
				<?php if(!empty($rows)){ ?>
			<h1 class="text-center"> Highest scores</h1>
			<?php $i=1; foreach ($rows as $row) { 
            $mail = $row['email'];
            $win = $row['wins'];
            $rows = $row['losses'];
            $date = $row['last_played_date'];
            ?>
				
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $mail?></td>
						<td><?php echo $win?></td>
						<td><?php echo $rows?></td>
						<td><?php echo $date?></td>
					</tr>
					<?php $i++; }  ?>
				</table>
			<?php }  else 
          { ?>
			<?php } ?>
			<div class="text-center">
				<a href="index.php"   id="contBtn">Play Again</a>
			</div>
		<?php } else {   
			echo '<p class="err_msg">Something Went Wrong, Please Try again.</p>';
		}
		?>
	</body>

	</html>
