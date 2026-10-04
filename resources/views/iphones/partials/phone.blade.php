{{--
    Imagen del iPhone.
    Variables: $iphone (obligatoria) y $tipo (opcional): 'foto' (por defecto) o 'icono'.
      - 'foto'  -> usa la imagen guardada en la columna "imagen" (public/img/iphones).
      - 'icono' -> usa el archivo con el mismo nombre y extensión .png (ej: iphone-air.png),
                   y si no existe usa la foto.
    Si el producto no tiene imagen se dibuja un iPhone vectorial con su color_hex.
--}}
@php
    $tipo = $tipo ?? 'foto';
    $archivo = $iphone->imagen;

    if ($archivo && $tipo === 'icono') {
        $icono = pathinfo($archivo, PATHINFO_FILENAME) . '.png';
        if (file_exists(public_path('img/iphones/' . $icono))) {
            $archivo = $icono;
        }
    }
@endphp
@if($archivo)
    <img class="phone-img phone-img--{{ $tipo }}"
         src="{{ asset('img/iphones/' . $archivo) }}"
         alt="{{ $tipo === 'icono' ? '' : $iphone->modelo . ' en color ' . $iphone->color }}"
         loading="lazy">
@else
@php $esPro = str_contains(strtolower($iphone->modelo), 'pro'); @endphp
<svg class="phone" viewBox="0 0 220 440" aria-hidden="true" focusable="false"
     style="--c: {{ $iphone->color_hex }}">
    <rect class="phone__frame" x="6" y="6" width="208" height="428" rx="44"/>
    <rect class="phone__body" x="13" y="13" width="194" height="414" rx="37"/>
    <rect class="phone__gloss" x="13" y="13" width="97" height="414" rx="37"/>
    @if($esPro)
        <rect class="phone__bump" x="26" y="26" width="92" height="96" rx="26"/>
        <circle class="phone__lens-ring" cx="54" cy="52" r="17"/>
        <circle class="phone__lens" cx="54" cy="52" r="12"/>
        <circle class="phone__lens-ring" cx="54" cy="96" r="17"/>
        <circle class="phone__lens" cx="54" cy="96" r="12"/>
        <circle class="phone__lens-ring" cx="94" cy="74" r="17"/>
        <circle class="phone__lens" cx="94" cy="74" r="12"/>
    @else
        <rect class="phone__bump" x="26" y="26" width="86" height="92" rx="26"/>
        <circle class="phone__lens-ring" cx="52" cy="50" r="17"/>
        <circle class="phone__lens" cx="52" cy="50" r="12"/>
        <circle class="phone__lens-ring" cx="52" cy="94" r="17"/>
        <circle class="phone__lens" cx="52" cy="94" r="12"/>
    @endif
    <circle class="phone__flash" cx="98" cy="38" r="5"/>
</svg>
@endif
