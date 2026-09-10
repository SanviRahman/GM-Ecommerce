@if(Cart::count() > 0)
    <a href="#" class="icon icon-xs rounded-circle border" data-toggle="dropdown">
        <i class="fa fa-shopping-cart d-inline-block nav-box-icon"></i>
        <span class="badge badge-pill badge-danger notify">{{ Cart::count() }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right px-0">
        <li>
            <div class="dropdown-cart px-0">
                <div class="dc-header"><h4 class="text-center py-2">Cart Items</h4></div>
                <div class="dropdown-cart-items c-scrollbar">
                    @foreach(Cart::content() as $item)
                        <div class="dc-item">
                            <div class="d-flex align-items-center">
                                <div class="dc-image">
                                    <a href="{{ url('/product/'.$item->model->productSlug) }}">
                                        <img src="{{ url('/public/product/thumbnail/'.$item->model->productImage) }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="dc-content">
                                    <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                        <a href="{{ url('/product/'.$item->model->productSlug) }}">{{ $item->model->productName }}</a>
                                    </span>
                                    
                                    @if($item->options->colorName)
                                        <small class="text-muted">Color: {{ $item->options->colorName }},</small>
                                    @endif
                                    @if($item->options->sizeName) {{-- Fixed Logic Here --}}
                                        <small class="text-muted">Size: {{ $item->options->sizeName }},</small>
                                    @endif
                                    
                                    <span class="dc-quantity">x{{ $item->qty }}</span>
                                    <span class="dc-price">TK {{ $item->price }}</span>
                                </div>
                                <div class="dc-actions">
                                    <button onclick="removeFromCart('{{ $item->rowId }}')"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="dc-item py-3">
                    <span class="subtotal-text">Subtotal</span>
                    <span class="subtotal-amount">৳ {{ Cart::subtotal(0, '', '') }}</span>
                </div>
                <div class="p-2 text-center dc-btn">
                    <a href="{{ url('/checkout') }}" class="btn btn-success btn-block">Checkout</a>
                </div>
            </div>
        </li>
    </ul>
@else
    <span class="badge badge-pill badge-danger notify">0</span>
    <a href="" class="icon icon-xs rounded-circle border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="fa fa-shopping-cart d-inline-block nav-box-icon"></i>
        <span class="badge badge-pill badge-danger notify">0</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right px-0" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-328px, 32px, 0px);">

        <li>
            <div class="dropdown-cart px-0">
                <div class="dc-header">
                    <h4 class="text-center py-2">Empty Cart</h4>
                </div>
            </div>
        </li>
    </ul>
@endif