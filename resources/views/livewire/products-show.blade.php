@extends('layouts.app')
@section('content')
    <!-- Product section-->
    @php
        if ($product->discount > 0) {
            $sale = true;
        } else {
            $sale = false;
        }
    @endphp
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" width="700" height="600"
                        src="{{ asset('storage/images/' . $product->game->photos[0]->path) }}" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: {{ $product->id }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->game->name }}</h1>
                    <div class="fs-5 mb-5">
                        @if ($sale)
                            <span class="text-decoration-line-through">{{ $product->price }}€</span>
                            <span>{{ intval($product->price * 100 - $product->price * 100 * ($product->discount / 100)) / 100 }}€</span>
                        @else
                            <span>{{ $product->price }}€</span>
                        @endif
                        <div class="small mb-1">
                            Seller:<a class="small mb-1"> {{ $product->user->name }}</a>
                        </div>
                    </div>


                    <p class="lead">{{ $product->game->description }}</p>
                    <div class="d-flex">
                        <livewire:add-cart :product_id="$product->id" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-4 px-lg-5 my-5">
            <div class="card align-items-left"
                style="width: 18rem display: flex; align-items: left; justify-content: left; width: 1300px; height: 300px; background: rgb(199, 199, 199);">
                <div class="card-header" style="background: rgb(199, 199, 199)">
                    Other Sellers
                </div>
                @forelse ($sameProduct as $productSeller)
                    @if ($productSeller->user->id == $product->user->id)
                    @else
                        <ul class="list-group list-group-flush" >
                            <li class="list-group-item" style="background: rgb(233, 233, 233)">
                                <div class="mb-1" >
                                    <div class="col-md-0 float-right">
                                        <livewire:add-cart :product_id="$productSeller->id" />
                                    </div>
                                    <img width="50" height="50"
                                        src="{{ asset('storage/images/' . $productSeller->user->photo->path) }}"
                                        alt="..." />
                                    Seller: <a class="small mb-1">{{ $productSeller->user->name }}</a>
                                </div>
                                <div class="col-md-0 float-right">
                                <strong>Price</strong>
                                @if ($productSeller->discount > 0)
                                    {{ ($productSeller->discount / 100) * $productSeller->price }}€
                                @else
                                    {{ $productSeller->price }}€
                                @endif
                            </div>
                            </li>
                        </ul>
                    @endif
                @empty
                    <p>No other sellers</p>
                @endforelse
                {{ $sameProduct->links('pagination::semantic-ui') }}
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($similiarProducts as $product)
                    @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top"
                                    src="{{ asset('storage/images/' . $product->game->photos[0]->path) }}"
                                    alt="..." /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }}</h5>
                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ intval($product->price * 100 - $product->price * 100 * ($product->discount / 100)) / 100 }}
                                        €
                                    @else
                                        {{ $product->price }}€
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <livewire:add-cart :product_id="$product->id" />
                            </div>
                        </div>
                    </div>
                @empty
                    NO PRODUCTS
                @endforelse
            </div>
        </div>
    </section>
    @include('partials.footer')
@endsection
