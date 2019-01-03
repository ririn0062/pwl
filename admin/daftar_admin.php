<?php
session_start();
$koneksi = new mysqli("localhost","root","","onlineshop");
?>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2>Admin : Register</h2>
               
                <h5>( Register yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  New User ? Register Yourself </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" action="daftar_admin.php" method="post">
									<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" name="nama_lengkap" class="form-control" id="formnama" placeholder="Your Name" required />
                                            
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" id="formnick" placeholder="Username" required />
                                            
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text"  name="email" class="form-control" id="formemail" placeholder="Your Email" required />
                                            
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control" id="formpassword" placeholder="Enter Password" required />
                                            
                                        </div>
                                     <!-- <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Retype Password" />
                                        </div> -->
                                     
                                     <!-- <a class="btn btn-success" name="submit" type="submit">Register Me</a> -->
                                     <input name="submit" type="submit" value="Register Me" class="btn btn-success">
                                    <hr />
                                    Already Registered ?  <a href="login.php" >Login here</a>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>

    
	<?php
        if(isset($_POST['submit'])){
        $query="insert into admin (id_admin,nama_lengkap,username,email,password) 
        values (NULL, '".$_POST['nama_lengkap']."', '".$_POST['username']."', '".$_POST['email']."', '".$_POST['password']."')";

     //eksekusi query
    $hasil=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));

    echo "<div class='alert alert-info'>Pendaftaran Berhasil, Silahkan Login</div>";
    echo "<meta http-equiv='refresh'content='1;url=login.php'>";
    ?>

     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    <script>
    alert("selamat, pendaftaran anda berhasil");
    window.location='login.php';</script>
   
	<?php
    }

     ?>  
