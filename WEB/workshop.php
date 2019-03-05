<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/workshop-format.css">
    <link rel="stylesheet" type="text/css" href="css/basket_format.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 

</head>

<body>
			<?php

			function myFunction(){
		
      $conn = mysqli_connect("localhost", "root","","emira_pottery");
		

					
					if(isset($_POST['submit'])){
					$date=$_POST['date'];
					$time=$_POST['time'];
					
					
					$sql = "INSERT INTO meeting ( Date, Time) VALUES ('$date','$time')";
					
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

					
	
					<div class="jumbotron" style="margin-bottom:0" >
    					<div class="logo">
      						<h1 >Our Workshop</h1>
    					</div>

					</div>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="home.php">Homepage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="workshop.php">Our Workshop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="basket.php">Basket</a>
      </li> 

    </ul>
  </div>  

</nav>
							   
							
					 <p class="workshop-content" > 

									Our workshop and showroom are located at 13 Mehmet Ali Street near the St. Lazarus church in Lanraka. Our workshop is open to the public and visitors will have the opportunity to watch the artists creating and also to try the magic of clay.
									For the best please book your appointment in advance. </p>
							<br/>
							<p class="details">Workshop Working Hours:</p> 
							
							<p class="date">Monday to Friday: 08:00 – 16:30.</p>
							

							<p class="date">But is open to have a look until 21:00 and Saturday 09:00 – 15:00.</p><br/>
								  
							   <br/>
							     
					
					 <div class="image">
						 
						 <img src="workshop.jpg" alt="Trulli" width="375" height="450">
						 
						 </div>

					<div class="second" style="margin:20px 20px; padding-left: 200px;" >   

		
						 <h4>Please choose the time and date for your lesson:</h4>
						 <div id="theform">

				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    
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

</form>
								

						  <footer class="footer">
        <div class="container" >
                <div class="row">
                    <div class="col-md-4"> 
                        <h1 class="footer-products">OUR PRODUCTS</h1>
                        <br>
                        <div class="p1" >
                         <a href="products.php" > Traditional</a>
                         <br>
                         <a href="products.php" > Ecclesiastical Items</a>
                         <br>
                         <a href="products.php" > Ancient Pottery Replicas</a>
                         <br>
                         <a href="products.php" > Decorative</a>
                         <br>
                         <a href="products.php" > Cyprus Souvenirs</a>
                         <br>
                         <a href="products.php" > Ovenware Pots</a>
                        </div>           
                    </div>
                    <div class="col-md-4"> 
                    <h1 class="footer-products">CONTACT</h1>
                        <br>
                        <div class="p3" >
                            <p>13 Mehmet Ali Street,<br>
                                6029, Larnaca, <br>
                                Cyprus<br>
                                <br>
                                Mob: +357 99404414 <br>
                                Tel: +357 24623952
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4"> 
                    <h1 class="footer-products">SHOWROOM HOURS</h1>
                        <br>
                        <div class="p2" >
                            <p>
                              <b>April - November</b><br>
                              <br>
                              Monday to Friday: 08:00-21:00 <br>
                              Saturday: 09:00 - 15:00<br>
                              <br>
                              <b>December - March</b><br>
                              <br>
                              Monday to Friday: 08:00-19:00 <br>
                              Saturday: 09:00 - 15:00

                            </p>
                        </div>
                        <br>
                        <h1 class="working-hours">WORKSHOP WORKING HOURS</h1>
                       
                        <br>
                        <div class ="p2">
                            <p>Monday to Friday: 08:00-16:30 
                            </p>
                        </div>
                    </div>
                </div>
	</div>
	</div>	
			
</body>
