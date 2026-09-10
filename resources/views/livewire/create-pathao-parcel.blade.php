<div class="row">
    <h2 class="col-12 text-danger">{!!$errorMsg!!}</h2>
    <div class="col-md-6 card">
        <table class="table">
            <tr>
                <th>Order ID </th>
                <td>{{$merchantOrderId}}</td>
            </tr>
             <tr>
                <th>Recipient Name </th>
                <td>{{$recipientName}}</td>
            </tr>
             <tr>
                <th>Recipient Phone </th>
                <td>{{$recipientPhone}}</td>
            </tr>
            <tr>
                <th>Recipient Address </th>
                <td>{{$recipientAddress}}</td>
            </tr>
            
            <tr>
                <th>Item Quantity</th>
                <td>{{$itemQuantity}}</td>
            </tr>
            <tr>
                <th>Amount to Collect</th>
                <td>{{$amountToCollect}}</td>
            </tr>
            <tr>
                <th>Item Description</th>
                <td>{{$itemDescription}}</td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td>{{$orderStatus}}</td>
            </tr>
            <tr>
                <th>Pathao Delivery Charge</th>
                <td>{{$pathaoPrice}}</td>
            </tr>
        </table>
      
    </div>
@php
    $storeList = collect(); // Initialize an empty collection for storeList

    try {
        $storeUrl = $baseUrl . '/aladdin/api/v1/stores';
        $ch = curl_init($storeUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $storeResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200) {
            $storeData = json_decode($storeResponse, true); // Added missing '$'

            if (isset($storeData['type']) && $storeData['type'] === 'success') {
                $storeList = collect($storeData['data']['data']); // Convert to Collection
            }
        } else {
            throw new Exception('API request failed with response code ' . $httpcode);
        }
    } catch (Exception $e) {
        // Handle exceptions by logging or displaying an error message
        // You can use Laravel's logging or display the message as needed
        Log::error('Error fetching store data: ' . $e->getMessage());
        // Alternatively, you can set a flag or message to display on the frontend
        $errorMessage = $e->getMessage();
    }
@endphp
@php
    $cities = collect(); // Initialize an empty collection for cities

    try {
        $cityUrl = $baseUrl . '/aladdin/api/v1/city-list';
        $ch = curl_init($cityUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $cityResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200) {
            $cityData = json_decode($cityResponse, true);

            if (isset($cityData['type']) && $cityData['type'] === 'success') {
                $cities = collect($cityData['data']['data']); // Convert to Collection
            }
        } else {
            throw new Exception('API request failed with response code ' . $httpcode);
        }
    } catch (Exception $e) {
        // Handle exceptions by logging or displaying an error message
        // You can use Laravel's logging or display the message as needed
        Log::error('Error fetching city data: ' . $e->getMessage());
        // Alternatively, you can set a flag or message to display on the frontend
        $errorMessage = $e->getMessage();
    }
@endphp
@php
    $zones = collect(); // Initialize an empty collection for cities

    try {
        $zoneUrl = $baseUrl . '/aladdin/api/v1/cities/'.$recipientCity.'/zone-list';
        $ch = curl_init($zoneUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $zoneResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200) {
            $zoneData = json_decode($zoneResponse, true);

            if (isset($zoneData['type']) && $zoneData['type'] === 'success') {
                $zones = collect($zoneData['data']['data']); // Convert to Collection
            }
        } else {
            throw new Exception('API request failed with response code ' . $httpcode);
        }
    } catch (Exception $e) {
        // Handle exceptions by logging or displaying an error message
        // You can use Laravel's logging or display the message as needed
        Log::error('Error fetching city data: ' . $e->getMessage());
        // Alternatively, you can set a flag or message to display on the frontend
        $errorMessage = $e->getMessage();
    }
@endphp
@php
    $areas = collect(); // Initialize an empty collection for cities

    try {
        $areaUrl = $baseUrl . '/aladdin/api/v1/zones/'.$recipientZone.'/area-list';
        $ch = curl_init($areaUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $areaResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200) {
            $areaData = json_decode($areaResponse, true);

            if (isset($areaData['type']) && $areaData['type'] === 'success') {
                $areas = collect($areaData['data']['data']); // Convert to Collection
            }
        } else {
            throw new Exception('API request failed with response code ' . $httpcode);
        }
    } catch (Exception $e) {
        // Handle exceptions by logging or displaying an error message
        // You can use Laravel's logging or display the message as needed
        Log::error('Error fetching city data: ' . $e->getMessage());
        // Alternatively, you can set a flag or message to display on the frontend
        $errorMessage = $e->getMessage();
    }
@endphp
@if(in_array($orderStatus, ['Processing', 'Payment Pending', 'On Hold']))
    <form wire:submit.prevent="createParcel" class="col-md-6">
        <div class="row">
        <div class="form-group   col-sm-6">
            <label for="storeId">Store ID: <span class="text-danger"> *</span></label>
            <select id="storeId" wire:model="storeId" class="form-control select2" required>
                <option value="">Select Store</option>
               
                @foreach ($storeList  as $store)
                    <option value="{{$store['store_id']}}">{{$store['store_name']}}</option>
                @endforeach
            </select>
      
        </div>
        <div class="form-group   col-sm-6">
            <label for="recipientCity">Recipient City: <span class="text-danger"> *</span></label>
            <select id="recipientCity" wire:model="recipientCity" wire:change="getZones($event.target.value)" class="form-control select2" required>
                <option value="">Select City</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group   col-sm-6">
            <label for="recipientZone">Recipient Zone: <span class="text-danger"> *</span></label>
            <select id="recipientZone" wire:model="recipientZone" wire:change="getAreas($event.target.value)" class="form-control select2" required>
                <option value="">Select Zone</option>
                @foreach ($zones as $zone)
                    <option value="{{ $zone['zone_id'] }}">{{ $zone['zone_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group   col-sm-6">
            <label for="recipientArea">Recipient Area: <span class="text-danger"> *</span></label>
            <select id="recipientArea" wire:model="recipientArea" class="form-control select2" wire:change="getPrice" required>
                <option value="">Select Area</option>
                @foreach ($areas as $area)
                    <option value="{{ $area['area_id'] }}">{{ $area['area_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group   col-sm-6">
            <label for="deliveryType">Delivery Type: <span class="text-danger"> *</span></label>
            <select id="deliveryType" wire:model="deliveryType" class="form-control" required>
                <option value="48">Normal Delivery</option>
                <option value="12">On Demand Delivery</option>
            </select>
        </div>
        <div class="form-group   col-sm-6">
            <label for="itemType">Item Type: <span class="text-danger"> *</span></label>
            <select id="itemType" wire:model="itemType" class="form-control" required>
                <option value="2">Parcel</option>
                <option value="1">Document</option>
            </select>
        </div>
        <div class="form-group   col-sm-6">
            <label for="specialInstruction">Special Instruction:</label> 
            <textarea id="specialInstruction" wire:model.defer="specialInstruction" class="form-control"></textarea>
        </div>
        <div class="form-group   col-sm-6">
            <label for="itemWeight">Item Weight: <span class="text-danger"> *</span></label>
            <input type="number" step="any" id="itemWeight" wire:model.defer="itemWeight" class="form-control" required>
        </div>
        <button type="submit" class="form-control btn btn-primary">Create Parcel</button>
        </div>
    </form>
@endif
</div>
