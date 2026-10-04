<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'iStore'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/tienda.css')); ?>">
</head>
<body>
    
    <header class="nav">
        <nav class="nav__inner" aria-label="Principal">
            <a class="nav__brand" href="<?php echo e(route('iphones.index')); ?>">iStore</a>
            <a class="nav__link" href="#top">iPhone</a>
            <a class="nav__link" href="#familia">Modelos</a>
            <a class="nav__link" href="#footer">Información</a>
        </nav>
    </header>

    
    <?php if(session('exito')): ?>
        <div class="toast toast--ok" role="status">
            <span><?php echo e(session('exito')); ?></span>
            <button type="button" class="toast__close" aria-label="Cerrar mensaje">&times;</button>
        </div>
    <?php endif; ?>

    <?php if(session('error') || $errors->any()): ?>
        <div class="toast toast--error" role="alert">
            <span><?php echo e(session('error') ?? $errors->first()); ?></span>
            <button type="button" class="toast__close" aria-label="Cerrar mensaje">&times;</button>
        </div>
    <?php endif; ?>

    <main id="top">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer" id="footer">
        <div class="container">
            <p>Proyecto académico de Programación Web desarrollado con Laravel.</p>
            <p>Los precios son referenciales y están expresados en dólares.</p>
        </div>
    </footer>

    <script src="<?php echo e(asset('js/tienda.js')); ?>" defer></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\mi_proyecto\resources\views/layouts/app.blade.php ENDPATH**/ ?>