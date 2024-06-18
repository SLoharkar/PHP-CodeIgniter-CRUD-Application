<!-- Codeignitor_3/application/views/register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 4 CDN https://www.w3schools.com/bootstrap4/bootstrap_get_started.asp-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>    

    <!-- Link to external Javascript -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <!-- Include external JavaScript file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .top-right-image {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

    <?php echo "<title>" . (!empty($arr->id) ? "Update Form" : "Register Form") . "</title>"; ?>

</head>

<body>
    <div class="container mt-5">

    <!-- User Info and Logout Button - Display only when updating -->
        <?php if (!empty($arr->id)) : ?>
            <div class="d-flex justify-content-start align-items-center my-3">
                <img src="<?= base_url('/uploads/') . $this->session->userdata('user_image') ?>" width="150px" height="130px" class="img-thumbnail mr-3">
                <span class="font-weight-bold text-primary mr-3 align-middle" style="font-size: 1.5em;"><?= $this->session->userdata('full_name') ?></span>
                <a href="<?= base_url('homecontroller/logout') ?>" class="btn btn-outline-danger align-middle">Logout</a>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center mb-4"><?= (!empty($arr->id) ? "Update Form" : "Register Form") ?></h3>
                <?php if (!empty($arr->id)) { ?>
                    <img src="<?= base_url() ?>/uploads/<?= $arr->image ?>" class="top-right-image img-thumbnail">
                <?php } ?>

                <?php
                if (!empty($arr->id)) {
                    // Set user ID in session
                    $this->session->set_userdata('user_id', $arr->id);         
                    echo form_open_multipart('crudcontroller/update-data');
                } else {
                    echo form_open_multipart('crudcontroller/add-data');
                }
                ?>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= set_value('username', $arr->username ?? '') ?>">
                        <?= form_error('username') ?>
                    </div>

                    <?php if (empty($arr)) { ?> 
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= set_value('password', $arr->password ?? '') ?>">
                        <?= form_error('password') ?>
                    </div>
                    <?php } ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="<?= set_value('name', $arr->name ?? '') ?>">
                        <?= form_error('name') ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= set_value('email', $arr->email ?? '') ?>">
                        <?= form_error('email') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="<?= set_value('phone', $arr->phone ?? '') ?>">
                        <?= form_error('phone') ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="language">Languages</label>
                        <select class="form-control" name="language" id="language">
                            <option value="">Select</option>
                            <option value="PHP" <?= set_select('language', 'PHP', ($arr->language ?? '') == 'PHP') ?>>PHP</option>
                            <option value="JAVA" <?= set_select('language', 'JAVA', ($arr->language ?? '') == 'JAVA') ?>>JAVA</option>
                            <option value="Python" <?= set_select('language', 'Python', ($arr->language ?? '') == 'Python') ?>>Python</option>
                        </select>
                        <?= form_error('language') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" <?= set_radio('gender', 'Male', isset($arr->gender) && $arr->gender == 'Male') ?>>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" <?= set_radio('gender', 'Female', isset($arr->gender) && $arr->gender == 'Female') ?>>
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                        <?= form_error('gender') ?>                           
                    </div>

                    <div class="form-group col-md-6">
                        <label>Qualification</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="qualification[]" value="BCA" <?= set_checkbox('qualification[]', 'BCA', in_array('BCA', explode(',', $arr->qualification ?? ''))) ?>>
                            <label class="form-check-label" for="qualificationBCA">BCA</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="qualification[]" value="MCA" <?= set_checkbox('qualification[]', 'MCA', in_array('MCA', explode(',', $arr->qualification ?? ''))) ?>>
                            <label class="form-check-label" for="qualificationMCA">MCA</label>
                        </div>
                        <?= form_error('qualification[]') ?>                           
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <?= form_error('image') ?>
                    </div>

                    <?php if (!empty($arr)) { ?>
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0" <?= set_select('status', '0', $arr->status == '0') ?>>Deactive</option>
                            <option value="1" <?= set_select('status', '1', $arr->status == '1') ?>>Active</option>
                        </select>
                        <?= form_error('status') ?>
                    </div>
                    <?php } ?>
                </div>

                <button type="submit" class="btn btn-info">Submit</button>
                    <div class="text-center mt-3">
                        <?php if (empty($arr->id)) { ?>
                            <!-- Show the "Login here" link if $arr->id is empty -->
                            <p>Already have an account? <a href="<?= base_url('homecontroller/login') ?>">Login here</a>.</p>
                        <?php } ?>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</body>
</html>
