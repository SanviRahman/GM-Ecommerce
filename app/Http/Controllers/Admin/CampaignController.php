<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Campaign;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image; 
class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new campaign.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        
        return view('admin.campaign.create',compact('products'));
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'video' => 'nullable',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:campaigns,slug',
            'short_description' => 'required|string',
            'description' => 'required|string',
            
            'product_id' => 'required|exists:products,id',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);
        
        // Generate slug from the name if not provided
        $slug = $request->slug ?: Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug);
        // Handle Video URL Extraction
        $videoId = $this->extractVideoId($request->video);

        // Store the banner image
        $bannerPath = $this->handleImageUpload($request->file('banner'), 'campaigns');

        // Store additional images (if provided)
        $imageOnePath = $request->file('image_one') ? $this->handleImageUpload($request->file('image_one'), 'campaigns') : null;
        $imageTwoPath = $request->file('image_two') ? $this->handleImageUpload($request->file('image_two'), 'campaigns') : null;
        $imageThreePath = $request->file('image_three') ? $this->handleImageUpload($request->file('image_three'), 'campaigns') : null;



        // Create and store the campaign data
        $campaign = Campaign::create([
            'name' => $request->name,
            'banner_title' => $request->banner_title,
            'video' => $videoId,
            'banner' => $bannerPath,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
        
            'product_id' => $request->product_id,
            'image_one' => $imageOnePath,
            'image_two' => $imageTwoPath,
            'image_three' => $imageThreePath,
            'status' => 1,
       
        ]);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified campaign.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\View\View
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\View\View
     */
    public function edit(Campaign $campaign)
    {
        $products = Product::all();
        return view('admin.campaign.edit', compact('campaign','products'));
    }

    /**
     * Update the specified campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the campaign by ID
        $campaign = Campaign::findOrFail($id);
    
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'video' => 'nullable',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:campaigns,slug,' . $campaign->id,
            'short_description' => 'required|string',
            'description' => 'required|string',
           
            'product_id' => 'required|exists:products,id',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
    
        // Generate slug from the name if not provided
        $slug = $request->slug ?: Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug,$campaign->id);
    
        // Handle Video URL Extraction
        $videoId = $this->extractVideoId($request->video);
        
        
    
        // Store the banner image (if provided)
        $bannerPath = $request->hasFile('banner') ? $this->handleImageUpload($request->file('banner'), 'campaigns') : $campaign->banner;
    
        // Store additional images (if provided)
        $imageOnePath = $request->hasFile('image_one') ? $this->handleImageUpload($request->file('image_one'), 'campaigns') : $campaign->image_one;
        $imageTwoPath = $request->hasFile('image_two') ? $this->handleImageUpload($request->file('image_two'), 'campaigns') : $campaign->image_two;
        $imageThreePath = $request->hasFile('image_three') ? $this->handleImageUpload($request->file('image_three'), 'campaigns') : $campaign->image_three;
    
        // Update the campaign data
        $campaign->update([
            'name' => $request->name,
            'banner_title' => $request->banner_title,
            'video' => $videoId,
            'banner' => $bannerPath,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            
            'product_id' => $request->product_id,
            'image_one' => $imageOnePath,
            'image_two' => $imageTwoPath,
            'image_three' => $imageThreePath,
            'status' => $campaign->status, // Status remains unchanged
     
        ]);
    
        return redirect()->route('admin.campaign.index')->with('success', 'Campaign updated successfully.');
    }


    /**
     * Remove the specified campaign from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign deleted successfully.');
    }

    /**
     * Toggle the status of the specified campaign.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);
        $campaign->status = !$campaign->status;  // Toggle the status (active/inactive)
        $campaign->save();
    
        return redirect()->route('admin.campaign.index')->with('success', 'Campaign status updated successfully.');
    }
    private function extractVideoId($url)
    {
        // If the passed value is empty, return null
        if (empty($url)) {
            return null;
        }
    
        // If the passed value is already an ID, return it directly
        if (preg_match('/^[a-zA-Z0-9_-]+$/', $url)) {
            return $url;
        }
    
        // Check for YouTube full URL (e.g., https://www.youtube.com/watch?v=ID)
        if (preg_match('/youtube\.com.*[?&]v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        }
    
        // Check for YouTube short URL (e.g., https://youtu.be/ID)
        if (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }
    
        // Check for Vimeo URL (e.g., https://vimeo.com/12345678)
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return $matches[1];
        }
    
        // If no match, return null
        return null;
    }


    private function handleImageUpload($image, $path)
    {
        // Create directories if not exist
        $originalPath = public_path($path);
        

        if (!is_dir($originalPath)) {
            File::makeDirectory($originalPath, 0777, true);
        }
       

        // Generate unique file name
        $extension = $image->getClientOriginalExtension();
        $imageName = uniqid() . '.' . $extension;

        // Save original image
        $originalImage = $originalPath . '/' . $imageName;
        Image::make($image)->save($originalImage);

    

     
        return $imageName; // Return the file name to store in the database
    }
    protected function generateUniqueSlug($slug, $excludeId = null)
    {
        // Check if the slug already exists in the database
        $count = Campaign::where('slug', $slug)
                         ->when($excludeId, function ($query) use ($excludeId) {
                             return $query->where('id', '!=', $excludeId);
                         })
                         ->count();
    
        // If the slug exists, append a number to it
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
    
        return $slug;
    }
}
