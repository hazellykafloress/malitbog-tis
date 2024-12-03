<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountStoreRequest extends FormRequest
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
      'name' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('users')->where(function ($query) {
          return $query->whereNull('deleted_at');
        }),
      ],
      'password' => 'required|confirmed|min:8',
      'establishment_name' => 'required',
      'establishment_description' => 'required',
      'establishment_address' => 'required',
      'establishment_contact_number' => 'required',
      'establishment_mode_of_access' => 'required',
      'establishment_type_of_business' => 'required'
    ];
  }
}
