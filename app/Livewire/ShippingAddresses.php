<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Livewire\Forms\Shipping\EditAddressForm;
use App\Models\Address;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = false;

    public CreateAddressForm $createAddress;

    public EditAddressForm $editAddress;


    public function mount()
    {
        $this->addresses = Address::where('user_id', auth()->id())->get();

        $this->createAddress->receiver_info = [
            'name' => auth()->user()->name,
            'last_name' => auth()->user()->last_name,
            'document_type' => auth()->user()->document,
            'document_number' => auth()->user()->document_number,
            'phone' => auth()->user()->phone,
        ];

    }

    public function store()
    {
        $this->createAddress->save();

        $this->addresses = Address::where('user_id', auth()->id())->get();

        $this->newAddress = true;
    }

    public function edit($id)
    {
        $address = Address::find($id);

        $this->editAddress->edit($address);
    }

    public function update()
    {

        $this->editAddress->update();

        $this->addresses = Address::where('user_id', auth()->id())->get();

    }

    public function setDefaultAddress($id)
    {
        $this->addresses->each(function($address) use ($id) {
            $address->update([
                'is_default' => $address->id == $id 
            ]);
        });
    }

    public function deleteAddress($id)
    {

        Address::find($id)->delete();

        $this->addresses = Address::where('user_id', auth()->id())->get();

        if ($this->addresses->where('is_default', true)->count() == 0 && $this->addresses->count() > 0) {
            $this->addresses->first()->update(['is_default' => true]);
        }
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
