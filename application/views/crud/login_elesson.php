<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logos.jpg">
    <!-- harus konek internet, karena bootstrapnya ngambil dari internet alias pake CDN (Content Delivery Network) -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
html{
    background: url('images/background.jpg') top left #EEEEEE;
    overflow: hidden;
}
/* body {
    background-color: white;
} */
body{ 
    background: url('images/background.jpg') top left; 
    min-width: 1000px; 
    min-height: 900px; 
    text-align: left; 
    margin: 0px; 
    font-family: arial; 
    font-size: 12px; 
    color: #666666;
}
body.no-side{ 
    background: none; 
    color: #333333; 
    min-height: 100%; 
    margin-bottom: 100px; 
}

#loginbox {
    margin-top: 30px;
}

#loginbox > div:first-child {        
    padding-bottom: 10px;    
}

.iconmelon {
    display: block;
    margin: auto;
}

#form > div {
    margin-bottom: 25px;
}

#form > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}

.panel {    
    background-color: transparent;
}

.panel-body {
    padding-top: 30px;
    background-color: rgba(2555,255,255,.3);
}

#particles {
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 0;                        
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    z-index: -2;
}

.iconmelon,
.im {
  position: relative;
  width: 150px;
  height: 150px;
  display: block;
  fill: #525151;
}

.iconmelon:after,
.im:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.panel-title{
    font-family : century gothic;
}
.profile {
    margin-top : 40px;
    background-image: url("images/3.jpg");
	background-size: 100%;
	padding: 5%;
	width: 200px;
	height: 200px;
	border-radius: 50%;
	position: absolute;
	left: 9%;
	top: 25%;
  }
</style>
</head>
<body>
<div class="container">
        <div class="profile"></div>
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">         
            <div class="row">                
                <div class="iconmelon">
                  <svg viewBox="0 0 32 32">
                    <g filter="">
                      <use xlink:href="#git"></use>
                    </g>
                  </svg>
                </div>
            </div>
            
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <div class="panel-title text-center"><h4> <b>E-LESSON</b> </h4></div>
                </div>     
                <div class="panel-body" >
                    <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST" action="cek_login.php">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="user" type="text" class="form-control" name="txt_user" value="" placeholder="Username, NIS">                                        
                        </div>
    
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="txt_pass" placeholder="Password">
                        </div>                                                                  
    
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls" style="margin-bottom:20px">
                                <button type="submit" href="#" class="btn btn-primary col-sm-offset-4 col-md-4"><i class="glyphicon glyphicon-log-in"></i> Log in</button>   
                            </div>
                            <div class="col-sm-12 controls">
                            <a href="registrasi.php"><button type="button" class="btn btn-primary col-sm-offset-4 col-md-4"><i class="glyphicon glyphicon-pencil"></i> Register</button></a>
                        </div>
                        </div>
                        
                    </form>     
                </div>                     
            </div>  
        </div>
    </div>
</body>
</html>


