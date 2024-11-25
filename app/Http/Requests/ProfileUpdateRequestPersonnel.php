<?php

namespace App\Http\Requests;

use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequestPersonnel extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'middle_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'extra_add' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'birthday' => 'date|before_or_equal:today',
            'address' => ['string', 'max:255'],
            'service_cat' => ['string', 'max:255'],
            'phone' => ['string', 'max:255', 'regex:/^(09|\+639)\d{9}$/', Rule::unique(Personnel::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:255', Rule::unique(Personnel::class)->ignore($this->user()->id)],
        ];
    }
}
