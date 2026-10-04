<?php $__env->startSection('title', 'iPhone - iStore'); ?>

<?php $__env->startSection('content'); ?>

    <?php
        // Equipo que se muestra en el banner principal: el primero marcado como "Nuevo"
        $destacado = $iphones->firstWhere('nuevo', true) ?? $iphones->first();
    ?>

    <div class="container">
        <h1 class="page-title">iPhone</h1>

        <?php if($iphones->isNotEmpty()): ?>
            
            <nav class="model-strip" aria-label="Modelos de iPhone">
                <?php $__currentLoopData = $iphones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iphone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="model-strip__item" href="#modelo-<?php echo e($iphone->id); ?>">
                        <span class="model-strip__icon"><?php echo $__env->make('iphones.partials.phone', ['tipo' => 'icono'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                        <span class="model-strip__name"><?php echo e($iphone->modelo); ?></span>
                        <?php if($iphone->nuevo): ?>
                            <span class="badge">Nuevo</span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>

            
            <section class="hero" aria-labelledby="hero-titulo">
                <div class="hero__top">
                    <div>
                        <h2 id="hero-titulo" class="hero__title"><?php echo e($destacado->modelo); ?></h2>
                        <p class="hero__text"><?php echo e($destacado->descripcion); ?></p>
                    </div>
                    <a class="btn" href="#modelo-<?php echo e($destacado->id); ?>">Más información</a>
                </div>
                <div class="hero__visual">
                    <?php echo $__env->make('iphones.partials.phone', ['iphone' => $destacado, 'tipo' => 'foto'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>

    
    <section class="family" id="familia" aria-labelledby="familia-titulo">
        <div class="container family__head">
            <h2 id="familia-titulo" class="family__title">Conoce a la familia.</h2>
            <?php if($iphones->isNotEmpty()): ?>
                <div class="family__arrows">
                    <button type="button" class="arrow" data-carousel="prev" aria-label="Anterior">&#8249;</button>
                    <button type="button" class="arrow" data-carousel="next" aria-label="Siguiente">&#8250;</button>
                </div>
            <?php endif; ?>
        </div>

        <?php if($iphones->isEmpty()): ?>
            <div class="container">
                <p class="empty">No hay iPhones disponibles por ahora. Vuelve pronto.</p>
            </div>
        <?php else: ?>
            <div class="carousel" id="carousel">
                <?php $__currentLoopData = $iphones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iphone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $agotado = $iphone->stock < 1; ?>

                    <article class="card" id="modelo-<?php echo e($iphone->id); ?>" style="--c: <?php echo e($iphone->color_hex); ?>">
                        <div class="card__media">
                            <?php echo $__env->make('iphones.partials.phone', ['tipo' => 'foto'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        <div class="card__dots">
                            <span class="dot" title="<?php echo e($iphone->color); ?>"></span>
                        </div>

                        <div class="card__body">
                            <?php if($iphone->nuevo): ?>
                                <p class="badge">Nuevo</p>
                            <?php endif; ?>
                            <h3 class="card__name"><?php echo e($iphone->modelo); ?></h3>
                            <p class="card__desc"><?php echo e($iphone->descripcion); ?></p>
                            <p class="card__spec"><?php echo e($iphone->almacenamiento); ?> en <?php echo e($iphone->color); ?></p>
                            <p class="card__price">$<?php echo e(number_format($iphone->precio, 2)); ?></p>

                            <?php if($agotado): ?>
                                <p class="card__stock card__stock--out">Agotado</p>
                            <?php elseif($iphone->stock <= 3): ?>
                                <p class="card__stock card__stock--low">Quedan <?php echo e($iphone->stock); ?></p>
                            <?php else: ?>
                                <p class="card__stock">Disponible</p>
                            <?php endif; ?>

                            <form action="<?php echo e(route('iphones.comprar', $iphone->id)); ?>" method="POST" class="buy">
                                <?php echo csrf_field(); ?>
                                <label class="buy__qty">
                                    <span class="sr-only">Cantidad</span>
                                    <select name="cantidad" <?php if($agotado): echo 'disabled'; endif; ?>>
                                        <?php for($i = 1; $i <= min($iphone->stock, 5); $i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                        <?php if($agotado): ?>
                                            <option>0</option>
                                        <?php endif; ?>
                                    </select>
                                </label>
                                <button type="submit" class="btn" <?php if($agotado): echo 'disabled'; endif; ?>>Comprar</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mi_proyecto\resources\views/iphones/index.blade.php ENDPATH**/ ?>