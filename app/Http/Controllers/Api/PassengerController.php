<?php

namespace App\Http\Controllers\Api;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * @OA\Schema(
 *     schema="Passenger",
 *     type="object",
 *     title="Passenger Schema",
 *     description="Esquema de un pasajero",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="idNumber", type="string", example="123456789"),
 *     @OA\Property(property="phoneNumber", type="string", example="555-1234"),
 *     @OA\Property(property="itinerary_id", type="integer", example=10)
 * )
 */


class PassengerController
{
    /**
 * @OA\Get(
 *     path="/api/passengers",
 *     summary="Obtener todos los pasajeros",
 *     tags={"Passengers"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de pasajeros",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Passenger")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error fetching passengers"),
 *             @OA\Property(property="message", type="string", example="Detalles del error")
 *         )
 *     )
 * )
 */


    public function index(): JsonResponse
    {
        try {
            $passengers = Passenger::all();
            return response()->json($passengers, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error fetching passengers', 'message' => $e->getMessage()], 500);
        }
    }

    /**
 * @OA\Post(
 *     path="/api/passengers",
 *     summary="Crear un pasajero",
 *     tags={"Passengers"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="idNumber", type="string", example="123456789"),
 *             @OA\Property(property="phoneNumber", type="string", example="555-1234"),
 *             @OA\Property(property="itinerary_id", type="integer", example=10)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pasajero creado con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error al guardar el pasajero",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error saving passenger"),
 *             @OA\Property(property="message", type="string", example="Detalles del error")
 *         )
 *     )
 * )
 */

    public function store(Request $request): JsonResponse
    {
        try {
            $passenger = Passenger::create([
                'name' => $request->name,
                'idNumber' => $request->idNumber,
                'phoneNumber' => $request->phoneNumber,
                'itinerary_id' => $request->itinerary_id,
            ]);

            return response()->json(['id' => $passenger->id], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error saving passenger', 'message' => $e->getMessage()], 500);
        }
    }

    /**
 * @OA\Get(
 *     path="/api/passengers/{id}",
 *     summary="Obtener un pasajero por ID",
 *     tags={"Passengers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del pasajero",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles del pasajero",
 *         @OA\JsonContent(ref="#/components/schemas/Passenger")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pasajero no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Passenger not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error fetching passenger"),
 *             @OA\Property(property="message", type="string", example="Detalles del error")
 *         )
 *     )
 * )
 */

    public function show(string $id): JsonResponse
    {
        try {
            $passenger = Passenger::findOrFail($id);
            return response()->json($passenger, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Passenger not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error fetching passenger', 'message' => $e->getMessage()], 500);
        }
    }
    /**
 * @OA\Put(
 *     path="/api/passengers/{id}",
 *     summary="Actualizar un pasajero",
 *     tags={"Passengers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del pasajero",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="idNumber", type="string", example="123456789"),
 *             @OA\Property(property="phoneNumber", type="string", example="555-1234"),
 *             @OA\Property(property="itinerary_id", type="integer", example=10)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pasajero actualizado con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Passenger updated successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pasajero no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Passenger not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error updating passenger"),
 *             @OA\Property(property="message", type="string", example="Detalles del error")
 *         )
 *     )
 * )
 */


    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $passenger = Passenger::findOrFail($id);
            $passenger->update([
                'name' => $request->name,
                'idNumber' => $request->idNumber,
                'phoneNumber' => $request->phoneNumber,
                'itinerary_id' => $request->itinerary_id,
            ]);

            return response()->json(['message' => 'Passenger updated successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Passenger not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error updating passenger', 'message' => $e->getMessage()], 500);
        }
    }

    /**
 * @OA\Delete(
 *     path="/api/passengers/{id}",
 *     summary="Eliminar un pasajero",
 *     tags={"Passengers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del pasajero",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pasajero eliminado con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Passenger deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pasajero no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Passenger not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error deleting passenger"),
 *             @OA\Property(property="message", type="string", example="Detalles del error")
 *         )
 *     )
 * )
 */


    public function destroy(string $id): JsonResponse
    {
        try {
            $passenger = Passenger::findOrFail($id);
            $passenger->delete();
            return response()->json(['message' => 'Passenger deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Passenger not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting passenger', 'message' => $e->getMessage()], 500);
        }
    }
}
