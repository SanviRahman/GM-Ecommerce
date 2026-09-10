<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Order;
use App\Setting;
use App\Customer;
use App\Courier;
use App\OrderProducts;
use Codeboxr\PathaoCourier\Facade\PathaoCourier;

class CreatePathaoParcel extends Component
{
    public $orderId;
    public $errorMsg = "";
    public $zones;
    public $areas;

    public $storeId;
    public $merchantOrderId;
    public $recipientName;
    public $recipientPhone;
    public $recipientAddress;
    public $recipientCity;
    public $recipientZone;
    public $recipientArea;
    public $deliveryType;
    public $itemType;
    public $specialInstruction;
    public $itemQuantity;
    public $itemWeight;
    public $amountToCollect;
    public $itemDescription = "";
    
    public $accessToken;
    public $refreshToken;
    public $tokenType;
    public $expiresIn;
    public $baseUrl;
    public $pathaoPrice;
    public $order;
    public $orderStatus;
    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->baseUrl = Setting::get('pathao_base_url');
        $this->getToken();
     
        $this->itemType = 2;
        $this->deliveryType = 48;
        $this->itemWeight = 0.5;
        $order = Order::find($orderId);
        $this->order = $order;
        $customer = Customer::where('order_id',$orderId)->first();
        $products = OrderProducts::where('order_id',$orderId)->get();
        $totalQuantity = 0;
        $totalPrice = 0;
        
        $this->recipientName = $customer->customerName;
        $this->recipientPhone = $customer->customerPhone;
        $this->recipientAddress = $customer->customerAddress; 
        $this->merchantOrderId = $order->invoiceID; 
        $this->orderStatus = $order->status;
        foreach($products as $product){
            $this->itemDescription .= $product->productName.', '; 
            $totalPrice += ($product->productPrice*$product->quantity);
            $totalQuantity += $product->quantity;
        }
        $this->amountToCollect = $totalPrice + $order->deliveryCharge; 
        $this->itemQuantity = $totalQuantity; 
        
        
    }
    public function getToken()
    {
        $url = $this->baseUrl.'/aladdin/api/v1/issue-token';
    
        $data = [
            'client_id' => Setting::get('pathao_client_id'),
            'client_secret' => Setting::get('pathao_client_secret'),
            'username' => Setting::get('pathao_client_email'),
            'password' => Setting::get('pathao_client_password'),
            'grant_type' => Setting::get('pathao_grant_type'),
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            session()->flash('error', 'Failed to retrieve token: ' . curl_error($ch));
            curl_close($ch);
            return;
        }
    
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpcode === 200) {
            $data = json_decode($response, true);
            
            $this->accessToken = $data['access_token'];
            $this->refreshToken = $data['refresh_token'];
            $this->tokenType = $data['token_type'];
            $this->expiresIn = $data['expires_in'];
         
            $this->errorMsg = "";
        } else {
            $this->errorMsg = "Failed to retrieve token. please fix the Pathao API From <a href='/admin/setting'>Setting</a>";
            //dd('Failed to retrieve token. please fix the Pathao API');
        }
    }
    public function getZones($cityId){
        $this->recipientCity = $cityId;
        $this->render();
        
    }
    public function getAreas($zoneId){
        $this->recipientZone = $zoneId;
        $this->render();
        
    }
    public function getPrice(){
        $requestUrl = $this->baseUrl . "/aladdin/api/v1/merchant/price-plan";
        $requestBody = json_encode([
            "store_id" => $this->storeId,
            "item_type" => $this->itemType,
            "delivery_type" => $this->deliveryType,
            "item_weight" => $this->itemWeight,
            "recipient_city" => $this->recipientCity,
            "recipient_zone" =>$this->recipientZone
        ]);
        
        $requestHeaders = [
            "Authorization: Bearer " . $this->accessToken,
            "Content-Type: application/json",
            "Accept: application/json"
        ];
        
        // Initialize CURL session
        $ch = curl_init();
        
        // Set CURL options
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        
        // Execute CURL request
        $response = curl_exec($ch);
        
        // Check for errors
        if (curl_errno($ch)) {
            dd("Error: " . curl_error($ch)) ;
        } else {
            // Get HTTP status code
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            // Decode response JSON
            $responseData = json_decode($response, true);
            
            // Check for success or error response
            if ($httpCode === 200 && isset($responseData['type']) && $responseData['type'] === 'success') {
                // Success response
                $this->pathaoPrice = $responseData['data']['price'];
                $this->render();
               
            } elseif ($httpCode === 422 && isset($responseData['type']) && $responseData['type'] === 'error') {
                // Error response
                
                dd("Error: " . $responseData['message']);
                // Additional error handling for validation errors if needed
            } else {
                dd("Unexpected response: " . $response);
            }
        }
        
        // Close CURL session
        curl_close($ch);
    }
    public function createParcel(){
        $requestUrl = $this->baseUrl . "/aladdin/api/v1/orders";
        $requestBody = json_encode([
            "store_id" => $this->storeId,
            "merchant_order_id" => $this->merchantOrderId,
            "recipient_name" => $this->recipientName,
            "recipient_phone" => $this->recipientPhone,
            "recipient_address" => $this->recipientAddress,
            "recipient_city" => $this->recipientCity,
            "recipient_zone" => $this->recipientZone,
            "recipient_area" => $this->recipientArea,
            "delivery_type" => $this->deliveryType,
            "item_type" => $this->itemType,
            "special_instruction" => $this->specialInstruction,
            "item_quantity" => $this->itemQuantity,
            "item_weight" => $this->itemWeight,
            "amount_to_collect" => $this->amountToCollect,
            "item_description" => $this->itemDescription
        ]);
        
        $requestHeaders = [
            "Authorization: Bearer " . $this->accessToken,
            "Content-Type: application/json",
            "Accept: application/json"
        ];
        
        // Initialize CURL session
        $ch = curl_init();
        
        // Set CURL options
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        
        // Execute CURL request
        $response = curl_exec($ch);
        
        // Check for errors
        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
        } else {
            // Get HTTP status code
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            // Decode response JSON
            $responseData = json_decode($response, true);
            
            // Check for success or error response
            if ($httpCode === 200 && isset($responseData['type']) && $responseData['type'] === 'success') {
                
                $courier = Courier::where('courierName','Pathao')->first();
                if(!$courier){
                    $courierData = [
                        'courierName' => 'Pathao',
                        'hasCity' => 'on', // Example value, adjust as needed
                        'hasZone' => 'on', // Example value, adjust as needed
                        'courierCharge' => 150.00, // Example value, adjust as needed
                        'status' => 'active', // Example value, adjust as needed
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $courier = Courier::create($courierData);
                }
                // Success response
                $order = $this->order;
    
                $order->city_id = $this->recipientCity;
                $order->zone_id = $this->recipientZone;
                $this->orderStatus = 'Delivered';
                $order->status = 'Delivered';
                $order->courier_id = $courier->id;
                $order->deliveryDate = date('Y-m-d');
                $order->update();
               
            } elseif ($httpCode === 422 && isset($responseData['type']) && $responseData['type'] === 'error') {
                // Error response
                dd("Error: " . $responseData['message']);
                // Additional error handling for validation errors if needed
            } else {
                dd("Unexpected response: " . $response);
            }
        }
        
        // Close CURL session
        curl_close($ch);
    }
    public function render()
    {
        
        return view('livewire.create-pathao-parcel');
    }
}
