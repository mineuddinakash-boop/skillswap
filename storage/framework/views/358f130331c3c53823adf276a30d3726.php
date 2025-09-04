<!DOCTYPE html>
<html>
<head>
    <title>Create Swap Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Create Swap Request</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('swap.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Skill Category</label>
                            <select name="skill_category" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="soft skill">Soft Skill</option>
                                <option value="hard skill">Hard Skill</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skill You Have</label>
                            <input type="text" name="skill_have" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Source of Learned Skill</label>
                            <input type="text" name="skill_source" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skill You Want to Learn</label>
                            <input type="text" name="skill_want" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Done</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/cse470project/resources/views/create-swap.blade.php ENDPATH**/ ?>