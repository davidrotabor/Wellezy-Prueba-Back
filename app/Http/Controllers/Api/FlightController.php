<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;



 /**
 * @OA\Schema(
 *     schema="Flight",
 *     type="object",
 *     title="Flight Schema",
 *     description="Esquema de un vuelo",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="departureCity", type="string", example="New York"),
 *     @OA\Property(property="arrivalCity", type="string", example="London"),
 *     @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15T08:00:00Z"),
 *     @OA\Property(property="dateArrival", type="string", format="date-time", example="2024-11-15T16:00:00Z"),
 *     @OA\Property(property="itinerary_id", type="integer", example=123)
 * )
 */


class FlightController
{
    /**
     * @OA\Get(
     *     path="/api/flights",
     *     summary="Obtener todos los vuelos",
     *     tags={"Flights"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vuelos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Flight")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error fetching flights"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $flights = Flight::all();
            return response()->json($flights, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error fetching flights', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/flights",
     *     summary="Crear un vuelo",
     *     tags={"Flights"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="departureCity", type="string", example="New York"),
     *             @OA\Property(property="arrivalCity", type="string", example="London"),
     *             @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15T08:00:00Z"),
     *             @OA\Property(property="dateArrival", type="string", format="date-time", example="2024-11-15T16:00:00Z"),
     *             @OA\Property(property="itinerary_id", type="integer", example=123)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vuelo creado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al guardar el vuelo",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error saving flight"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $flight = new Flight();
            $flight->departureCity = $request->departureCity;
            $flight->arrivalCity = $request->arrivalCity;
            $flight->dateDeparture = $request->dateDeparture;
            $flight->dateArrival = $request->dateArrival;
            $flight->itinerary_id = $request->itinerary_id;

            $flight->save();

            return response()->json(['id' => $flight->id], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error saving flight', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/flights/{id}",
     *     summary="Obtener un vuelo por ID",
     *     tags={"Flights"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del vuelo",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del vuelo",
     *         @OA\JsonContent(ref="#/components/schemas/Flight")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vuelo no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Flight not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener el vuelo",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error fetching flight"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        try {
            $flight = Flight::findOrFail($id);
            return response()->json($flight, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Flight not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error fetching flight', 'message' => $e->getMessage()], 500);
        }
    }

    // Agrega las anotaciones correspondientes para los métodos `update` y `destroy`.
}
