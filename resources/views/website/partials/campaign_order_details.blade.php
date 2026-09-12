@php
    $campaignDeliveryCharge = isset($_SESSION['delivery']) ? (float) $_SESSION['delivery'] : 0;

    // hardevine/shoppingcart regenerates rowId when item options change and
    // re-inserts that row at the end of the cart collection. Render campaign
    // items by their original campaign position so option changes never move
    // Product 1 / Product 2 / Product 3 around.
    $campaignCartItems = Cart::content()->sortBy(function ($item) {
        return (int) ($item->options->campaignPosition ?? PHP_INT_MAX);
    });
@endphp
<aside class="card">
    <article class="card-body">
        <header class="mb-4">
            <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
        </header>
        <div class="row">
            <div class="table-responsive bg-white">
                <table class="table border-bottom">
                    <thead>
                    <tr>
                        <th class="product-image">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quanity">Quantity</th>
                        <th class="product-total">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($campaignCartItems as $item)
                        @php
                            $selectedOptionId = $item->options->optionId ?? null;
                            $selectedOptionName = $item->options->optionName ?? null;
                            $selectedColorId = $item->options->colorId ?? null;
                            $selectedColorName = $item->options->colorName ?? null;
                        @endphp
                        <tr class="cart-item">
                            <td class="product-image" style="display: flex; flex-direction: row-reverse;">
                                <a href="#">
                                    <img class="lazyload" src="{{ url('/public/product/thumbnail/'.$item->model->productImage) }}" style="max-width: 50px">
                                </a>
                                <button type="button" onclick="removeFromCart('{{ $item->rowId }}')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>

                            <td class="product-name">
                                <span class="d-block">{{ $item->model->productName }}</span>

                                @if($item->model->colors->isNotEmpty())
                                    <div class="mt-2 campaign-color-selector">
                                        <small class="d-block mb-1 font-weight-bold">Select Color</small>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            @foreach($item->model->colors as $color)
                                                @php
                                                    $isSelectedColor = $selectedColorId
                                                        ? ((int) $selectedColorId === (int) $color->id)
                                                        : ($selectedColorName === $color->colorName);
                                                @endphp
                                                <label class="btn btn-outline-secondary btn-sm mb-1 {{ $isSelectedColor ? 'active' : '' }}">
                                                    <input
                                                        type="radio"
                                                        name="campaign_color_{{ $item->rowId }}"
                                                        value="{{ $color->id }}"
                                                        autocomplete="off"
                                                        {{ $isSelectedColor ? 'checked' : '' }}
                                                        onchange="updateCampaignColor('{{ $item->rowId }}', this.value)"
                                                    >
                                                    {{ $color->colorName }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($selectedColorName)
                                    <small class="text-muted">Color: {{ $selectedColorName }},</small>
                                @endif

                                @if($item->options->sizeName)
                                    <small class="text-muted">Size: {{ $item->options->sizeName }},</small>
                                @endif

                                @if($item->model->options->isNotEmpty())
                                    <div class="mt-2 campaign-option-selector">
                                        <small class="d-block mb-1 font-weight-bold">Select Option</small>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            @foreach($item->model->options as $option)
                                                @php
                                                    $isSelectedOption = $selectedOptionId
                                                        ? ((int) $selectedOptionId === (int) $option->id)
                                                        : ($selectedOptionName === $option->optionName);
                                                @endphp
                                                <label class="btn btn-outline-secondary btn-sm mb-1 {{ $isSelectedOption ? 'active' : '' }}">
                                                    <input
                                                        type="radio"
                                                        name="campaign_option_{{ $item->rowId }}"
                                                        value="{{ $option->id }}"
                                                        autocomplete="off"
                                                        {{ $isSelectedOption ? 'checked' : '' }}
                                                        onchange="updateCampaignOption('{{ $item->rowId }}', this.value)"
                                                    >
                                                    {{ $option->optionName }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($selectedOptionName)
                                    <small class="text-muted">Option: {{ $selectedOptionName }}</small>
                                @endif
                            </td>

                            <td class="product-price">
                                <span class="d-block">TK {{ number_format((float) $item->price, 0, '.', '') }}</span>
                            </td>

                            <td class="product-quantity">
                                <div class="input-group input-spinner">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-light btn-number" type="button" data-type="plus" data-field="quantity[{{ $item->id }}]"> + </button>
                                    </div>
                                    <input type="text" name="quantity[{{ $item->id }}]" class="form-control input-number" placeholder="1" value="{{ $item->qty }}" min="1" max="10" onchange="updateQuantity('{{ $item->rowId }}', this)">
                                    <div class="input-group-append">
                                        <button class="btn btn-light btn-number" type="button" data-type="minus" data-field="quantity[{{ $item->id }}]"> − </button>
                                    </div>
                                </div>
                            </td>
                            <td class="product-total">
                                <span>TK {{ number_format((float) $item->subtotal, 0, '.', '') }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </article>
    <article class="card-body border-top">
        <dl class="row">
            <dt class="col-sm-8">Subtotal: </dt>
            <dd class="col-sm-4 text-right"><strong>TK {{ Cart::subtotal('0', '', '') }}</strong></dd>

            <dt class="col-sm-8">Delivery charge: </dt>
            <dd class="col-sm-4 text-danger text-right"><strong>TK {{ number_format($campaignDeliveryCharge, 0, '.', '') }}</strong></dd>

            <dt class="col-sm-8">Total:</dt>
            <dd class="col-sm-4 text-right">
                <strong class="h5 text-dark">TK {{ number_format((float) Cart::subtotal('0', '', '') + $campaignDeliveryCharge, 0, '.', '') }}</strong>
            </dd>
        </dl>
    </article>
    <script type="text/javascript">
        cartQuantityInitialize();
    </script>
</aside>
