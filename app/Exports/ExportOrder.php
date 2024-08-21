<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Province; // Import the Province model
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ExportOrder implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Select the necessary fields from the Order model
        $orders = Order::select(
            'id',
            'invoice_number',
            'subtotal',
            'shipping',
            'grand_total',
            'payment_status',
            'status',
            'shipped_date',
            'first_name',
            'last_name',
            'email',
            'mobile',
            'province_id',
            'address',
            'apartment',
            'city',
            'state',
            'zip',
            'notes'
        )->get();

        // Map and format the order data as needed
        $orders = $orders->map(function ($order) {
            $paymentStatusMap = [
                1 => 'Waiting Payment',
                2 => 'Paid',
                3 => 'Expired',
                4 => 'Cancelled',
            ];

            // Retrieve the province name using the Province model
            if ($order->province_id === 'rest_of_world') {
                $provinceName = 'Rest of The World';
            } else {
                $province = Province::find($order->province_id);
                $provinceName = $province ? $province->name : '';
            }

            return [
                'ID' => $order->id,
                'Invoice Number' => $order->invoice_number,
                'Subtotal' => $order->subtotal,
                'Shipping' => $order->shipping,
                'Grand Total' => $order->grand_total,
                'Payment Status' => $paymentStatusMap[$order->payment_status] ?? 'Unknown', // Map payment status
                'Order Status' => $order->status, // Conditionally set status
                'Shipped Date' => $order->shipped_date,
                'First Name' => $order->first_name,
                'Last Name' => $order->last_name,
                'Email' => $order->email,
                'Mobile' => $order->mobile,
                'Province' => $provinceName, // Use 'Province' instead of 'Province ID'
                'Address' => $order->address,
                'Apartment' => $order->apartment,
                'City' => $order->city,
                'State' => $order->state,
                'ZIP' => $order->zip,
                'Notes' => $order->notes,
            ];
        });

        return $orders;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Invoice Number',
            'Subtotal',
            'Shipping',
            'Grand Total',
            'Payment Status',
            'Order Status',
            'Shipped Date',
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Province', // Change 'Province ID' to 'Province'
            'Address',
            'Apartment',
            'City',
            'State',
            'ZIP',
            'Notes',
        ];
    }
}