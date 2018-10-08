<!DOCTYPE html>
<html>
    <head>
	<title>COMMENTS - ARIANA GRANDE</title>
		<link rel="shortcut icon" href="images/favicon.ico">
        <meta charset="utf-8" />

        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/comstyle.css">
        <link href="pagination/css/pagination.css" rel="stylesheet" type="text/css" />
       <link href="pagination/css/A_green.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
    </head>
  <body style="background-image:url(https://s-media-cache-ak0.pinimg.com/736x/1c/8e/a8/1c8ea8eb3613f89295e82e69f5c9bad5.jpg);">
    
    <br/><br/><br/><br/><br/>


<?php 
$id_post = "1"; //the post or the page id
?>

<div class="cmt-container" >
    <div class="clear"></div>
    <h2>Comments...</h2>
    <?php
    include("pagination/function.php");
    $dbname = "table"; 
     $dbhost = "webpagesdb.it.auth.gr";
     $dbuser = "emitsopou";
     $dbpass = "emitsopou"; 
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("cannot connect");
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 10; //if you want to dispaly 10 records per page then you have to change here
    $startpoint = ($page * $limit) - $limit;
    $statement = "comments order by date desc";
    $search_sql = "SELECT * FROM $statement Limit $startpoint, $limit";

    echo "<div id='pagingg' >";
    echo pagination($statement,$limit,$page);
    echo "</div>";

    $sql = mysqli_query($conn,$search_sql) ;
    if( $sql ){
    while($row=mysqli_fetch_array($sql)){ 
        $name = $row['name'];
        $email = $row['email'];
        $comment = $row['comment'];
        $date = $row['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

    ?>
    <div class="cmt-cnt">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->

    <?php  } }?>
   
    <br/>
    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">
		<form id="form">
        <input type="text" id="name-com" name="name-com" value="" required placeholder="Your name" />
        <input type="email" id="mail-com" name="mail-com" value='' required placeholder="Your e-mail adress" /> 
		<textarea required class="the-new-com"></textarea>
		<div id = "bt-add-com" ><input type="submit" value = "Post comment"></div>
        <!--<div class="bt-add-com">Post comment</div>-->
        <div class="bt-cancel-com">Cancel</div>
		</form>
    </div>


<br/>
</div><!-- end of comments container "cmt-container" -->


<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $("#bt-add-com input").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $("#bt-add-com input").css({opacity:1}); }
        });

		
  
  

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
			
			
			$( "#form" ).submit(function( event ) {
			
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');
            var re = /\S+@\S+\.\S+/;

            if( !theCom.val() || !theName.val() || !theMail.val()){
				
					alert('Please fill in all the required fields!'); 
				
			}
			else{
				
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){

                            $('.new-com-bt').show('fast');
                           $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
			
  event.preventDefault();
			});
    });
</script>
<br/><br/><br/><br/><br/>
</body>
</html>