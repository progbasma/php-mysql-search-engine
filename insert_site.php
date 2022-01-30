<!DOCTYPE html> 
<html> 
	<head>
		<title>Search Engine in PHP</title> 
	</head>
	
<body bgcolor="gray">
	
	<form action="insert_site.php" method="post" enctype="multipart/form-data"> 
		
		<table bgcolor="orange" width="500" border="2" cellspacing="2" align="center">
			
			<tr>
				<td colspan="5" align="center"><h2>Inserting new website:</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Site Title:</b></td>
				<td><input type="text" name="site_title" /></td>
			</tr>
			
			<tr>
				<td align="right"><b>Site Link:</b></td>
				<td><input type="text" name="site_link" /></td>
			</tr>
			
			<tr>
				<td align="right"><b>Site Keywords:</b></td>
				<td><input type="text" name="site_keywords" /></td>
			</tr>
			
			<tr>
				<td align="right"><b>Site Description:</b></td>
				<td><textarea cols="18" rows="8" name="site_desc"></textarea></td>
			</tr>
			
			<tr>
				<td align="right"><b>Site Image:</b></td>
				<td><input type="file" name="site_image" /></td>
			</tr>
			
			<tr>
				<td align="center" colspan="5"><input type="submit" name="submit" value="Add Site Now"/></td>
			</tr>

		
		
		</table>
	
	
	</form>

</body>
</html>


<?php 



	
	
	if(isset($_POST['submit']))
	
	{
		
		
			  $servername = "localhost";
			  $username = "root";
			  $password = "";
			  $dbname = "search";

			  try {
				  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				  // set the PDO error mode to exception
				  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					// prepare sql and bind parameters
					
					
	
				 $site_title = $_POST['site_title'];
				 $site_link = $_POST['site_link'];
				 $site_keywords = $_POST['site_keywords'];
				 $site_desc = $_POST['site_desc'];
				 $site_image = $_FILES['site_image']['name'];
				 $site_image_tmp = $_FILES['site_image']['tmp_name'];
	
		
				if($site_title=='' OR $site_link=='' OR $site_keywords=='' OR $site_desc==''){
				
				echo "<script>alert('please fill all the fields!')</script>";
				
				exit();
				}
				else {
		
					$insert_query = "insert into sites (site_title,site_link,site_keywords,site_desc,site_image) values (:site_title,:site_link,:site_keywords,:site_desc,:site_image)";
					
					$sql = $conn->prepare($insert_query);

					  $sql->bindParam(':site_title', $_POST['site_title']);
					  $sql->bindParam(':site_link', $_POST['site_link']);
					  $sql->bindParam(':site_keywords',$_POST['site_keywords']);
					  $sql->bindParam(':site_desc', $_POST['site_desc']);
					  $sql->bindParam(':site_image', $_FILES['site_image']['name']);
					  // use exec() because no results are returned
					  $sql->execute();
						
					 move_uploaded_file($site_image_tmp,"images/{$_FILES['site_image']['name']}");
					
					  // use exec() because no results are returned
				      echo "<script>alert('Data inserted into table')</script>";
					
					
					
					
					}
			  }
			  catch(PDOException $e)
				  {
				  echo $sql . "<br>" . $e->getMessage();
				  }

			  $conn = null;
	
	}


?>




