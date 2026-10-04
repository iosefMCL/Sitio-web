
<?php
    $tipo = $tipo ?? 'foto';
    $archivo = $iphone->imagen;

    if ($archivo && $tipo === 'icono') {
        $icono = pathinfo($archivo, PATHINFO_FILENAME) . '.png';
        if (file_exists(public_path('img/iphones/' . $icono))) {
            $archivo = $icono;
        }
    }
?>
<?php if($archivo): ?>
    <img class="phone-img phone-img--<?php echo e($tipo); ?>"
         src="<?php echo e(asset('img/iphones/' . $archivo)); ?>"
         alt="<?php echo e($tipo === 'icono' ? '' : $iphone->modelo . ' en color ' . $iphone->color); ?>"
         loading="lazy">
<?php else: ?>
<?php $esPro = str_contains(strtolower($iphone->modelo), 'pro'); ?>
<svg class="phone" viewBox="0 0 220 440" aria-hidden="true" focusable="false"
     style="--c: <?php echo e($iphone->color_hex); ?>">
    <rect class="phone__frame" x="6" y="6" width="208" height="428" rx="44"/>
    <rect class="phone__body" x="13" y="13" width="194" height="414" rx="37"/>
    <rect class="phone__gloss" x="13" y="13" width="97" height="414" rx="37"/>
    <?php if($esPro): ?>
        <rect class="phone__bump" x="26" y="26" width="92" height="96" rx="26"/>
        <circle class="phone__lens-ring" cx="54" cy="52" r="17"/>
        <circle class="phone__lens" cx="54" cy="52" r="12"/>
        <circle class="phone__lens-ring" cx="54" cy="96" r="17"/>
        <circle class="phone__lens" cx="54" cy="96" r="12"/>
        <circle class="phone__lens-ring" cx="94" cy="74" r="17"/>
        <circle class="phone__lens" cx="94" cy="74" r="12"/>
    <?php else: ?>
        <rect class="phone__bump" x="26" y="26" width="86" height="92" rx="26"/>
        <circle class="phone__lens-ring" cx="52" cy="50" r="17"/>
        <circle class="phone__lens" cx="52" cy="50" r="12"/>
        <circle class="phone__lens-ring" cx="52" cy="94" r="17"/>
        <circle class="phone__lens" cx="52" cy="94" r="12"/>
    <?php endif; ?>
    <circle class="phone__flash" cx="98" cy="38" r="5"/>
</svg>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\mi_proyecto\resources\views/iphones/partials/phone.blade.php ENDPATH**/ ?>