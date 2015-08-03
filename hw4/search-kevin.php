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
     try {  
      $rows = $db->query ("SELECT M.name,M.year FROM actors A1, movies M, roles R1, actors A2, roles R2 WHERE A1.last_name = '$lastname' AND A1.first_name = '$firstname' AND R1.actor_id = A1.id AND A2.last_name = 'Bacon' And A2.first_name = 'Kevin' AND R2.actor_id = A2.id AND R1.movie_id = R2.movie_id AND M.id = R1.movie_id");
         } catch (PDOException $e) {
              die (" Invalid query !! ");
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
             $rows = $db->query ("SELECT M.name,M.year FROM actors A1, movies M, roles R1, actors A2, roles R2 WHERE A1.last_name='$lastname' AND A1.first_name='$tt[0]' AND R1.actor_id = A1.id AND A2.last_name = 'Bacon' AND A2.first_name = 'Kevin' AND R2.actor_id = A2.id AND R1.movie_id = R2.movie_id AND M.id = R1.movie_id");} catch (PDOException $e) {
              die ("wrong input!!!");
            }

          }
	}
  $i = 1;
?>
<h1> Result for <?= $firstname ?> <?= $lastname ?> </h1> 
<div class= "tab">
    <?php if (($nrows->rowCount()) == 0) { ?>
            
          <p> Actor <?= $firstname ?> <?= $lastname ?> not found! </p>
        <?php } ?>
        <?php if(($nrows->rowCount()) != 0) { ?>
           <p> Actor <?= $firstname ?> <?= $lastname ?>  wasn't in any films with Kevin Bacon! </p>
           <?php } ?>
     <?php if (($rows->rowCount()) != 0) { ?>
     <table>
     <caption> Film with <?= $firstname ?> <?= $lastname ?> and Kevin Bacon </caption>
     <tr> <th> # </th> <th> Title </th> <th> Year </th> </tr>
           <?php foreach ($rows as $row) { ?>
        <tr> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?=$i ?> </td> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?= $row['name'] ?> </td> <td class = "<?php if($i%2 == 0) print "ou"; if($i%2 !=0) print "od"; ?>"> <?= $row['year'] ?> </td> </tr> <?php $i += 1 ?>
      <?php } ?>
     </table>
  <?php } ?>
</div>

<?php include("bottom.html"); ?>
