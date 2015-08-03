<!DOCTYPE html>
<html>
<?php $movie = $_REQUEST["film"]; ?>
	<head>
		<title>Rancid Tomatoes</title>
		<meta charset = "utf-8" />
		<link href = "movie.css" type = "text/css" rel = "stylesheet" />
		<link rel = "icon" type = "image/gif" href = "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/rotten.gif" />
	</head>
	<body> 
		<div class = "top_page">
			<img src = "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/banner.png" alt = "al" />
		</div>
		<h1>
			<?php
			 	$a = file("./$movie/info.txt");
			 	print "$a[0].($a[1])";
		    ?>
		</h1> 
		<div class="content">
			<div class="leftcenter">
				<div class="rotten">
					<?php if ($a[2] > 60 || $a[2] == 60) { ?>
						<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/freshbig.png" alt="Freshbig" />
						<span class="move"> <?php print "$a[2]%" ?> </span>
					<?php } ?>
					<?php if ($a[2] < 60) { ?>
						<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rottenbig.png" alt="Rottenbig" />
						<span class="move"> <?php print "$a[2]%" ?> </span>
					<?php } ?>
				</div>
				<div class="up">
					<?php 
						$b = glob("./$movie/review*.txt");
	                    $c = count($b);
	                    for ($i = 0; $i < round($c/2); $i++) { ?>
							<div class="column_left">
								<div class="b">
								<?php if($c < 10) { ?>
									<?php $p = $i+1; $d = file("./$movie/review{$p}.txt"); if(strcmp($d[1], "FRESH") == 1) { ?>	
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
									<?php if(strcmp($d[1], "FRESH") != 1) { ?>
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>	
										<?php } ?>
								<?php if($c >9) { ?>
									<?php if($i<9) { ?>
										<?php $p = $i+1; $pp = 0; $ppp = $pp.$p; $d = file("./$movie/review{$ppp}.txt"); if(strcmp($d[1], "FRESH") == 1) { ?>	
												<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
										<?php if(strcmp($d[1], "FRESH") != 1) { ?>
												<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>
									<?php } ?>
									<?php if($i>9) { ?>
										<?php $p = $i+1; $d = file("./$movie/review{$p}.txt"); if(strcmp($d[1], "FRESH") == 1) { ?>	
											<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
										<?php if(strcmp($d[1], "FRESH") != 1) { ?>
											<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>
									<?php } ?>	
								<?php } ?>	
								</div>
								<q> <?php print $d[0] ?> </q>
							</div>
							<div class="text_left">
								<div class="b">
									<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/critic.gif" alt="Critic" />
								</div>
							<?php print($d[2]) ?> <br />
							<?php print($d[3]) ?>
							</div>
							<?php } ?>
				</div>
				
				<div class="up">
					<?php 
						$e = glob("./$movie/review*.txt");
						$f = count($e);
						for ($j = round($f/2); $j < $f; $j++) { ?>
							<div class="column_left">
								<div class="b">
								<?php if($f < 10) { ?>	
									<?php $q = $j+1; $g = file("./$movie/review{$q}.txt"); if(strcmp($g[1], "FRESH") == 1) { ?>
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
									<?php if(strcmp($g[1], "FRESH") != 1) { ?>
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>
								<?php } ?>
								<?php if($f >9) { ?>
									<?php if($j<9) { ?>
									    <?php $q = $j+1; $qq = 0; $qqq=$qq.$q; $g = file("./$movie/review{$qqq}.txt"); if(strcmp($g[1], "FRESH") == 1) { ?>
											<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
										<?php if(strcmp($g[1], "FRESH") != 1) { ?>
											<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>
									<?php } ?>
									<?php if($j>8) { ?>
										<?php $q = $j+1; $g = file("./$movie/review{$q}.txt"); if(strcmp($g[1], "FRESH") == 1) { ?>
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif" alt="Fresh" /> <?php } ?>
										<?php if(strcmp($g[1], "FRESH") != 1) { ?>
										<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif" alt="Rotten" /> <?php } ?>
									<?php } ?>
								<?php }?>
								</div>
								<q> <?php print $g[0] ?> </q>
							</div>
							<div class="text_left">
								<div class="b">
									<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/critic.gif" alt="Critic" />
								</div>
							<?php print($g[2]) ?> <br />
							<?php print($g[3]) ?>
							</div>
						<?php } ?>
				</div>
			</div>
			<div class="rightcenter">
				<span class="right">
					<img src="./<?php print $movie ?>/overview.png" alt="general overview" />
				</span>
			<div class="right_definition">
				<dl>
					<?php $x = file("./$movie/overview.txt"); $z = count($x); for ($y = 0; $y < $z; $y++) { ?>
					<?php $yy = explode(':', $x[$y],2) ?>
					<dt> <?php print $yy[0] ?></dt>
					<dd> <?php print $yy[1] ?></dd> 
					<?php } ?>
				</dl>
		    </div>
            </div>
            <div class="bottom">
            	<?php $bb = glob("./$movie/review*.txt"); $cc = count($bb); ?>
				<p> <?php print"(1-$cc) of $cc" ?> </p>
		    </div>
         </div>
         <div class="link"> <a href="https://webster.cs.washington.edu/validate-html.php"><img src="http://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML5" /></a> <br />
						    <a href="https://webster.cs.washington.edu/validate-css.php"><img src="http://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS" /></a>
		</div>
    </body>
 </html>