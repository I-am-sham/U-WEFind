<?php
include "course.php";
if(!session_id()) session_start();//If session is not started start session

function getDBConnection(){
	try{
		$db = new mysqli("sql10.freemysqlhosting.net","sql10166023","fNe6cp3r6y","sql10166023");
		//$db = new mysqli("localhost","root","","ifinddb");
		if ($db == null && $db->connect_errno > 0)return null;
		return $db;
	}catch(Exception $e){ } 
	return null;
}

function saveUser($fname, $lname, $departmentId, $email, $password){
	$password = sha1($password);
	$sql = "INSERT INTO `user` (`fname`, `lname`, `departmentId`, `email`, `password`) VALUES ('$fname', '$lname', '$departmentId', '$email', '$password');";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
			if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
			$_SESSION["user"] = $fname;
			$_SESSION["id"] = $id;
		}
		$db->close();
	}
	return $id;
}

function checkLogin($email, $password){
	$db = getDBConnection();

	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "SELECT * FROM `user_attempts` WHERE ip = '$ip'";
	if($db!=NULL){
		$results =$db->query($sql);
		$row = $results->fetch_assoc();
			if($row['attempt_num']>2){
				return $row['attempt_num'];
			}
				$password = sha1($password);
				$sql = "SELECT * FROM `user` where `email`='$email'";

				$res = $db->query($sql);
				if ($res && $row = $res->fetch_assoc()){
					if($row['password'] == $password){
						$_SESSION["user"] = $row['fname'];
						$_SESSION["id"] = $row['userId'];
						$sql = "DELETE FROM `user_attempts` WHERE `ip`='$ip'";
						$db->query($sql);
						return true;
					}
				}
				$db->close();
	}
	return false;
}

function prodAttempt(){
	$db = getDBConnection();
	$ip = $_SERVER['REMOTE_ADDR'];
	$count = 0;
	//var_dump($count);
	if($db!=NULL){
		$sql = "SELECT * FROM `user_attempts` WHERE ip = '$ip'";
		$res = $db->query($sql);
		$row = $res->fetch_assoc();
			if($row['ip']==null){
				++$count;
				$sql = "INSERT INTO `user_attempts`(`ip`,`attempt_num`)VALUES('$ip', '$count')";
				$res = $db->query($sql);
				//return $count;
			}
			if($row['ip']==$ip){
				$sql = "UPDATE `user_attempts` SET `attempt_num` = attempt_num + 1 WHERE ip = '$ip'";
				$res = $db->query($sql);
				//$row = $res->fetch_assoc();
				//return $row['attempt_num']; 
			}
		
	$db->close();
	}
	//return $count;
}

function checkEmail($email){
	$db = getDBConnection();
	
	$sql = "SELECT * FROM `user` WHERE `email`='$email'";
	
	if($db != NULL){
		$res = $db->query($sql);
		if ($res && $row = $res->fetch_assoc()){
			if($row > 0){
				return true;
			}
		}
	}
	return false;
}

function recoverycheck($email){
	$sql = "SELECT * FROM `user` where `email`='$email'";
	//print($email);
	$db = getDBConnection();
	//print_r($db);
	if($db != NULL){
		$res = $db->query($sql);
		if ($res && $row = $res->fetch_assoc()){
			if($row['email'] == $email){
				$userId = $row['userId'];
				$token = tokenizer($userId, $email);
				require( 'telegram/PHPMailer/PHPMailerAutoload.php' );
				$mail = new PHPMailer;
				$email = $email;
				//Creating the email body to be sent

				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 587;
				$mail->Username = "find.uwe@gmail.com";
				$mail->Password = "classroomlocator";
				//Sending the actual email
				$mail->setFrom('find.uwe@gmail.com');
				$mail->addAddress($email);     // Add a recipient 
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Password Recovery';
				$mail->addEmbeddedImage('images/logo.png', 'logo', 'images/logo.png');
				$mail->Body = '<p><img alt="PHPMailer" height="70" width="140" src="cid:logo"></p><h4>To reset your password, click on the link below.</h4><br><a href="https://localhost/IFind/templates/newpass.php?token='.$token.' &email='.$email.'">U-WEfind</a></br>';

				if(!$mail->send()) {
					return false;	
				}
				else{
					return true;
				}
			}
		}
	}
	return false;
}

function change($email, $newPass){
	$db = getDBConnection();
	$res = false;
	$password = sha1($newPass);
	if ($db != NULL){
		
	$sql = "SELECT * FROM `user` where `email`='$email'";
	$rec = $db->query($sql);
	if ($rec && $row = $rec->fetch_assoc()){
		if($row['password']!=$password){
			$sql = "UPDATE `user` SET `password` = '$password' WHERE `email`='$email'";
			//oneTime($token);
			$res = $db->query($sql);
			return true;
		}
	}		
	}
	return false;
}

function tokenizer($userId, $email){
	$db = getDBConnection();
	$token = sha1(uniqid($email, true));
	$sql = "INSERT INTO pending_users (userId, token) VALUES ('$userId', '$token');";	
	$id = -1;
	if($db!=null){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $token;
}

function verifyToken($token){
	$db = getDBConnection();	
	$sql = "SELECT token FROM `pending_users` WHERE `token`= '$token';";
	if($db!=NULL){
	$res = $db->query($sql);
	if($res && $row = $res->fetch_assoc()){
		if($token=$row['token']){
			return true;
		}
	}
	$db->close();
	}
	return false;
}

function oneTime($token){
	$db = getDBConnection();
	$sql = "DELETE FROM pending_users WHERE token = '$token'";

	if ($db != null){
		$res = $db->query($sql);
		$db->close();
	}
}

function getAllCourses(){
	$db = getDBConnection();
	$courses = [];
	if ($db != null){
		$sql = "SELECT distinct courseCode, courseName FROM `course`";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$courses[] = $row;
		}
		$db->close();
	}
	return $courses;
}

