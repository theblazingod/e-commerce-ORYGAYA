<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    public function adjustInventory(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_change' => 'required|integer',
            'reason' => 'required|string|max:255',
        ]);

        $product = Product::find($validatedData['product_id']);
        $newInventoryCount = $product->inventory_count + $validatedData['quantity_change'];

        if ($newInventoryCount < 0) {
            return response()->json(['message' => 'Invalid quantity change. Inventory count cannot be negative.'], Response::HTTP_BAD_REQUEST);
        }

        $product->inventory_count = $newInventoryCount;
        $product->save();

        return response()->json(['message' => __('general.inventory_adjusted_successfully'), 'product' => $product], Response::HTTP_OK);
    }
}
