<?php include("top.html"); ?>
<div id="index">

<h1> Add new film </h1>

<form class="add" action="" method="post" name="add1">
<fieldset>
<legend>Add a movie</legend>
<div>
<p>Film:
<input type="text" name="moviename" placeholder="movie name" value="" />

<input type="text" name="year" placeholder="year" value="" />
<input type="text" name="rank" placeholder="rank" value="" />


&nbsp;&nbsp;&nbsp; Genre :
<select name="genre">
<?php
    
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
    $rows = $db->prepare ("select distinct genre from movies_genres;");
    $rows->execute();
     } catch (PDOException $e) {
                 die    ("error!");
     }
    
    
    foreach ($rows as $row):
    ?>



<option value="<?=$row[0]?>">
<?=$row[0]?>                </option>
<?php endforeach;?>
</select>

</p>
<input type="submit" name="Add1" value="Add" />
<input type="reset" />
</div>
</fieldset>
</form>

<form class="add" action="" method="post" name="add2">
<fieldset>
<legend>Add a director</legend>
<div>
<p>Film:
<input type="text" name="moviename_dir" placeholder="movie name" value="" />
Director:
<input type="text" name="Dir_firstname" placeholder="first name" value="" />
<input type="text" name="Dir_lastname" placeholder="last name" value="" />
</p>
<input type="submit" name="Add2" value="Add" />
<input type="reset" />
</div>
</fieldset>
</form>




<form class="add" action="" method="post" name= "add3">
<fieldset>
<legend>Add an actor</legend>
<div>
<p>Film:
<input type="text" name="moviename_act" placeholder="movie name" value="" />
Actor:
<input type="text" name="Act_firstname" placeholder="first name" value="" />
<input type="text" name="Act_lastname" placeholder="last name" value="" />
</p>
<div>Role:
<input type="text" name="Act_role" placeholder="role" value="" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Add3" value="Add" />
<input type="reset" />
</div>
</div>
</fieldset>
</form>


</div>


<?php
if(isset($_POST['Add1']))
{
    
    $name = $_POST['moviename'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $rank = $_POST['rank'];

    if($name==null){echo "<h2>Please input movie name!</h2>";exit(1);}
    if($year==null){echo "<h2>Please input year!</h2>";exit(1);}
    if(rank==null){echo "<h2>Please input rank!</h2>";exit(1);}

    
    
    
    
    $rows = $db->prepare ("select distinct name from movies where name='$name';");
    $rows->execute();
    
    
    
    if($rows->rowCount()==0){
        
        for ($i=0; $i<=100000;$i++)
            
        {
            
            $rows = $db->prepare ("select distinct id from movies where id='$i';");
            $rows->execute();
            
            if($rows->rowCount()==0)
            {
                $rows = $db->prepare ("insert into movies(name, year, rank,id) values('$name','$year','$rank','$i');");
                $rows->execute();
                
                $rows = $db->prepare ("insert into movies_genres(movie_id, genre) values('$i','$genre');");
                $rows->execute();
                
                break;
            }
            
        }
    
    }
    
    else{
    
  echo "<h2>Movie exists.</h2>";
    }
}
    
    
    if(isset($_POST['Add2']))
    {
        
        $name = $_POST['moviename_dir'];
        $lastname = $_POST['Dir_lastname'];
        $firstname = $_POST['Dir_firstname'];
        
        if($name==null){echo "<h2>Please input movie name!</h2>"; exit(1);}
        if($lastname==null){echo "<h2>Please input lastname!</h2>";exit(1);}
        if($firstname==null){echo "<h2>Please input firstname!</h2>";exit(1);}
        
        
        
        
        
        $rows = $db->prepare ("select distinct id from directors where last_name='$lastname' and first_name='$firstname';");
        $rows->execute();
        
        
        
        if($rows->rowCount()!=0){
            
                $row1 = $rows->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
                
                $directorid= $row1[0];

                $rows = $db->prepare ("select distinct id from movies where name='$name';");
                $rows->execute();
                if($rows->rowCount()!=0){
                    $row1 = $rows->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
                    
                    $movieid= $row1[0];
                    
                    $rows = $db->prepare ("insert into movies_directors (movie_id, director_id) values('$movieid', '$directorid');");
                    $rows->execute();
                    
                    
                    
                }
                
                else
                    echo "<h2>create movie first!</h2>";

            
            }
            else{
            
                echo "<h2>Director does not exist!</h2>";

            }
        
    }
    
    
    
    if(isset($_POST['Add3']))
    {
        
        $name = $_POST['moviename_act'];
        $lastname = $_POST['Act_lastname'];
        $firstname = $_POST['Act_firstname'];
        $role=$_POST['Act_role'];
        
        if($name==null){echo "<h2>Please input movie name!</h2>"; exit(1);}
        if($lastname==null){echo "<h2>Please input lastname!</h2>";exit(1);}
        if($firstname==null){echo "<h2>Please input firstname!</h2>";exit(1);}
        if($role==null){echo "<h2>Please input role!</h2>";exit(1);}

        
        
        
        
        
        $rows = $db->prepare ("select distinct id from actors where last_name='$lastname' and first_name='$firstname';");
        $rows->execute();
        
        
        
        if($rows->rowCount()!=0){
            
            $row1 = $rows->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            
            $actorid= $row1[0];
            
            $rows = $db->prepare ("select distinct id from movies where name='$name';");
            $rows->execute();
            if($rows->rowCount()!=0){
                $row1 = $rows->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
                
                $movieid= $row1[0];
                
                $rows = $db->prepare ("insert into roles (movie_id, actor_id, role) values('$movieid', '$actorid','$role');");
                $rows->execute();
                
                
                
            }
            
            else
                echo "<h2>create movie first!</h2>";
            
            
        }
        else{
            
            echo "<h2>Actor does not exist!</h2>";
            
        }
        
    }
    

?>

<?php include("bottom.html"); ?>

