<?php

namespace App\Http\Controllers;

use App\Services\IphoneService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IphoneController extends Controller
{
    protected IphoneService $iphoneService;

    public function __construct(IphoneService $iphoneService)
    {
        $this->iphoneService = $iphoneService;
    }

    /**
     * Muestra el catálogo.
     */
    public function index()
    {
        $iphones = $this->iphoneService->listarCatalogo();

        return view('iphones.index', compact('iphones'));
    }

    /**
     * Valida la petición y delega la compra a la capa de servicio.
     */
    public function comprar(Request $request, int $id)
    {
        $datos = $request->validate([
            'cantidad' => ['required', 'integer', 'min:1', 'max:5'],
        ], [
            'cantidad.*' => 'La cantidad debe ser un número entre 1 y 5.',
        ]);

        try {
            $resultado = $this->iphoneService->procesarCompra($id, (int) $datos['cantidad']);

            $mensaje = sprintf(
                '%s: %d × %s. Total: $%s',
                $resultado['mensaje'],
                $resultado['cantidad'],
                $resultado['iphone']->modelo,
                number_format($resultado['total'], 2)
            );

            return back()->with('exito', $mensaje);
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Este modelo ya no está disponible.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
