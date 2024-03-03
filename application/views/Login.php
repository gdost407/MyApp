<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ASG</title>
    <link rel="icon" type="image/x-icon" href="https://sb-admin-pro.startbootstrap.com/assets/img/favicon.png">
    <link href="<?php echo base_url('assets/styles.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/all.min.js.download'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/feather.min.js.download'); ?>" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap');
        body{
            font-family: "Oleo Script", system-ui;
        }
    </style>
</head>
<body class="bg-purple">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 pt-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <img src="<?php echo base_url('assets/ASG-logo.png'); ?>" style="width: auto; height: 40px;">
                                </div>
                                <div class="card-body">
                                    <h3 class="fw-bold text-center">Login</h3>
                                    <!-- Login form-->
                                    <form action="" method="post" id="loginForm">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control form-control-sm" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" required>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control form-control-sm" name="password" id="inputPassword" type="password" placeholder="Enter password" required>
                                        </div>
                                        <!-- Form Group (remember password checkbox)-->
                                        <div class="mb-3 text-end">
                                            <div class="form-check">
                                                <label class="form-check-label" for="rememberPasswordCheck">
                                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" onclick="showPassword()">
                                                    Show password
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href=""></a>
                                            <button class="btn btn-sm btn-purple" id="loginSubmitBtn" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?php echo base_url('Welcome/SignIn');?>">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-7 small">Copyright © ASG 2024</div>
                        <div class="col-5 text-end small">
                            <p class="footer">Get in <strong>{elapsed_time}</strong> sec.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url('assets/bootstrap.bundle.min.js.download'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/scripts.js.download'); ?>"></script>
    
    <script>
        function showPassword() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $('#loginForm').on('submit', function(e){
            e.preventDefault();
            $('#loginSubmitBtn').html('Login <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
            $.ajax({
                url: '<?php echo base_url('ApiController/LoginUser')?>',
                method: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    var response = (typeof data === 'object') ? data : JSON.parse(data);
                    if(response.status == '1'){
                        $('#loginSubmitBtn').html('Loged');
                        window.location="<?= base_url('Dashboard');?>";
                        // alert(response.message);
                    } else {
                        $('#loginSubmitBtn').html('Re-Login');
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                }
            });
        });
    </script>
</body>
</html>
