<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web Careers</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<button class="navbar-toggler" type="button" data-toggle="collapse" 
				data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mx-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#"></a>
				</li>
				<li class="nav-item active">
<!--HEADER STARTS-->
<?php
	require "header.php";
	require "dbh.inc.php";
?>
<!--HEADER ENDS-->
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="row jumbotron">
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
		<p class="lead">
	
<!--PHPBODY STARTS-->                  
<main>
  <h1>Current application</h1><br>
  <div >
    <?php
    $sql = "SELECT * FROM mxc353_1.job WHERE employer_eID=? AND user_uID=-1";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: employerProfile.php?error=sqlerror");
      exit();
    }
    else{
      $jobArray = array(); //to record the jobs this employer posted for next foreacH loop
      mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while($row = mysqli_fetch_assoc($result)){
					$jobTemp=array($row['name'],$row['date'],$row['accept']);
          $jobArray[$row['jID']] = $jobTemp;
      }
      //print_r($jobArray); //test EvLoop
      echo '<h2>The job you posted </h2>';
      foreach ($jobArray as $jID => $jobTemp) {
	      echo '<h3>Job Title:'.$jobTemp[0].' | Date Posted:'.$jobTemp[1].' | Number Of Needed Employees:'.$jobTemp[2].'</h3>';
				echo '<h3>new applicants:</h3>';
        $sql = "SELECT *
        FROM mxc353_1.job,mxc353_1.user
        WHERE job.user_uID=user.uID AND jID=".$jID." AND uID != -1 AND accept=0 AND employer_eID=".$_SESSION['employerID'];

        $result=mysqli_query($conn,$sql);
        $resultCheck=mysqli_num_rows($result);
        if($resultCheck>0){
          while($row=mysqli_fetch_assoc($result)){
            echo $row['email']."<br>";
          }
        }
				else echo "Empty"."<br>";

				echo '<h3>applicants received offer:</h3>';
				$sql = "SELECT *
				FROM mxc353_1.job,mxc353_1.user
				WHERE job.user_uID=user.uID AND jID=".$jID." AND uID != -1 AND accept>0 AND employer_eID=".$_SESSION['employerID'];

				$result=mysqli_query($conn,$sql);
				$resultCheck=mysqli_num_rows($result);
				if($resultCheck>0){
					while($row=mysqli_fetch_assoc($result)){
						echo $row['email'];
						if($row['accept']==1) echo ' (waiting)';
						else if($row['accept']==2) echo ' (accepted)';
						else if($row['accept']==3) echo ' (denied)';
						echo "<br>";
					}
				}
				else echo "Empty"."<br>";


      }


    }
     ?>

  </div>
</main>
<!--PHPBODY ENDS-->
		</p>
	</div>
</div>



<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-12">
		<?php
	require "footer.php"
?>
	</div>
</div>
</div>	
</footer>



</body>
</html>
