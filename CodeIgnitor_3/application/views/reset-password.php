<!--Codeignitor_3/application/views/reset-password.php-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    
    <!-- Bootstrap 4 CDN https://www.w3schools.com/bootstrap4/bootstrap_get_started.asp-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>    

</head>
<body>
    <div class="container">

        <?php if ($this->session->flashdata('errorMsg')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= $this->session->flashdata('errorMsg'); ?></strong>
            </div>
        <?php endif; ?>

    <!-- User Info and Logout Button - Display only when updating -->
        <?php if (!empty($arr->id)) : ?>
            <?= $this->session->set_userdata('user_id',$arr->id); ?>
            <div class="d-flex justify-content-start align-items-center my-3">
                <img src="<?= base_url('/uploads/') . $this->session->userdata('user_image') ?>" width="150px" height="130px" class="img-thumbnail mr-3">
                <span class="font-weight-bold text-primary mr-3 align-middle" style="font-size: 1.5em;"><?= $this->session->userdata('full_name') ?></span>
                <a href="<?= base_url('homecontroller/logout') ?>" class="btn btn-outline-danger align-middle">Logout</a>
            </div>
        <?php endif; ?>
        
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Reset Password</h2>
                        <form action="<?=base_url('crudcontroller/password-verify')?>" method="post">
                            <div class="form-group">
                                <label for="email">Username:</label>
                                <input type="username" id="username" name="username" class="form-control" value=
                                "<?= set_value('username', $arr->username ?? '') ?>" disabled="disabled">
                                <input type="hidden" name="username" value="<?= set_value('username', $arr->username ?? '') ?>">

                            </div>
                            <div class="form-group">
                                <label for="password">New Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

