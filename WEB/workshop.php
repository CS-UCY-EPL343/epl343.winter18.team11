<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  
    <title>Page Title</title> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"/>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1"/>

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
 
<style> 
			
          .jumbotron {
            background-image: url("emira-pottery.jpg");
            height: 300px;
            
          }
        
          </style>   

</head>

<body>
			<?php

			function myFunction(){
			$nameErr = $emailErr =  "";
			$name = $email =  $surname= $date= $time="";

					$servername = "localhost";
					$username = "root";
					$password = "";
					
					// Create connection
					$conn = new mysqli($servername, $username, $password);
					
					// Check connection
					if ($conn->connect_error)
					{
						die("Connection failed: " . $conn->connect_error);
						echo "Connection failed";
					} 
					
					if(isset($_POST['submit'])){
					$date=$_POST['date'];
					$time=$_POST['time'];
					
					
					$sql = "INSERT INTO emirapottery.meeting ( Date, UserID, Time) VALUES ('$date', '123','$time')";
					
					//mysqli_query($conn, $sql)
				if (mysqli_query($conn, $sql) === TRUE) 
				{
					echo "";
				} else 
				{
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
						//	mysqli_close($con);
			}
			
		}
			?>

					
					<div class="jumbotron " style="margin-bottom: 0" >        
				  
							<h1 style="color:white;text-align: center;font-family: 'Times New Roman', Times, serif">OUR WORKSHOP</h1>
							<h1 style="font-size: 100px;
							font-family: serif;
							font-style: italic;
							text-align: left;
							color:white;
							padding-bottom: 50%;
							">Emira Pottery</h1>
					  
					</div>

						  <nav class="navbar navbar-inverse">
								<div class="container-fluid"></div>
								  <ul class="nav navbar-nav">
									
									<li><a href="#">HOMEPAGE</a></li>
									<li><a href="#">PRODUCTS</a></li>
									<li><a href="#">OUR WORKSHOP</a></li>
									<li><a href="#">CONTACT</a></li>
								  </ul>
						 </nav>
							   
							
					 <p style="color:gray;margin: 70px 20px 15px 20px;font-size: 135%;font-family: 'Times New Roman', Times, serif "> 

						
						  

									Our workshop and showroom are located at 13 Mehmet Ali Street near the St. Lazarus church in Lanraka. Our workshop is open to the public and visitors will have the opportunity to watch the artists creating and also to try the magic of clay.
									 For the best please book your appointment in advance.<br/>
							<br/>
							<br/>
							Workshop Working Hours: Monday to Friday: 08:00 – 16:30.<br/>
							<br/>

							But is open to have a look until 21:00 and Saturday 09:00 – 15:00.<br/>
								  
							   <br/>
							   <br/>
							   <br/>   
					
					</p>

					<div class="second" style=" margin-top: 0px;
     margin-bottom: 100px;
     margin-right: 150px;
     margin-left: 80px;" >   

		 <div id="info"style="width: 400px; float:right; height:100px; margin-right:100px;">
						 
						 <img src="workshop.jpg" alt="Trulli" width="375" height="450">
						 
						 
						 
						 </div>
						 <h2 style="margin-right=150px; font-size:135%; font-family:'Times New Roman'"><b>Please choose the time and date for your lesson:</b></h2>
						 <div id="theform"style="width: 150px; float:left; height:100px; margin:10px">

	<form style="margin-right=150px; font-size:135%; font-family:'Times New Roman'"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    
						  Date:(required)<br><input type="date" min="2019-02-20" name="date" /><br/>
						  <br/><br/>
                          
							Time:(required)<br><input type="time" name="time"/><br/>
						  <br/><br/>
						  <input type="submit" name="submit" value="Submit"/>  
						   
						 </div>
						 </div>
						 <?php
							myFunction();
						 ?>

						 
						   <div class="clearfix"></div>


								

						   <div class="jumbotron text-center" style="margin-bottom:0px;position:absolute;top:1200px;width:100%;height:350px;background-image: none;background-color: beige;">
							 <footer class="footer">
							 <div class="container" >
							   <div class="row">
								   <div class="col-md-4"> 
									   <h1 class="footer-products"style="font-size:25px">OUR PRODUCTS</h1>
									   <br/>
									   <div class="p1" >
										<a href="products.php" > Traditional</a>
										<br/>
										<a href="products.php" > Ecclesiastical Items</a>
										<br/>
										<a href="products.php" > Ancient Pottery Replicas</a>
										<br/>
										<a href="products.php" > Decorative</a>
										<br/>
										<a href="products.php" > Cyprus Souvenirs</a>
										<br/>
										<a href="products.php" > Ovenware Pots</a>
									   </div>           
								   </div>
								   <div class="col-md-4"> 
								   <h1 class="footer-products"style="font-size:25px">CONTACT</h1>
									   <br/>
									   <div class="p3" >
										   <p style="font-size:15px">13 Mehmet Ali Street,<br/>
											   6029, Larnaca, <br/>
											   Cyprus<br/>
											   <br/>
											   Mob: +357 99404414 <br/>
											   Tel: +357 24623952
										   </p>
									   </div>
								   </div>


								   <div class="col-md-4"> 
								   <h1 class="footer-products"style="font-size:25px">SHOWROOM HOURS</h1>
									  
									   <div class="p2" >
										   <p style="font-size:15px">
											 <b>April - November</b><br/>
											 
											 Monday to Friday: 08:00-21:00 <br/>
											 Saturday: 09:00 - 15:00<br/>
											 
											 <b>December - March</b><br/>
											 
											 Monday to Friday: 08:00-19:00 <br/>
											 Saturday: 09:00 - 15:00

										   </p>
									   </div>
									 
									   <h1 class="working-hours"style="font-size:15px"><b>WORKSHOP WORKING HOURS</b></h1>

									   <div class ="p2">
										   <p style="font-size:15px">Monday to Friday: 08:00-16:30 
										   </p>
									   </div>
								   </div>
							   
						</div>
						</div>
						</footer>
						</div>
			
			</form>
</body>
