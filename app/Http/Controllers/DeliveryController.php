<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{

/** 
 * @OA\Post(
 *      path="/deliveries",
 *      operationId="calculation",
 *      tags={"Delivery"},
 *      summary="Delivery calculation",
 * 
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="description", type="string", example="Important gift"),
 *                      @OA\Property(property="parcel_type", type="string", example="box"),
 *                      @OA\Property(property="options", type="object",
 *                          @OA\Property(property="size", type="string", example="medium"),
 *                          @OA\Property(property="delivery_type", type="string", example="international"),
 *                          @OA\Property(property="receive_type", type="string", example="ordered"),
 *                      ),
 *                  )
 *              }  
 *          ),
 *      ),
 * 
 *      @OA\Response(
 *          response="200",
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="value", type="int", example="48.50"), 
 *          ),
 *      ),
 * 
 * )
 * 
*/
    public function calculation(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'parcel_type' => 'required|string|max:255',
            'options.size' => 'required|string|max:255',
            'options.delivery_type' => 'required|string|max:255',
            'options.receive_type' => 'required|string|max:255',
        ]);

        array_walk_recursive($validated, function(&$value, $key) {
            $conf = config('delivery.parameters');

            if (array_key_exists($value, $conf)) {
                $value = $conf[$value];
            }
        });

        $sum = [];
        $sumOptions = 0;
        foreach ($validated['options'] as $value) {
            $sumOptions += $value;
        }

        $sum['value'] = $validated['parcel_type'] + $sumOptions;
        return $sum;
    }
}
