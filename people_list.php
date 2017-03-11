<?php include 'includes/config.php'?>
<?php include 'includes/header.php'?>
<style>
    h3{
      
        padding-left:150px
    }
    p{
       
        padding-left:200px
    }
    
</style>
<h3>People List</h3>
<?php 

$sql = "select * from destinations";

$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
    {
	   echo "<p>";
	   //echo "Destination: <b>" . $row['destination'] . "</b><br />";
	   echo "Country: <b>" . $row['destinationCountry'] . "</b><br />";
	   //echo "Language: <b>" . $row['destinationLanguage'] . "</b><br />";
	   echo '<a href="people_view.php?id=' . $row['destinationID'] . '">Destination: ' . $row['destination'] . '</a>';
        echo "</p>";
    }
}else{//no records
	echo '<div align="center">What! No customers?  There must be a mistake!!</div>';
}

@mysqli_free_result($result); #releases web server memory
@mysqli_close($iConn); #close connection to database
?>
<?php include 'includes/footer.php'?>


