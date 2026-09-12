<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ip;
use Illuminate\Support\Facades\Artisan;
class IpController extends Controller
{
    public function shipping(){
        return view('admin.shipping_charges.index');
    }
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

    /**
     * Run pending database migrations safely in production.
     * The route is protected by the existing auth + admin middleware group.
     */
    public function migrateDatabase()
    {
        try {
            Artisan::call('migrate', [
                '--force' => true,
            ]);

            $output = trim(Artisan::output());

            \Log::info('Admin database migration executed.', [
                'user_id' => auth()->id(),
                'output' => $output,
            ]);

            return redirect()->back()->with(
                'message',
                $output !== '' ? 'Database migration completed successfully! ' . $output : 'Database migration completed successfully!'
            );
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()->back()->with(
                'message',
                'Database migration failed. Please check storage/logs/laravel.log.'
            );
        }
    }
}
