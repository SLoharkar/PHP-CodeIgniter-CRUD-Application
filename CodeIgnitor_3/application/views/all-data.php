<!--Codeignitor_3/application/views/all-data.php-->

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

    <title>All Data</title>
</head>
<body>
    
    <div class="container" style="margin-left:8%;">
        
        <?php foreach (['successMsg' => 'success', 'deleteMsg' => 'danger'] as $msg => $type): ?>
            <?php if ($this->session->flashdata($msg)): ?>
                <div class="alert alert-<?= $type ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= $this->session->flashdata($msg); ?></strong>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- User Info and Logout Button -->
        <div class="d-flex justify-content-start align-items-center my-3">
            <img src="<?= base_url('/uploads/') . $this->session->userdata('user_image') ?>" width="150px" height="130px" class="img-thumbnail mr-3">
            <span class="font-weight-bold text-primary mr-3 align-middle" style="font-size: 1.5em;"><?= $this->session->userdata('full_name') ?></span>
            <a href="<?= base_url('homecontroller/logout') ?>" class="btn btn-outline-danger align-middle">Logout</a>
        </div>

         <?php $login_id = $this->session->userdata('login_id'); ?>
        <input type="hidden" name="login_id" value="<?= $login_id ?>">

        <table class="table table-bordered">

            <tr class="bg-info">
                <th>#</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Language</th>
                <th>Gender</th>
                <th>Qualification</th>
                <th>Image</th>
                <th>Status</th>
                <th>Added_On</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>

        <?php if(!empty($arr)){

            foreach ($arr as $key => $value) {
                if($value->status == '1'){
                    $status = '<span class="badge bg-success">Active</<span>';
                } else {
                    $status = '<span class="badge bg-danger">Deactive</<span>';
                }

            ?>

            <tr>
                <td><?= ++$key ?></td>
                <td style="white-space: nowrap;"><?= $value->name ?></td>
                <td><?= $value->username ?></td>
                <td><?= $value->email ?></td>
                <td><?= $value->phone ?></td>
                <td><?= $value->language ?></td>
                <td><?= $value->gender ?></td>
                <td><?= $value->qualification ?></td>
                <td><img src="<?= base_url() ?>/uploads/<?= $value->image ?>" width="50px"></td>
                <td><?= $status ?></td>
                <td style="white-space: nowrap;"><?= $value->added_on ?></td>
                <td style="white-space: nowrap;"><a href="reset-password/<?= $value->id ?>" class="btn btn-outline-warning">Reset Password</a></td>
                <td><a href="get-data/<?= $value->id ?>" class="btn btn-outline-primary">Update</a></td>
                <td><a href="delete-data/<?= $value->id ?>" class="btn btn-outline-danger">Delete</a></td>
            </tr>

        <?php } } else { ?>
            <tr>
                <td colspan="11" class="text-center">No Record Found</td>
            </tr>
        <?php } ?>

        </table>

    </div>
</body>
</html>
