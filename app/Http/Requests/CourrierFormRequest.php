<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Electeur;


class CourrierFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		return [
            'courrier_objet' => 'required|string|max:255',
            'courrier_expediteur' => 'required|string|max:255',
            'courrier_numero' => 'required|unique:tb_courrier|integer',
            //'courrier_date_arrivee' => 'required|string|max:11',
            //'courrier_heure_arrivee' => 'string|max:5',
			//'courrier_fichier' => 'required|file|mimes:jpeg,pdf|max:2048',
			
		];
    }
}
