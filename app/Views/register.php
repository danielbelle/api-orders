<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista Produtos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 " style="margin-top: 70px">
                <h4>Sign Up - Ci 4 Authentication</h4>
                <hr>
                <form action="<?= route_to('home/credential'); ?>" method="POST" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email" value="">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="">New password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password" value="">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" placeholder="ReType your password" value="">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <div>
                        <a href="<?php echo site_url('login'); ?>">I already have an account. Sign in now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function redirect(url) {
            window.location.href = url;
            return false;
        }
    </script>
</body>

</html>