<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humas Polres Bangkalan</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@800&family=Battambang&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600&family=Archivo+Black&family=Assistant:wght@300;400;600;700&display=" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/layouts/app.blade.php ENDPATH**/ ?>