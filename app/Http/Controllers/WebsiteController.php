<?php

namespace App\Http\Controllers;
use App\Section;
use App\Category;
use App\Product;
use App\Slider;
use App\ShippingCharge;
use App\Campaign;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
class WebsiteController extends Controller
{
    public function index()
    {
        $slug = 'offer';
        $topProducts = Product::where('status','Active')->with('media','categories')->latest()->whereHas('categories', function ($query) use ($slug) {
            $query->where('categories.categorySlug','like', $slug);
        })->limit(12)->get();
        $otherProducts = Product::where('status','Active')->with('media','categories')->latest()->paginate(30);
        $otherProducts->withPath('shop/');
        $slides = Slider::where('status','Active')->get();
        $sections = Section::with('category','category.products')->where('status','Active')->orderBy('sort')->get();
     
        return view('website.home',compact('slug','topProducts','otherProducts','slides','sections'));
    }

    public function product($id)
    {
        
        $product = Product::where('status','Active')->with('media','categories')->where('products.id','like',$id)->first();
        if(!$product){
            $product = Product::where('status','Active')->with('media','categories')->where('products.productSlug','like',$id)->first();
        }
        $relatedProducts = Product::where('status','Active')->with('media','categories')
        ->where('products.id','!=',$product->id)
        ->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->limit(30)->get();
        return view('website.product',compact('product','relatedProducts'));
    }

    public function category($slug)
    {
        $categoryProducts = Product::where('status','Active')->with('media','categories')->whereHas('categories', function ($query) use ($slug) {
            $query->where('categories.categorySlug','like', $slug);
        })->orderBy('productCode', 'asc')->paginate(30);
        $category = Category::where('categories.categorySlug', $slug)->first();
        return view('website.category',compact('category','categoryProducts'));
    }

    public function shop()
    {
        if (isset($_REQUEST['q'])){
            $shop = Product::where('status','Active')->with('media','categories')->where('products.productName','like',"%{$_REQUEST['q']}%")->orderBy('productCode', 'asc')->paginate(30);
        }else{
            $shop = Product::where('status','Active')->with('media','categories')->orderBy('productCode', 'asc')->paginate(30);
        }
        return view('website.shop',compact('shop'));
    }

    public function page($slug)
    {
        $page = Page::where('pageSlug','like',$slug)->first();
        $relatedProducts = Product::where('status','Active')->with('media','categories')->orderBy('productCode', 'asc')->limit(30)->get();
        return view('website.page',compact('page','relatedProducts'));
    }
    
    public function campaign($slug){
        $campaign_data = Campaign::where('slug',$slug)->first();
        if($campaign_data){
           session_start();
            error_reporting(0);
            $charge = ShippingCharge::first();
            if(!$_SESSION['delivery']){
                $_SESSION['delivery'] =  $$charge->charge??120;
            }
            $product = Product::find($campaign_data->product_id);
            //return $product;
            // Add product to the cart with color and size if applicable
            Cart::destroy();
            Cart::add([
                'id' => $product->id,
                'name' => $product->productName,
                'qty' => 1,
                'price' => $product->price(),
                'options' => [
                    'colorName' => $color->colorName ?? null,
                    'sizeName' => $size->sizeName ?? null,
                ]
            ])->associate(Product::class);
            return view('website.campaign',compact('campaign_data','product')); 
        }else{
            abort(404);
        }
        
        
    }
        public function loadProducts()
    {

        $otherProducts = Product::where('status','Active')->with('media','categories')->orderBy('productCode', 'asc')->paginate(30);
        foreach($otherProducts as $product) { ?>
        <div class="col-md-3 col-6">
            <div href="#" class="card card-product-grid product-box-2">
                <a href="<?php  echo url('/product/'.$product->productSlug)  ?>" class="img-wrap">
                    <img class="img-fit lazyload"   src="<?php echo asset('public/product/thumbnail/default.jpg') ?>"  data-src="<?php echo asset('/public/product/thumbnail/'.$product->productImage)  ?>" alt="<?php echo $product->productName  ?>">
                   <?php if($product->isStockOut==1) {?>
                        <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Stock Out</span>
                    <?php }else{
                        if($product->isFreeDelivery ==1){
                    ?>
                        <span class="badge bg-danger position-absolute text-light top-0 start-0 m-0">Free Delivery</span>
                    <?php } } ?>
                </a>
                <figcaption class="info-wrap">
                    <h6 style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;"> <?php echo e($product->productName); ?></h6>
                    <div class="price mt-1 text-center">
                        <?php echo $product->htmlPrice() ?>
                    </div>
                </figcaption>
                <?php if ($product->colors->isNotEmpty() || $product->sizes->isNotEmpty() || $product->options->isNotEmpty()){ ?>
    <a href="<?php echo url('/product/'.$product->productSlug); ?>" 
       class="btn btn-dark btn-sm btn-block <?php echo ($product->isStockOut)?'disabled':''; ?>">
       <i class="fa fa-shopping-cart" aria-hidden="true"></i> অর্ডার করুন
    </a>
<?php }else{ ?>
    <button <?php echo ($product->isStockOut)?'disabled':''; ?> 
            class="btn btn-dark btn-sm btn-block" 
            onclick="buyNow(<?php echo $product->id; ?>)">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> অর্ডার করুন
    </button>
<?php } ?>

            </div>
        </div>
        <?php }
   }
}
