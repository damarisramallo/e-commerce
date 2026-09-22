<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;

class CreateAddressForm extends Form
{
    public $type = '';
    public $address = '';
    public $city = '';
    public $state = '';
    public $reference = '';
    public $receiver = 1;
    public $receiver_info = [];
    public $is_default = false;

    public function rules(): array
    {
        return [
            'type' => 'required|in:1,2',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string|max:255',
            'receiver_info.last_name' => 'required|string|max:255',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocuments::class),
            ],
            'receiver_info.document_number' => 'required|string|max:255',
            'receiver_info.phone' => 'required|string|max:255',
        ];
    }

    public function validationAttributes()
    {
        return [
            'user_id' => auth()->id(),
            'type' => 'tipo de dirección',
            'address' => 'dirección',
            'city' => 'ciudad',
            'state' => 'provincia',
            'reference' => 'referencia',
            'receiver' => 'destinatario',
            'receiver_info.name' => 'nombre del destinatario',
            'receiver_info.last_name' => 'apellido del destinatario',
            'receiver_info.document_type' => 'tipo de documento del destinatario',
            'receiver_info.document_number' => 'número de documento del destinatario',
            'receiver_info.phone' => 'teléfono del destinatario',
        ];
    }

    public function save()
    {
        $this->validate();

        if(auth()->user()->addresses()->count() == 0) {
            $this->is_default = false;
        }

        Address::create([
            'user_id' => auth()->id(),
            'type' => $this->type,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'is_default' => $this->is_default,
        ]);

        $this->reset();

        $this->receiver_info = [
            'name' => auth()->user()->name,
            'last_name' => auth()->user()->last_name,
            'document_type' => auth()->user()->document,
            'document_number' => auth()->user()->document_number,
            'phone' => auth()->user()->phone,
        ];


    }
}