function getAllDeptCourses($departmentId){
	$db = getDBConnection();
	$deptcourses = [];
	if ($db != null){
		$sql = "SELECT distinct courseCode, courseName, departmentId FROM `course` WHERE `departmentId` = '$departmentId'";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$deptcourses[] = $row;
		}
		$db->close();
	}
	return $deptcourses;
}

function getAllDepartments(){
	$db = getDBConnection();
	$departments = [];
	if ($db != null){
		$sql = "SELECT departmentId FROM `department`";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$departments[] = $row;
		}
		$db->close();
	}
	return $departments;
}

function getAllRooms(){
	$db = getDBConnection();
	$rooms = [];
	if ($db != null){
		$sql = "SELECT roomId FROM `room`";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$rooms[] = $row;
		}
		$db->close();
	}
	return $rooms;
}

function saveCourse($courseCode){
	$userId = $_SESSION['id'];
	$sql = "INSERT INTO `user_course` (`userId`, `courseCode`) VALUES ('$userId', '$courseCode')";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}

function deleteCourse($courseCde){
	$userId = $_SESSION['id'];
	$db = getDBConnection();
	
	$sql = "DELETE FROM `user_course` WHERE `courseCode` = '$courseCde' AND `userId` = '$userId'";
	$res = null;
	if($db!= Null){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
}

function getAllUserCourses(){
	$userId = $_SESSION['id'];
	$db = getDBConnection();
	$courses = [];
	if ($db != null){
		$sql = "SELECT userId, courseCode FROM `user_course` WHERE userId=$userId";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$courses[] = $row;
		}
		$db->close();
	}
	return $courses;
}


function genTimetable(){ //retrieving courses to generate the timetable for the user 
$userId = $_SESSION['id'];	
$db = getDBConnection();
$sql = "SELECT c.courseCode, u.courseCode, courseName, roomId, sTime, fTime, day FROM course c JOIN user_course u ON u.courseCode = c.courseCode AND u.userId = $userId";
$empty= new Course(); //empty course object
$courses = array( //associative 2D array using Days and Time as the indices
            "08:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
			"09:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
			"10:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
			"11:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
			"12:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "13:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "14:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "15:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "16:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "17:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "18:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            "19:00:00" => array (
               "Monday"=>$empty,
               "Tuesday"=>$empty,	
               "Wednesday"=>$empty,
               "Thursday"=>$empty,
               "Friday"=>$empty,
               "Saturday"=>$empty,
            ),
            
);
 $res=$db ->query($sql);
    while(($row = $res ->fetch_assoc())!=null){ //fetching course information row by row
       $course=new Course(); //creating course object
       $course->courseCode =$row["courseCode"]; //course code from course table added to course object
       $course->courseName =$row["courseName"]; //name of course from course table added to course object
       $course->sTime = $row["sTime"]; //start time of course from course table added to course object
       $course->fTime =$row["fTime"]; //finish time of course from course table added to course object
       $course->day =$row["day"]; //day course is held from course table added to course object
       $course->roomId =$row["roomId"]; //room where course is taught from course table added to course object

	   $courses[$course->sTime][$course->day]=$course; 
       if ($course->fTime - $course->sTime === 2){ //checks if course session is two hours; no checks if course is >2 hours
           $new_time = (($course->sTime) +1).":00:00"; //if true then add hour unto another hour
           $courses[$new_time][$course->day]=$course;
       }
	}
	//echo $courses['09:00:00']['Monday']->courseCode;
    $time_intervals=['8am-9am','9am-10am','10am-11am','11am-12pm','12pm-1pm','1pm-2pm','2pm-3pm','3pm-4pm','4pm-5pm','5pm-6pm','6pm-7pm','7pm-8pm'];//index array by default
	$i=0;
    echo "<table class='table table-hover table-responsive' id='dev-table' style='table-layout:fixed'";
    echo "<thead><tr><th>&nbsp;</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr></thead><tbody>";

	foreach($courses as $list => $times) //printing timetable row by row
	{
		echo "<tr><td>".$time_intervals[$i++]."</td>"; //i need to iterate all these times
    foreach($times as $days => $value){
		//echo $value->courseCode;
		echo "<td>".$value->courseCode."<br>".$value->courseName."<br>"."<a href='classmap.php?roomID=".$value->roomId."'>".$value->roomId."</a>"."</td>"; //roomId is hyperlinked and sent as variable to google map page
	}
	echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}

function retrieveURL($roomId){ 
$sql= "SELECT url
       FROM room
       where roomid='$roomId';
       "; //statement to retrieve url location of the 

$db = getDBConnection(); //lib.php included for this method to work
$result=$db->query($sql);
while (($row=$result->fetch_assoc())!=null){
	$url=$row['url'];
}
return $url;
}

function checkRoom($roomId){
	$sql = "SELECT * FROM `room` where `roomId`='$roomId'";
	$db = getDBConnection();
	if($db != NULL){
		$res = $db->query($sql);
		if ($res && $row = $res->fetch_assoc()){
			if($row['roomId'] == $roomId){
				return true;
			}
		}
	}
	return false;
}

function getImg($roomId){
	$sql = "SELECT entrance FROM `room` where `roomId`='$roomId'";
	$db = getDBConnection();
	if($db != NULL){
		$res = $db->query($sql);
		while (($row=$res->fetch_assoc())!=null){
			$entrance = $row['entrance'];
		}
		return $entrance;
	}
}


?>
