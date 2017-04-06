<?php
include "../lib.php";

	$token = $_GET['token'];
	$ans = verifyToken(htmlspecialchars($token));

		if($ans == false){
			header("Location:blank.php");
		}
	$email = $_GET["email"];
?>

<!doctype html>

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<title>Password Recover</title>

<!-- Custom CSS -->
<link href="../css/logo-nav.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">	
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

<div style="text-align: center">
<img src="../images/logo.png" id="logo" alt=""></p>
</div>
</nav>

<form name="changeForm" class="form-horizontal" ng-app="validationApp" ng-controller="mainController" onsubmit="return changePass();">
<fieldset>

<!-- Form Name -->
<legend style="text-align: center"><br>U-WEfind Password Recovery</br></legend>

<p style="text-align: center">Enter your new password.</P>

<!-- Text input-->
<div class="form-group" style="display:none">
  <label class="col-md-4 control-label" for="emailR">Email</label>  
  <div class="col-md-4">
  <input id="emailR" name="emailR" placeholder="" class="form-control input-md" type="email" placeholder="johnDoe@example.com" class="form-control input-md" value="<?php echo htmlspecialchars($email); ?>"required="">
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newPass">New Password <span style="color:red">*</span> </label>
  <div class="col-md-4">
    <input id="newPass" name="newPass" type="password" placeholder="" class="form-control input-md" data-ng-model="user.newPass" ng-minlength="8" ng-maxlength="25" required="">
    <p ng-show="changeForm.newPass.$error.minlength" class="help-block alert-danger">Password is too short.</p>
  <p ng-show="changeForm.newPass.$error.maxlength" class="help-block alert-danger">Password is too long.</p>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newPass2">Confirm New Password <span style="color:red">*</span> </label>
  <div class="col-md-4">
    <input id="newPass2" name="newPass2" type="password" placeholder="" class="form-control input-md" ng-model-options="{ updateOn: 'blur' }" ng-model="user.newPass2" required data-password-verify="user.newPass" required="">
  <p ng-show="changeForm.newPass2.$error.passwordVerify" class="help-block alert-danger">Passwords do not match </p>
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Submit"></label>
  <div class="col-md-4">
    <button id="saveBnt" name="saveBnt" class="btn btn-primary btn-block" type ="submit" ng-disabled="userForm.$invalid">Continue</button>
  </div>
</div>

</fieldset>
</form>

<div class="container">
	<hr>
		<!-- Footer -->
        <footer id="indexfooter">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; U-WEfind 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	
<script src="../js/main.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="../bower_components/angular/angular.min.js"></script>
<script src="../bower_components/angular-route/angular-route.min.js"></script>
<script src="../js/passScript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="../js/ie10-viewport-bug-workaround.js"></script>	

</body>
</html>

<?php
	oneTime($token);
	?>