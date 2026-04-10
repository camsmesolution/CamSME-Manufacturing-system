<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockAdjustmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['sometimes', 'required', 'exists:products,id'],
            'location_id' => ['sometimes', 'required', 'exists:locations,id'],
            'lot_id' => ['nullable', 'exists:lots,id'],
            'quantity' => ['sometimes', 'required', 'numeric', 'not_in:0'],
            'reason' => ['sometimes', 'required', 'in:physical_count,purchase,correction,loss,damage,initial,manufacturing_consumption,manufacturing_production,mo_cancelled,manufacturing_consumption_update,consumption_reversal'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.not_in' => 'Quantity cannot be zero.',
        ];
    }
}
