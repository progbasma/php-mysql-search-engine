<?php

$err=" ";
?>




<?php 

    
   /* if($_SERVER['REQUEST_METHOD']=='GET')
    {
        
        echo"welcome";
        
    }*/
	if(isset($_GET['search'])){
		
		
	$get_value = $_GET['user_query'];
	
	if($get_value==''){
	
	echo "<center><b>Please go back, and write something in the search box!</b></center>";
	exit();
	}
	
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "srch";

      try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
          $stmt = $conn->prepare("select * from sites where site_keywords LIKE :user_query");
			$user_query=$_GET['user_query'];
			$user_query = "%$user_query%";
		  $stmt->bindParam(':user_query', $user_query);
					 
					  
					  
         $res=$stmt->execute(); 
		 
	  
	 	  if ($res) {
		$alldata = $stmt->fetchAll();
		
		/* Check the number of rows that match the SELECT statement */
		if (count($alldata) > 0) {
			foreach ($alldata as $row) {
				$site_title=$row['site_title'];
				$site_link=$row['site_link'];
				$site_desc=$row['site_desc'];
				$site_image=$row['site_image'];
                
                
                
                
                
				echo "<div class='results'>
				
				<h2>$site_title</h2>
				<a href='$site_link' target='_blank'>$site_link</a>
				<p align='justify'>$site_desc</p> 
				<img src='images/$site_image' width='100' height='100' />
				
				</div>";
		
	
	
	
			 }
		   }
		  
		
		/* No rows matched -- do something else */
	  else {
		   echo "<center><b>Oops! sorry, nothing was found in the database!</b></center>";
		 exit();
		}
		  }
	
	
      
        
     
          

          
          }
      catch(PDOException $e)
          {
          $err= "error in db";
          }

      $conn = null;
     
	
	}



?>




<!DOCTYPE html> 
<html> 
	<head> 
		<title>Result page</title> 
		
<style type="text/css">
.results {margin-left:12%; margin-right:12%; margin-top:10px;}
</style>
	</head> 
	
	
<body bgcolor="#F5DEB3"> 

<form action="result.php" method="get"> 
		
		<span><b>Write your Keyword:</b></span>
		
		<input type="text" name="user_query" size="120"/> 
		<input type="submit" name="search" value="Search Now">
</form>
	
	<a href="search.html"><button>Go Back</button></a>
    <h2 style="color:red"><?php echo $err;?></h2>
	


</body> 
</html>