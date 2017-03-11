<?php
//customer_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>

<style>
 h3{
      
        padding-left:150px
    }
    p{
       
        padding-left:200px;
        padding-right:70px
    }
    img{
        padding-top:50px
    }
</style>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:people_list.php');
}


$sql = "select * from destinations where destinationID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $destination = stripslashes($row['destination']);
        $destinationLanguage = stripslashes($row['destinationLanguage']);
        $destinationCountry = stripslashes($row['destinationCountry']);
        $destinationDetail = stripslashes($row['destinationDetail']);
        $title = "Title Page for " . $destination;
        $pageID = $destination;
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This destination does not exist</p>';
}

?>
<?php include 'includes/header.php';?>
<h3><?=$pageID?></h3>
<?php
    
    
if($Feedback == '')
{//data exists, show it

    echo '<p>';
    
    echo 'Country: <b>' . $destinationCountry . '</b></b><br /> ';
    echo 'Primary Language: <b>' . $destinationLanguage . '</b></b><br /> ';
    echo 'Detail: <b>' . $destinationDetail . '</b></b><br /> ';
    echo '<center><img src="images/' . $id . '.jpg" /></center>';
    
    echo '</p>'; 
}else{//warn user no data
    echo $Feedback;
}    

echo '<p><a href="people_list.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php include 'includes/footer.php';?>