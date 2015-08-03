<?php include("top.html"); ?>
<?php
     $lastname= $_GET["lastname"];
     $firstname=$_GET["firstname"];
     ini_set("display_errors", 1);
     error_reporting(E_ALL | E_STRICT);
     $dbunix_socket = "/ubc/icics/mss/yyadd/mysql/mysql.sock";
     $dbuser = "root";
     $dbpass = "2789";
     $dbname = "imdb";
     try {
      $db = new PDO ("mysql:unix_socket=$dbunix_socket;dbname=$dbname", $dbuser, $dbpass);
      $db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $e) {
              die ("Can not connect to the database!");
            }
try{
      $rows = $db->query ("SELECT name,year FROM actors, movies, roles WHERE actors.last_name='$lastname' AND actors.first_name='$firstname' AND roles.actor_id=actors.id AND roles.movie_id=movies.id");}catch (PDOException $e) {
              die ("wrong input!");
            }
if($rows->rowCount() == 0) {
	try {
      		$nrows = $db->query ("SELECT first_name FROM actors WHERE first_name like '$firstname%' and last_name = '$lastname' and film_count = (SELECT max(film_count) from actors WHERE first_name like '$firstname%' and last_name= '$lastname')");} catch (PDOException $e) {
              die ("wrong input!!");
            }

		if($nrows->rowCount() !=0) {
	try{ 
		$tt = array();
		foreach ($nrows as $nrow) {$tt[]=$nrow["first_name"]; };	
		       	 $rows = $db->query ("SELECT name,year FROM actors, movies, roles WHERE actors.last_name='$lastname' AND actors.first_name='$tt[0]' AND roles.actor_id=actors.id AND roles.movie_id=movies.id");}catch (PDOException $e) {
              die ("wrong input!!!");
            }

   		     	 }

     }

  	$i = 1;
?>
<h1> Result for <?= $firstname ?> <?= $lastname ?> </h1> 
<div class= "tab">
      <?php if (($rows->rowCount()) == 0) { ?>
    <p> Actor <?= $firstname ?> <?= $lastname ?> not found! </p>
		<?php } ?>
     <?php if (($rows->rowCount()) != 0) { ?>
     <table>
	   <caption> Film by <?= $firstname ?> <?= $lastname ?> </caption>
	   <tr> <th> # </th> <th> Title </th> <th> Year </th> </tr>
           <?php foreach ($rows as $row) { ?>
				<tr> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?=$i ?> </td> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?= $row['name'] ?> </td> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?= $row['year'] ?> </td> </tr> <?php $i += 1 ?>
	    <?php } ?>
     </table>
	<?php } ?>
</div>

    
    




<?php include("bottom.html"); ?>
