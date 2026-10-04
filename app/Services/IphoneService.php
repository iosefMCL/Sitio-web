<?php

namespace App\Services;

use App\Models\Iphone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Capa de servicio: concentra la lógica de negocio de la tienda.
 * El controlador solo recibe la petición y delega aquí el trabajo.
 */
class IphoneService
{
    /**
     * Devuelve el catálogo completo ordenado por id.
     * Los equipos sin stock se incluyen para mostrarlos como "Agotado".
     */
    public function listarCatalogo(): Collection
    {
        return Iphone::orderBy('id')->get();
    }

    /**
     * Procesa la compra de un iPhone verificando el stock disponible.
     * Se ejecuta dentro de una transacción con bloqueo de fila para que dos
     * compras simultáneas no vendan la misma unidad.
     *
     * @throws \Exception si no hay stock suficiente
     */
    public function procesarCompra(int $iphoneId, int $cantidad): array
    {
        return DB::transaction(function () use ($iphoneId, $cantidad) {
            $iphone = Iphone::lockForUpdate()->findOrFail($iphoneId);

            if ($iphone->stock < $cantidad) {
                throw new \Exception(
                    "Stock insuficiente para el modelo {$iphone->modelo}. Disponibles: {$iphone->stock}."
                );
            }

            // Descontar del stock
            $iphone->stock -= $cantidad;
            $iphone->save();

            return [
                'status'   => 'exito',
                'mensaje'  => 'Compra realizada correctamente',
                'cantidad' => $cantidad,
                'total'    => $iphone->precio * $cantidad,
                'iphone'   => $iphone,
            ];
        });
    }
}
