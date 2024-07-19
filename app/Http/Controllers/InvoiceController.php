<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Store a newly created invoice in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

      public function index()
    {
        $invoices = Invoice::with('orders.item')->get();
        return response()->json($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::with('orders.item')->findOrFail($id);
        return response()->json($invoice);
    }


    public function store(Request $request)
{
    $request->validate([
        'order_ids' => 'required|array',
        'order_ids.*' => 'exists:orders,id',
    ]);

    // Generate the invoice name
    $invoice = new Invoice();
    $invoice->invoice_name = 'INV-' . strtoupper(Str::random(8));
    $invoice->save();

    // Attach the orders to the invoice
    $invoice->orders()->attach($request->order_ids);

    return response()->json($invoice->load('orders'), 201);
}


    


 
}
