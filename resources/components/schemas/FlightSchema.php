<?php

/**
 * @OA\Schema(
 *     schema="Flight",
 *     type="object",
 *     title="Flight Schema",
 *     description="Modelo de un vuelo",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="departureCity", type="string", example="New York"),
 *     @OA\Property(property="arrivalCity", type="string", example="London"),
 *     @OA\Property(property="dateDeparture", type="string", format="date-time", example="2024-11-15T08:00:00Z"),
 *     @OA\Property(property="dateArrival", type="string", format="date-time", example="2024-11-15T16:00:00Z"),
 *     @OA\Property(property="itinerary_id", type="integer", example=123)
 * )
 */
