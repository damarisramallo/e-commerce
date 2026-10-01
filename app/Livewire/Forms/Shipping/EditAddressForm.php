<?php

namespace App\Livewire\Forms\Shipping;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditAddressForm extends Form
{
    public $id;
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

    public function edit($address)
    {
        // $this->id = $address['id'];
        // $this->type = $address['type'];
        // $this->address = $address['address'];
        // $this->city = $address['city'];
        // $this->state = $address['state'];
        // $this->reference = $address['reference'];
        // $this->receiver = $address['receiver'];
        // $this->receiver_info = $address['receiver_info'];
        // $this->is_default = $address['is_default'];

        $this->id = $address->id;
        $this->type = $address->type;
        $this->address = $address->address;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->reference = $address->reference;
        $this->receiver = $address->receiver;
        $this->receiver_info = $address->receiver_info;
        $this->is_default = $address->is_default;
    }

    public function update()
    {
        $this->validate();

        $address = Address::find($this->id);

        $address->update([
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
    }
}
