<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="mb-4">Welcome to Our Project</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('signup.form')); ?>" class="btn btn-primary btn-lg mx-2">Signup</a>
    <a href="<?php echo e(route('login.form')); ?>" class="btn btn-success btn-lg mx-2">Login</a>
</div>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/home.blade.php ENDPATH**/ ?>