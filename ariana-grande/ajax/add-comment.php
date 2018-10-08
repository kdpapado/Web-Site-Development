<?php
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $email = htmlentities($email);
    $comment = htmlentities($comment);

    // Connect to the database
	$dbname = "table"; //create the database called "comment_sys"
     $dbhost = "webpagesdb.it.auth.gr";
     $dbuser = "emitsopou";
     $dbpass = "emitsopou";  
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("cannot connect");
	
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . $default . "&s=" . $size;

	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
    mysqli_query($conn ,"INSERT INTO comments (name, email, comment, id_post)VALUES( '$name', '$email', '$comment', '$id_post')");
    if(!mysqli_errno($conn)){
?>
    
    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5><span  class="com-dt"><?php echo date('Y-m-d H:i:s', strtotime('+1 hour')); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div><!-- end "cmt-cnt" -->
	<?php } ?>
<?php endif; ?>