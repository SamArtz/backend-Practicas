<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSendController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'recipient_email' => ['required', 'email'],

            'customer' => ['required', 'string'],
            'email' => ['required', 'email'],
            'payment_method' => ['required', 'integer'],

            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string'],
            'products.*.price' => ['required', 'numeric'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $to = $validated['recipient_email'];
        $data = $validated;
        unset($data['recipient_email']);

        Mail::to($to)->send(new PurchaseEmail($data));

        return response()->json([
            'message' => 'Email enviado',
            'to' => $to,
        ]);
    }
}
