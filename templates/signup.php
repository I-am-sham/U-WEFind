<!doctype html>

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<title>Registration</title>

<!-- Custom CSS -->
<link href="../css/logo-nav.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">	
</head>

<body ng-app="validationApp" ng-controller="mainController" onload="retrieveAllDepartments();">

<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../templates/timetable.php">
                    <img src="../images/logo.png" id="logo" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
						<!-- <button type="button" onclick="showSearchBar();" class="btn btn-info">Search Classroom</button> -->
						<a id="showSearchBar" href="#" onclick="showSearchBar(); return false;" style="display: none;">Search Classroom</a>
					</li>
					</ul>
					<ul>
					<li>
						<div id ="classroomSearch" style ="display:none;">
								<div id="custom-search-input">
									<div class="input-group col-sm-4">
										<input id="roomID" name="roomID" list="rooms" type="text" class="form-control input-sm" placeholder="Search.." >
											<datalist id="rooms">
											<option value="">rooms..</option>
											</datalist>
											<div class="input-group-btn">
												<button onclick ="search(); hideSearchBar();" class="btn btn-info btn-sm" type="button">
												<i class="glyphicon glyphicon-search"></i>
												</button>
												<button onclick ="hideSearchBar();" class="btn btn-info btn-sm" type="button">
												<i class="glyphicon glyphicon-remove"></i>
												</button>
											</div>
									</div>
								</div>
						</div>
					</li>
					</ul>
					<ul class="navbar-nav navbar-right" style="display: none;">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" ></span>Logout</a></li>
					</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- business-header -->
    <header class="business-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
        </div>
    </header>


<form name="userForm" class="form-horizontal" method = "POST" action = "" ng-submit="submitForm(userForm.$valid)" novalidate>
<fieldset>

<!-- Form Name -->
<legend class="jumbotron" style="text-align: center">U-WEfind Registration</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fname">First Name <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="fname" name="fname" type="text" placeholder="Jane" class="form-control input-md" ng-model="user.fname" type="text" placeholder="" class="form-control input-md" required="">  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lname">Last Name <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="lname" name="lname" type="text" placeholder="Doe" class="form-control input-md" ng-model="user.lname" type="text" placeholder="" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="departmentId">Department <span style="color:red">*</span></label>  
  <div class="col-md-4">
	<select class="form-control" name="departmentId" id="departmentId">
		<option value="0">Choose Department</option>
	</select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email <span style="color:red">*</span> </label>  
  <div class="col-md-4">
  <input id="email" name="email" placeholder="janedoe@domain.com" class="form-control input-md" ng-model-options="{ updateOn: 'blur' }" ng-model="user.email" type="email" placeholder="johnDoe@example.com" class="form-control input-md" required="">
  <p ng-show="userForm.email.$error.email" class="help-block alert-danger" >Invalid Email Address</p>    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password <span style="color:red">*</span> </label>
  <div class="col-md-4">
    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" data-ng-model="user.password" ng-minlength="8" ng-maxlength="25" required="">
    <p ng-show="userForm.password.$error.minlength" class="help-block alert-danger">Password is too short.</p>
  <p ng-show="userForm.password.$error.maxlength" class="help-block alert-danger">Password is too long.</p>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password2">Confirm Password <span style="color:red">*</span> </label>
  <div class="col-md-4">
    <input id="password2" name="password2" type="password" placeholder="" class="form-control input-md" ng-model-options="{ updateOn: 'blur' }" ng-model="user.password2" required data-password-verify="user.password" required="">
  <p ng-show="userForm.password2.$error.passwordVerify" class="help-block alert-danger">Passwords do not match </p>
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Submit"></label>
  <div class="col-md-4">
    <button id="saveBnt" name="saveBnt" class="btn btn-primary btn-block" type ="submit" ng-disabled="userForm.$invalid" onclick="return register();">Submit</button>
  </div>
</div>

</fieldset>
</form>
  </div>
    </div>
</div>

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