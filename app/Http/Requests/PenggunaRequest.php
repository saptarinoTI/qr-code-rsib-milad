<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaRequest extends FormRequest
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
        // Cek apakah ini update atau create
        $userId = $this->route('pengguna'); // pakai nullsafe operator (Laravel 9+)
        $isUpdate = $userId !== null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],

            // validasi email unik, tapi abaikan user sendiri jika update
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($userId),
            ],

            // password wajib saat create, tapi boleh null saat update
            'password' => [
                $isUpdate ? 'nullable' : 'required',
                'min:8',
            ],
        ];
    }
}
