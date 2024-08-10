<?php

namespace App\Http\Controllers\admin;

use App\Exports\ExportShipping;
use App\Http\Controllers\Controller;
use App\Imports\ShippingImport;
use App\Models\Province; // Change Country to Province
use App\Models\ShippingCharge;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ShippingController extends Controller
{
    public function create() {
        $provinces = Province::get(); // Fetch provinces
        $data['provinces'] = $provinces;

        $shippingCharges = ShippingCharge::select('shipping_charges.*', 'provinces.name')
                    ->leftJoin('provinces', 'provinces.id', 'shipping_charges.province_id')->get();
       
        $data['shippingCharges'] = $shippingCharges;
        return view('admin.shipping.create', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'province' => 'required',
            'amount' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $count = ShippingCharge::where('province_id', $request->province)->count();
            if ($count > 0) {
                session()->flash('error', 'Shipping Already Added');
                return response()->json(['status' => true]);
            }

            $shipping = new ShippingCharge();
            $shipping->province_id = $request->province; // Change to province_id
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping Added Successfully');
            return response()->json(['status' => true]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) {
        $shippingCharge = ShippingCharge::find($id);

        $provinces = Province::get(); // Fetch provinces
        $data['provinces'] = $provinces;
        $data['shippingCharge'] = $shippingCharge;

        return view('admin.shipping.edit', $data);
    }

    public function update($id, Request $request) {
        $shipping = ShippingCharge::find($id);

        $validator = Validator::make($request->all(), [
            'province' => 'required',
            'amount' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            if ($shipping == null) {
                session()->flash('error', 'Shipping Not Found');
                return response()->json(['status' => true]);
            }

            $shipping->province_id = $request->province; // Change to province_id
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping Updated Successfully');
            return response()->json(['status' => true]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id) {
        $shippingCharge = ShippingCharge::find($id);

        if ($shippingCharge == null) {
            session()->flash('error', 'Shipping Not Found');
            return response()->json(['status' => true]);
        }

        $shippingCharge->delete();
        session()->flash('success', 'Shipping Deleted Successfully');
        return response()->json(['status' => true]);
    }

    public function export_excel() {
        return Excel::download(new ExportShipping, "shipping.xlsx");
    }

    public function import_excel() {
        try {
            Excel::import(new ShippingImport, request()->file('file'));
            session()->flash('success', 'Excel file imported successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error importing Excel file: ' . $e->getMessage());
        }

        return back();
    }

    public function export_pdf() {
        $shippingCharges = ShippingCharge::with('province')->get(); // Fetch with province relation
        $data['shippingCharges'] = $shippingCharges;
        $now = Carbon::now()->format('Y-m-d');
        $data['now'] = $now;

        $pdf = PDF::loadView('admin.report.shipping', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Shipping.pdf');
    }
}
