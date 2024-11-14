<?php

namespace App\Http\Controllers\Api;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * @OA\Schema(
 *     schema="Itinerary",
 *     type="object",
 *     title="Itinerary Schema",
 *     description="Esquema de un itinerario",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="departureCity", type="string", example="New York"),
 *     @OA\Property(property="arrivalCity", type="string", example="London"),
 *     @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15"),
 *     @OA\Property(property="timeDeparture", type="string", example="08:00:00")
 * )
 */
class ItineraryController
{
    /**
     * @OA\Get(
     *     path="/api/itineraries",
     *     summary="Obtener todos los itinerarios",
     *     tags={"Itineraries"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de itinerarios",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Itinerary")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error fetching itineraries"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $itineraries = Itinerary::all();
            return response()->json($itineraries, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error fetching itineraries', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/itineraries",
     *     summary="Crear un itinerario",
     *     tags={"Itineraries"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="departureCity", type="string", example="New York"),
     *             @OA\Property(property="arrivalCity", type="string", example="London"),
     *             @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15"),
     *             @OA\Property(property="timeDeparture", type="string", example="08:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Itinerario creado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al guardar el itinerario",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error saving itinerary"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $itinerary = new Itinerary();
            $itinerary->departureCity = $request->departureCity;
            $itinerary->arrivalCity = $request->arrivalCity;
            $itinerary->dateDeparture = $request->dateDeparture;
            $itinerary->timeDeparture = $request->timeDeparture;

            $itinerary->save();

            return response()->json(['id' => $itinerary->id], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error saving itinerary', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/itineraries/{id}",
     *     summary="Obtener un itinerario por ID",
     *     tags={"Itineraries"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del itinerario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del itinerario",
     *         @OA\JsonContent(ref="#/components/schemas/Itinerary")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Itinerario no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Itinerary not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener el itinerario",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error fetching itinerary"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        try {
            $itinerary = Itinerary::findOrFail($id);
            return response()->json($itinerary, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Itinerary not found', 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/itineraries/{id}",
     *     summary="Actualizar un itinerario",
     *     tags={"Itineraries"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del itinerario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="departureCity", type="string", example="New York"),
     *             @OA\Property(property="arrivalCity", type="string", example="London"),
     *             @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15"),
     *             @OA\Property(property="timeDeparture", type="string", example="08:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Itinerario actualizado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Itinerary updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar el itinerario",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error updating itinerary"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $itinerary = Itinerary::findOrFail($id);
            $itinerary->departureCity = $request->departureCity;
            $itinerary->arrivalCity = $request->arrivalCity;
            $itinerary->dateDeparture = $request->dateDeparture;
            $itinerary->timeDeparture = $request->timeDeparture;

            $itinerary->save();

            return response()->json(['message' => 'Itinerary updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error updating itinerary', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/itineraries/{id}",
     *     summary="Eliminar un itinerario",
     *     tags={"Itineraries"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del itinerario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Itinerario eliminado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Itinerary deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar el itinerario",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error deleting itinerary"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $itinerary = Itinerary::findOrFail($id);
            $itinerary->delete();
            return response()->json(['message' => 'Itinerary deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting itinerary', 'message' => $e->getMessage()], 500);
        }
    }
}
