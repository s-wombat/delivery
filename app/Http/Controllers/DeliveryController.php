<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
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
