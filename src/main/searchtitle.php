<!DOCTYPE html>
<?php
	$db = mysqli_connect('localhost', 'username', 'password','library_management');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>QUERIES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style media="screen">
			    * {
  				    border-radius: 0 !important;
				}

				* {
					-webkit-border-radius: 0 !important;
     			    -moz-border-radius: 0 !important;
                    border-radius: 0 !important;
				}
                button:hover {
                    opacity: 0.8;
                    transition: 0.3s ease;
                }
				html {
                    overflow-x: hidden;
                }
		</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a class="navbar-brand" href="homepage.php"> Library Management System </a>
			</div>
		</div>
		<ul class="nav navbar-nav">
            <li><a href="homepage.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="addbook.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</a></li>
            <li><a href="issuebook.php"><span class="glyphicon glyphicon-book"></span> Issue Book</a></li>
            <li><a href="returnbook.php"><span class="glyphicon glyphicon-retweet"></span> Return Book</a></li>
	        <li class="dropdown active">
        		<a class="dropdown-toggle" data-toggle="dropdown">Search
        		<span class="caret"></span></a>
        		<ul class="dropdown-menu">
          			<li><a href="searchtitle.php">By Title</a></li>
          			<li><a href="searchstudent.php">By student</a></li>
          			<li><a href="searchauthor.php">By authors</a></li>
        		</ul>
    		</li>
        </ul>
		<ul class="nav navbar-nav navbar-right" style="padding-right:15px">
            <li><a href="signin.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
	</nav>
	<div class="col-sm-6">
        <h2>Search for titles - </h2><br><br>
        <form class="horizontal" action="searchtitle.php" method="POST">
        	<label class="control-label col-sm-2">Book Title:</label>
        	<div class="col-sm-4">
            	<input type="text" class="form-control" id="t_name" name="t_name" placeholder="Enter book title">
			</div><br><br><br>
			<div class="form-group">
            	<div class="col-sm-offset-5 col-sm-10">
                	<button type="submit" class="btn btn-default" style="background-color:black; color:white;" name="go">Go</button>
            	</div>
			</div>
		</form>
	</div>
	<div class="col-sm-6" style="padding-top:30px;">
		<?php
			if(isset($_POST['go'])) {
				$title_name = $_POST['t_name'];
				$serach_query = "SELECT A.NAME, T.QUANTITY, P.P_ID, P.P_NAME, T.EDITION, T.PRICE FROM title as T, author AS A, publisher AS P WHERE T.T_NAME = '$title_name' AND T.ISBN = A.ISBN AND T.P_ID = P.P_ID";
				$result = mysqli_query($db, $serach_query);

				echo "<table class='table-responsive table-striped active' style='margin:auto;font-size:20px;'>
				<tr>
				<th style='padding: 10px;'>Author Name</th>
				<th style='padding: 10px;'>Quantity</th>
				<th style='padding: 10px;'>Publisher ID</th>
				<th style='padding: 10px;'>Publisher Name</th>
				<th style='padding: 10px;'>Edition</th>
				<th style='padding: 10px;'>Price</th>
				</tr>";

				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td style='padding: 10px;'>" . $row['NAME'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['QUANTITY'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['P_ID'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['P_NAME'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['EDITION'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['PRICE'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";

			}
		?>
	</div>
</body>
</html>