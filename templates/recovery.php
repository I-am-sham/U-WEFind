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

<form class="form-horizontal" ng-app="validationApp" ng-controller="mainController" onsubmit="return recovery();">
<fieldset>

<!-- Form Name -->
<legend style="text-align: center"><br>U-WEfind Password Recovery</br></legend>

<p style="text-align: center">Enter the email address associated <br> with your U-WEfind account.</br></P>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rec_email">Email <span style="color:red">*</span> </label>  
  <div class="col-md-4">
  <input id="rec_email" name="rec_email" placeholder="janedoe@domain.com" class="form-control input-md" ng-model-options="{ updateOn: 'blur' }" ng-model="user.email" type="email" placeholder="johnDoe@example.com" class="form-control input-md" required="">
  <p ng-show="userForm.email.$error.email" class="help-block alert-danger" >Invalid Email Address</p>    
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