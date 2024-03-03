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
                        <div class="col-lg-7 pt-5">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <img src="<?php echo base_url('assets/ASG-logo.png'); ?>" style="width: auto; height: 40px;">
                                </div>
                                <div class="card-body">
                                    <h3 class="fw-bold text-center">Create Account</h3>
                                    <!-- Registration form-->
                                    <form action="" method="post" id="signForm" autocomplete="off">
                                        <!-- Form Row-->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (first name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input class="form-control form-control-sm" id="inputFirstName" type="text" name="fname" placeholder="Enter first name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (last name)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control form-control-sm" id="inputLastName" type="text" name="lname" placeholder="Enter last name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (email address)            -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control form-control-sm" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="email" placeholder="Enter email address" required>
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input class="form-control form-control-sm" id="inputPassword" type="password" name="password" placeholder="Enter password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control form-control-sm" id="inputConfirmPassword" type="password" name="password2" placeholder="Confirm password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <input type="hidden" name="latitude" id="latitude" value="20.721627">
                                        <input type="hidden" name="longitude" id="longitude" value="78.332076">
                                        <button class="btn btn-sm btn-purple btn-block" id="signSubmitBtn" type="submit">Create Account</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?php echo base_url();?>">Have an account? Go to login</a></div>
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
        $(document).ready(function(){
            getLocation()
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Set latitude and longitude values to input fields
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
        }

        $('#signForm').on('submit', function(e){
            e.preventDefault();
            $('#signSubmitBtn').html('Creating Account <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
            $.ajax({
                url: '<?php echo base_url('ApiController/SignUp')?>',
                method: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    var response = (typeof data === 'object') ? data : JSON.parse(data);
                    if(response.status == '1'){
                        $('#signSubmitBtn').html('Account Created');
                        window.location="<?= base_url('Dashboard');?>";
                        // alert(response.message);
                    } else {
                        $('#signSubmitBtn').html('Re-Submit');
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
