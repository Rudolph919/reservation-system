<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date',
            'resourceId' => 'required|exists:resources,id',
            'guestName' => 'required|max:255',
            'guestEmail' => 'required|email|max:255',
            'guestPhone' => 'required|max:255',
            'guestCount' => 'required|numeric|min:1',
        ];
    }
}
