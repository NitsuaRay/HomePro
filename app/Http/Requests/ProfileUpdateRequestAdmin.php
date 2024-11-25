<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequestAdmin extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'lastname' => ['string', 'max:255'],
            'username' => ['string', 'max:255'],
            'extra_add' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone' => ['string', 'max:255', 'regex:/^(09|\+639)\d{9}$/', Rule::unique(Admin::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:255', Rule::unique(Admin::class)->ignore($this->user()->id)],
        ];
    }
}
