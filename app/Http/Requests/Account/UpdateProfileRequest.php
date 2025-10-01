<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $provinceId = (int) $this->input('province_id');
        $districtId = (int) $this->input('district_id');

        return [
            'name'         => ['required','string','max:255'],
            'phone'        => ['required','string','max:20'],
            'province_id'  => ['required','integer', Rule::exists('provinces','id')],
            'district_id'  => [
                'required','integer',
                Rule::exists('districts','id')->where('province_id', $provinceId)
            ],
            'ward_id'      => [
                'required','integer',
                Rule::exists('wards','id')->where('district_id', $districtId)
            ],
            'address_line' => ['required','string','max:255'],
            'avatar'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'province_id' => (int) $this->input('province_id'),
            'district_id' => (int) $this->input('district_id'),
            'ward_id'     => (int) $this->input('ward_id'),
        ]);
    }
}
