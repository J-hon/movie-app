<?php

namespace App\Http\Requests;

use App\Rules\MaxMovieRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddMovieToListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'movie_id' => ['required', 'exists:movies,id', new MaxMovieRule()]
        ];
    }
}
