<?php

namespace App\Exports;

use App\Models\ShippingCharge;
use App\Models\Province;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportShipping implements FromCollection, WithHeadings
{
    public function collection()
    {
        $shippingCharges = ShippingCharge::select(
            'province_id',
            'amount'
        )->get();
        
        $shippingCharges = $shippingCharges->map(function ($shippingCharge) {
            if ($shippingCharge->province_id === 'rest_of_world') {
                $provinceName = 'Rest of The World';
            } else {
                $province = Province::find($shippingCharge->province_id);
                $provinceName = $province ? $province->name : '';
            }

            return [
                'province' => $provinceName,
                'amount' => $shippingCharge->amount,
            ];
        });

        // Add 'Rest of World' if it doesn't exist in the ShippingCharge table
        if (!$shippingCharges->contains('province', 'Rest of World')) {
            $shippingCharges->push([
                'province' => 'Rest of The World',
                'amount' => '', // You can set the amount to an empty string or any default value
            ]);
        }
    
        return $shippingCharges;
    }
    
    public function headings(): array
    {
        return [
            'Province Name',
            'Amount',
        ];
    }
}