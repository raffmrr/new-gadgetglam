<?php

namespace App\Imports;

use App\Models\Province;
use App\Models\ShippingCharge;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippingImport implements ToModel
{
    public function model(array $row)
    {
        // Find the province based on the province name
        $province = Province::where('name', $row[0])->first();

        // Check if the province exists
        if ($province) {
            return new ShippingCharge([
                'province_id' => $province->id, // Set the province_id to the ID of the province
                'amount' => $row[1],
            ]);
        }

        // Handle the case where the province doesn't exist (you can log an error or handle it as needed)
        return null;
    }
}