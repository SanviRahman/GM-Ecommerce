<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ip;
use Illuminate\Support\Facades\Artisan;
class IpController extends Controller
{
    public function pathao_create ($order_id){
        return view('admin.pathao.create',compact('order_id'));
    }
    public function index()
    {
        return view('admin.ip.index');
    }
    /**
     * Block an IP address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function block(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ip_address' => 'required|ip',
        ]);

        // Store the IP address
        $ip = Ip::create(['ip_address' => $request->input('ip_address')]);

        
        return redirect()->back()->with('message', 'IP address blocked successfully')->with('ip', $ip);
    }

    /**
     * Unblock an IP address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unblock(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ip_address' => 'required|ip',
        ]);

        // Find and delete the IP address
        $ip = Ip::where('ip_address', $request->input('ip_address'))->first();

        if ($ip) {
            $ip->delete();
            return redirect()->back()->with('message', 'IP address unblocked successfully')->with('ip', $ip);
            
        } else {
            return redirect()->back()->with('message', 'IP address not found')->with('ip', $ip);
            
        }
    }
    public function optimize(){
        
        // Call Artisan commands and capture the output
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
    
        // Redirect back with a success message
        return redirect()->back()->with('message', 'Optimization successful!');

       
    }
}
