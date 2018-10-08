<?php
require_once 'config.php';
$dbname = "quiz1"; 
$dbhost = "webpagesdb.it.auth.gr";
$dbuser = "emitsopou1";
$dbpass = "emitsopou1";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("cannot connect");
$response=mysqli_query($conn,"select id,question_name,answer from questions");
	 $i=1;
	 $right_answer=0;
	 $wrong_answer=0;
	 $unanswered=0;
	 while($result=mysqli_fetch_array($response)){ 
	       if($result['answer']==$_POST["$i"]){
		       $right_answer++;
		   }else if($_POST["$i"]==5){
		       $unanswered++;
		   }
		   else{
		       $wrong_answer++;
		   }
		   $i++;
	 }
	 echo "<div id='answer'>";
	 echo " Right Answers  : <span class='highlight'>". $right_answer."</span><br>";
	 
	 echo " Wrong Answers  : <span class='highlight'>". $wrong_answer."</span><br>";
	 
	 echo " Unanswered Questions  : <span class='highlight'>". $unanswered."</span><br>";
	 echo "</div>";

?>