<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Campaign;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $selectedProductIds = array_map('intval', (array) old('product_ids', []));

        return view('admin.campaign.create', compact('products', 'selectedProductIds'));
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $productIds = $this->normalizeProductIds($request);
        $request->merge(['product_ids' => $productIds]);

        $request->validate([
            'name' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'video' => 'nullable',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:campaigns,slug',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'phone_number' => 'required|string|max:30',
            'whatsapp_number' => 'required|string|max:30',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'required|integer|distinct|exists:products,id',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->slug ?: Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug);
        $videoId = $this->extractVideoId($request->video);

        $bannerPath = $this->handleImageUpload($request->file('banner'), 'campaigns');
        $imageOnePath = $request->file('image_one') ? $this->handleImageUpload($request->file('image_one'), 'campaigns') : null;
        $imageTwoPath = $request->file('image_two') ? $this->handleImageUpload($request->file('image_two'), 'campaigns') : null;
        $imageThreePath = $request->file('image_three') ? $this->handleImageUpload($request->file('image_three'), 'campaigns') : null;

        $campaign = Campaign::create([
            'name' => $request->name,
            'banner_title' => $request->banner_title,
            'video' => $videoId,
            'banner' => $bannerPath,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            // Keep the legacy product_id populated with the first selected product.
            'product_id' => $productIds[0],
            'phone_number' => trim($request->phone_number),
            'whatsapp_number' => trim($request->whatsapp_number),
            'image_one' => $imageOnePath,
            'image_two' => $imageTwoPath,
            'image_three' => $imageThreePath,
            'status' => 1,
        ]);

        $this->syncCampaignProducts($campaign, $productIds);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\View\View
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\View\View
     */
    public function edit(Campaign $campaign)
    {
        $products = Product::all();
        $campaign->load('products');

        $selectedProductIds = $campaign->products->pluck('id')->map(function ($id) {
            return (int) $id;
        })->values()->all();

        if (empty($selectedProductIds) && $campaign->product_id) {
            $selectedProductIds = [(int) $campaign->product_id];
        }

        if (old('product_ids') !== null) {
            $selectedProductIds = array_map('intval', (array) old('product_ids'));
        }

        return view('admin.campaign.edit', compact('campaign', 'products', 'selectedProductIds'));
    }

    /**
     * Update the specified campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $productIds = $this->normalizeProductIds($request);
        $request->merge(['product_ids' => $productIds]);

        $request->validate([
            'name' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'video' => 'nullable',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:campaigns,slug,' . $campaign->id,
            'short_description' => 'required|string',
            'description' => 'required|string',
            'phone_number' => 'required|string|max:30',
            'whatsapp_number' => 'required|string|max:30',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'required|integer|distinct|exists:products,id',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->slug ?: Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug, $campaign->id);
        $videoId = $this->extractVideoId($request->video);

        $bannerPath = $request->hasFile('banner') ? $this->handleImageUpload($request->file('banner'), 'campaigns') : $campaign->banner;
        $imageOnePath = $request->hasFile('image_one') ? $this->handleImageUpload($request->file('image_one'), 'campaigns') : $campaign->image_one;
        $imageTwoPath = $request->hasFile('image_two') ? $this->handleImageUpload($request->file('image_two'), 'campaigns') : $campaign->image_two;
        $imageThreePath = $request->hasFile('image_three') ? $this->handleImageUpload($request->file('image_three'), 'campaigns') : $campaign->image_three;

        $campaign->update([
            'name' => $request->name,
            'banner_title' => $request->banner_title,
            'video' => $videoId,
            'banner' => $bannerPath,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            // Legacy compatibility: first selected product stays in product_id.
            'product_id' => $productIds[0],
            'phone_number' => trim($request->phone_number),
            'whatsapp_number' => trim($request->whatsapp_number),
            'image_one' => $imageOnePath,
            'image_two' => $imageTwoPath,
            'image_three' => $imageThreePath,
            'status' => $campaign->status,
        ]);

        $this->syncCampaignProducts($campaign, $productIds);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified campaign from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->products()->detach();
        $campaign->delete();

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign deleted successfully.');
    }

    /**
     * Toggle the status of the specified campaign.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);
        $campaign->status = !$campaign->status;
        $campaign->save();

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign status updated successfully.');
    }

    /**
     * Return selected product IDs in the exact order selected on the form.
     */
    private function normalizeProductIds(Request $request)
    {
        $selected = (array) $request->input('product_ids', []);

        // Backward compatibility with an older cached/saved form.
        if (empty($selected) && $request->filled('product_id')) {
            $selected = [$request->input('product_id')];
        }

        $selectedIds = [];
        foreach ($selected as $id) {
            if (is_numeric($id)) {
                $id = (int) $id;
                if (!in_array($id, $selectedIds, true)) {
                    $selectedIds[] = $id;
                }
            }
        }

        $orderedIds = [];
        $submittedOrder = array_filter(explode(',', (string) $request->input('product_order', '')));

        foreach ($submittedOrder as $id) {
            if (!is_numeric($id)) {
                continue;
            }

            $id = (int) $id;
            if (in_array($id, $selectedIds, true) && !in_array($id, $orderedIds, true)) {
                $orderedIds[] = $id;
            }
        }

        foreach ($selectedIds as $id) {
            if (!in_array($id, $orderedIds, true)) {
                $orderedIds[] = $id;
            }
        }

        return $orderedIds;
    }

    /**
     * Sync pivot rows while preserving the admin's selection order.
     */
    private function syncCampaignProducts(Campaign $campaign, array $productIds)
    {
        $syncData = [];

        foreach ($productIds as $position => $productId) {
            $syncData[(int) $productId] = ['position' => $position + 1];
        }

        $campaign->products()->sync($syncData);
    }

    private function extractVideoId($url)
    {
        if (empty($url)) {
            return null;
        }

        if (preg_match('/^[a-zA-Z0-9_-]+$/', $url)) {
            return $url;
        }

        if (preg_match('/youtube\.com.*[?&]v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function handleImageUpload($image, $path)
    {
        $originalPath = public_path($path);

        if (!is_dir($originalPath)) {
            File::makeDirectory($originalPath, 0777, true);
        }

        $extension = $image->getClientOriginalExtension();
        $imageName = uniqid() . '.' . $extension;
        $originalImage = $originalPath . '/' . $imageName;

        Image::make($image)->save($originalImage);

        return $imageName;
    }

    protected function generateUniqueSlug($slug, $excludeId = null)
    {
        $count = Campaign::where('slug', $slug)
            ->when($excludeId, function ($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        return $slug;
    }
}
