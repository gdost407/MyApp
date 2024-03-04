<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-activity">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg></div>
                            ASG User Profile
                    </h1>
                    <div class="page-header-subtitle">Make life simpler and easier with <b>ASG</b> and stay connected with family.</div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-calendar text-primary">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin"
                            placeholder="<?php echo date('F d,Y');?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xxl-12 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 p-3">
                <div class="row">
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Profile Picture</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <img class="img-account-profile rounded-circle mb-2" src="<?php echo ($this->session->userdata('user_data')->profile == '') ? base_url('assets/profile-1.png') : base_url($this->session->userdata('user_data')->profile);?>" id="preview-image" alt="" style="aspect-ratio: 1; object-fit: cover;">
                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        
                                        <form action="" method="post" id="profileForm" enctype='multipart/form-data'>
                                            <!-- <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden onchange="$('#profileForm').submit();"> -->
                                            <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden onchange="$('#preview-image').attr('src', window.URL.createObjectURL(this.files[0])); $('#profileForm').submit();">
                                        </form>
                                        <label class="btn btn-sm btn-primary" for="profile_image" id="profileImageBtn">Upload new image</label>
                                        
                                    </div>
                                </div>
                                <hr>
                                <iframe class="d-lg-block d-none" src="https://maps.google.com/maps?q=<?= $this->session->userdata('user_data')->latitude;?>,<?= $this->session->userdata('user_data')->longitude;?>&t=&z=15&ie=UTF8&iwloc=&output=embed" style="width: 100%; aspect-ratio: 1;"></iframe>
                            </div>
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form action="" method="post" id="Form1">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="name">Full Name</label>
                                                    <input class="form-control form-control-sm" required id="name" type="text" placeholder="Enter your name" name="uname" value="<?= $this->session->userdata('user_data')->name;?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="email">Email</label>
                                                    <input class="form-control form-control-sm" required id="email" type="email" placeholder="Enter your email" name="uemail" value="<?= $this->session->userdata('user_data')->email;?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="mobile">Phone number</label>
                                                    <input class="form-control form-control-sm" required id="mobile" type="tel" placeholder="Enter your phone number" name="umobile" value="<?= $this->session->userdata('user_data')->mobile;?>" maxlength="10">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="birthday">Birthday</label>
                                                    <input class="form-control form-control-sm" required id="birthday" type="date" name="udob" placeholder="Enter your birthday" value="<?= $this->session->userdata('user_data')->dob;?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="address">Address</label>
                                                    <input class="form-control form-control-sm" required id="address" type="text" placeholder="Enter your address" name="uaddress" value="<?= $this->session->userdata('user_data')->address;?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="state">State</label>
                                                    <input class="form-control form-control-sm" required id="state" type="text" placeholder="Enter your state"name="ustate" value="<?= $this->session->userdata('user_data')->state;?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="city">City</label>
                                                    <input class="form-control form-control-sm" required id="city" type="text" placeholder="Enter your city" name="ucity" value="<?= $this->session->userdata('user_data')->city;?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="pincode">Pincode</label>
                                                    <input class="form-control form-control-sm" required id="pincode" type="tel" placeholder="Enter your pincode" name="upincode" value="<?= $this->session->userdata('user_data')->pincode;?>" maxlength="6">
                                                </div>
                                            </div>
                                            <!-- Save changes button-->
                                            <input type="hidden" name="ulatitude" id="latitude" value="<?= $this->session->userdata('user_data')->latitude;?>">
                                            <input type="hidden" name="ulongitude" id="longitude" value="<?= $this->session->userdata('user_data')->longitude;?>">

                                            <button class="btn btn-sm btn-primary" id="SubmitBtn" type="submit">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="card mb-4">
                                    <div class="card-header">Password Change</div>
                                    <div class="card-body">
                                        <form action="" method="post" id="Form2">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="old_password">Old Password</label>
                                                    <input class="form-control form-control-sm" required id="old_password" type="password" placeholder="Enter Old Password" name="uoldpass" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="new_password">New Password</label>
                                                    <input class="form-control form-control-sm" required id="new_password" type="password" placeholder="Enter New Password" name="unewpass" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="confirm_password">Confirm Password</label>
                                                    <input class="form-control form-control-sm" required id="confirm_password" type="password" placeholder="Enter Confirm Password" name="unewpass2" >
                                                </div>
                                            </div>
                                            <!-- Save changes button-->
                                            <button class="btn btn-sm btn-primary" id="SubmitBtn2" type="submit">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <iframe class="d-lg-none d-block" src="https://maps.google.com/maps?q=<?= $this->session->userdata('user_data')->latitude;?>,<?= $this->session->userdata('user_data')->longitude;?>&t=&z=15&ie=UTF8&iwloc=&output=embed" style="width: 100%; aspect-ratio: 1;"></iframe>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    $('#Form1').on('submit', function(e){
        e.preventDefault();
        $('#SubmitBtn').html('Updating <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/UpdateProfile')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#SubmitBtn').html('Information Updated!');
                    $('#SubmitBtn').html('Updated');
                } else {
                    $('#SubmitBtn').html('Re-Submit');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });

    $('#Form2').on('submit', function(e){
        e.preventDefault();
        $('#SubmitBtn2').html('Updating <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/UpdatePassword')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#SubmitBtn2').html('Password Changed!');
                } else {
                    $('#SubmitBtn2').html('Re-Submit');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });

    $('#profileForm').on('submit', function(e){
        e.preventDefault();
        $('#profileImageBtn').html('Uploading image <div class="spinner-border text-yellow" role="status" style="width: 10px; height: 10px;"></div>');
        $.ajax({
            url: '<?php echo base_url('ApiController/UpdateProfileImage')?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                var response = (typeof data === 'object') ? data : JSON.parse(data);
                if(response.status == '1'){
                    $('#profileImageBtn').html('Profile Updated!');
                } else {
                    $('#profileImageBtn').html('Re-Upload');
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
</script>