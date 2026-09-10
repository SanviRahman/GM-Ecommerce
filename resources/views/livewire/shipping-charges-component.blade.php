<div>
    <h1>Shipping Charges</h1>

    @if (session()->has('message'))
        <div style="color: green;">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="row gy-2">
            <div class="form-group col-md-6">
                <input type="text" wire:model="name" placeholder="Shiping Name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
               <input type="number" wire:model="charge" placeholder="Charge" class="form-control" step="0.01" required> 
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <h2>Shipping Charges List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Region</th>
                <th>Charge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippingCharges as $key => $shippingCharge)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $shippingCharge->name }}</td>
                    <td>{{ number_format($shippingCharge->charge, 2) }}</td>
                    <td>
                        <button wire:click="edit({{ $shippingCharge->id }})" class="btn btn-sm btn-info">Edit</button>
                        <button wire:click="delete({{ $shippingCharge->id }})" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
