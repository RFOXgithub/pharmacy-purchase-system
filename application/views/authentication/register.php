<!DOCTYPE html>
<html lang="en">

<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Register - Toko Alat Kesehatan</title>
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet">
    <link href='<?php echo base_url(); ?>css/fontgoogle.css' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">
    <!-- end: Favicon -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style type="text/css">
        body {
            background: url(<?php echo base_url(); ?>img/bg-login.jpg) !important;
        }

        .h1 {
            font-size: 18px;
            font-family: Verdana, sans-serif;
            color: #666666;
            background-color: #f0f0f0;
            padding-left: 7px;
            padding-right: 7px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="container-fluid-full">
        <div class="row-fluid">

            <div class="row-fluid">
                <div class="login-box">
                    <div style="display: flex; align-items: center; justify-content: center; text-align: center; margin-top: 20px; padding: 0 10px;">
                        <h1 class="h1" style="margin: 0; font-size: 24px;">FORM REGISTRASI</h1>
                    </div>


                    <?php echo form_open('authentication/register', ['class' => 'form-horizontal']); ?>

                    <?php
                    $message = $this->session->flashdata('message');
                    echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
                    ?>

                    <div style="display: flex; align-items: center; margin-top:20px;">
                        <label for="username" style="width: 75px; margin-left: 75px;">Username</label>
                        <div class="input-prepend" title="Username" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input class="input-large span10" name="username" id="username" type="text" placeholder="User ID" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="password" style="width: 75px; margin-left: 75px;">Password</label>
                        <div class="input-prepend" title="Password" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon lock"></i></span>
                            <input class="input-large span10" name="password" id="password" type="password" placeholder="Password" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="retype_password" style="width: 75px; margin-left: 75px;">Retype-Password</label>
                        <div class="input-prepend" title="Password" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon lock"></i></span>
                            <input class="input-large span10" name="retype_password" id="retype_password" type="password" placeholder="Retype Password" style="color:black !important;" />
                        </div>
                    </div>

                    <div id="password-error" style="color: red; margin-left: 150px;"></div>

                    <div style="display: flex; align-items: center;">
                        <label for="email" style="width: 75px; margin-left: 75px;">Email</label>
                        <div class="input-prepend" title="Email" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon envelope"></i></span>
                            <input class="input-large span10" name="email" id="email" type="email" placeholder="Email" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="birth" style="width: 75px; margin-left: 75px;">Date of Birth</label>
                        <div class="input-prepend" title="Birth" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon calendar"></i></span>
                            <input class="input-large span10" name="birth" id="birth" type="date" placeholder="Birth" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="gender" style="width: 75px; margin-left: 75px;">Gender :</label>
                        <div class="input-prepend" title="Gender" style="flex-grow: 1;">
                            <div style="display: flex; gap: 15px; margin-left:20px">
                                <label for="male" style="display: flex; align-items: center;">
                                    <input type="radio" name="gender" id="male" value="male" style="margin-right: 5px;">
                                    Male
                                </label>
                                <label for="female" style="display: flex; align-items: center;">
                                    <input type="radio" name="gender" id="female" value="female" style="margin-right: 5px;">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="address" style="width: 75px; margin-left: 75px;">Address</label>
                        <div class="input-prepend" title="Address" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon home"></i></span>
                            <input class="input-large span10" name="address" id="address" type="text" placeholder="Address" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="city" style="width: 75px; margin-left: 75px;">City</label>
                        <div class="input-prepend" title="City" style="flex-grow: 1; display: flex; align-items: center; margin-left:20px">
                            <?= form_dropdown('city', $city_options, '', 'class="span6" id="selectError" data-rel="chosen"'); ?>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="number" style="width: 75px; margin-left: 75px;">Contact No</label>
                        <div class="input-prepend" title="Number" style="flex-grow: 1;">
                            <span class="add-on"><i class="halflings-icon phone"></i></span>
                            <input class="input-large span10" name="number" id="number" type="tel" placeholder="Number" style="color:black !important;" />
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <label for="id_paypal" style="width: 75px; margin-left: 75px;">Pay-pal ID</label>
                        <div class="input-prepend" title="PayPal" style="flex-grow: 1;">
                            <span class="add-on"><i class="fab fa-paypal"></i></span>
                            <input class="input-large span10" name="id_paypal" id="id_paypal" type="text" placeholder="PayPal" style="color:black !important;" />
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="centered-buttons">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear</button>
                    </div>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>

    </div>

    <!-- start: JavaScript-->
    <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/retypepassword_validation.js"></script>
    <script>
        function clearForm() {
            document.querySelector('form').reset();
        }
    </script>
    <!-- end: JavaScript-->

</body>

</html>