<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkGroupRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'employee_ids' => 'nullable|array',
            'employee_ids.*' => 'exists:employees,id',
        ];
    }

    public function after()
    {
        return [
            function ($validator) {
                if ($this->employee_ids) {
                    foreach ($this->employee_ids as $employeeId) {
                        // Buscar si el empleado está en otro grupo
                        $exists = \App\Models\WorkGroup::whereHas('employees', function($q) use ($employeeId) {
                            $q->where('employee_id', $employeeId);
                        })->exists();
                        
                        if ($exists) {
                            $validator->errors()->add('employee_ids', 'Ese empleado ya está asignado a otro grupo de trabajo.');
                            break;
                        }
                    }
                }
            }
        ];
    }

    public function messages()
    {
        return [
            'vehiculo_id.exists' => 'El vehículo seleccionado no existe.',
            'employee_ids.*.exists' => 'Uno o más empleados no existen.',
        ];
    }
}
