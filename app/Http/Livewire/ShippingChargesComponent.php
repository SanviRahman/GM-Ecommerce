<?php

namespace App\Http\Livewire;

use App\ShippingCharge; // Import the model
use Livewire\Component;

class ShippingChargesComponent extends Component
{
    public $shippingCharges, $name, $charge, $shippingChargeId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'charge' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->shippingCharges = ShippingCharge::all();
    }

    public function save()
    {
        $this->validate();

        ShippingCharge::updateOrCreate(
            ['id' => $this->shippingChargeId],
            ['name' => $this->name, 'charge' => $this->charge]
        );

        $this->resetInputFields();
        $this->shippingCharges = ShippingCharge::all(); // Refresh the list
        session()->flash('message', 'Shipping Charge saved successfully.');
    }

    public function edit($id)
    {
        $shippingCharge = ShippingCharge::find($id);
        $this->shippingChargeId = $shippingCharge->id;
        $this->name = $shippingCharge->name;
        $this->charge = $shippingCharge->charge;
    }

    public function delete($id)
    {
        ShippingCharge::find($id)->delete();
        $this->shippingCharges = ShippingCharge::all(); // Refresh the list
        session()->flash('message', 'Shipping Charge deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->charge = '';
        $this->shippingChargeId = null;
    }

    public function render()
    {
        return view('livewire.shipping-charges-component');
    }
}
