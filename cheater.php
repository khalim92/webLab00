<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)

		#only true whether client input string or not : Usrname, IDID, CCN
		#input->true, else->false : CSE326, CT
		#gradeSelect always selected. 
		#Usrnam, IDID, CNN ->1. isset() 2. preg_replace() to remove the whitespace 3. strlen() to check the size. if size is 0 -> return false
		


		$exist1 = isset($_POST["Usrname"]) && isset($_POST["IDID"]) && isset($_POST["CCN"]);
		$exist2 = (isset($_POST["CSE326"]) || isset($_POST["CSE107"]) || isset($_POST["CSE603"]) || isset($_POST["CIN870"]))&&isset($_POST["CT"]);

		$exist1_Usrname = preg_replace("/\s+/", "", $_POST["Usrname"]);
		$exist1_IDID = preg_replace("/\s+/", "", $_POST["IDID"]);
		$exist1_CCN = preg_replace("/\s+/", "", $_POST["CCN"]);
	

		if(strlen($exist1_Usrname)==0){
			$exist1_Usrname=FALSE;
		}
		if(strlen($exist1_IDID)==0){
			$exist1_IDID=FALSE;
		}
		if(strlen($exist1_CCN)==0){
			$exist1_CCN=FALSE;
		}
		


		$exist1_block_chk = $exist1_Usrname && $exist1_IDID && $exist1_CCN && isset($_POST["gradeSelect"]);
		
		?>


		<!-- pre check for #5 card validate check-->		
		<?php
		$card_chk = FALSE;
		if((($_POST["CT"]=="Visa") && preg_match( "/^4/" , $_POST["CCN"]))||(($_POST["CT"]=="Mastercard") && preg_match( "/^5/" , $_POST["CCN"]))){
			if(preg_match( "/^\d{16}$/" , $_POST["CCN"])){
					$card_chk = TRUE;	
			}else{
					$card_chk = FALSE;
				}
		}?>

		<!-- Ex 4 : Display the below error message : --> 
		
		<?php if(($exist1_block_chk && $exist2)===FALSE){ ?>
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. 
				<a href="gradestore.html">Try again?</a></p>
		
		<?php

		


		#"/^([a-zA-z\-\s])+$/"

		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif ( !preg_match( "/^[a-zA-Z]+([\-\s]{1}[a-zA-Z]+)*$/", $_POST["Usrname"] ) ) { 

		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>

		<?php


		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		}elseif (!$card_chk) {

		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</p>

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["Usrname"]?></li>
			<li>ID: <?= $_POST["IDID"]?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox($_POST)?></li>
			<li>Grade: <?= $_POST["gradeSelect"]?></li>
			<li>Credit <?= $_POST["CCN"] ?> (<?= $_POST["CT"] ?>)</li>
		</ul>
		
		<!-- Ex 3 : 
			<p>Here are all the loosers who have submitted here:</p> -->
		<p>Here are all the loosers who have submitted here:</p>
		<?php
			$input_loosers = $_POST["Usrname"].";".$_POST["IDID"].";".$_POST["CCN"].";".$_POST["CT"]."\n";
			$filename = "loosers.txt";
			file_put_contents($filename, $input_loosers, FILE_APPEND);
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

			<pre><?= file_get_contents($filename) ?></pre>
		<?php
		}
		?>

		<!--<?php  ?>--><!-- if else existance 랑 blockness체크 else끝나는지검-->
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
		
			function processCheckbox($names){
			
			$result_arr = array();
			foreach(array_keys($_POST) as $temp)
			{
				if(strcmp($temp, "CSE326")==0)
					array_push($result_arr, $temp);
				elseif(strcmp($temp, "CSE107")==0)
					array_push($result_arr, $temp);
				elseif(strcmp($temp, "CSE603")==0)
					array_push($result_arr, $temp);
				elseif(strcmp($temp, "CIN870")==0)
					array_push($result_arr, $temp);
			}
			$result_arr_add = implode(", ",$result_arr);
			
			return $result_arr_add;
		}
		?>
		
	</body>
</html>
