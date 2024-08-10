@extends('front.layouts.app')

@section('content')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-1.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-1.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Keyboard</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Mouse</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-3.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-3.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

<section class="section-3 mt-5">
    <div class="container">
        <div class="section-title">
            <h2>Categories</h2>
        </div>
        <div class="row pb-3">
    @if (getCategories()->isNotEmpty())
        @foreach (getCategories() as $category)
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        @if ($category->image != "")
                            <a href="{{ route('front.shop', [$category->slug]) }}"><img src="{{ asset('uploads/category/thumb/'.$category->image) }}" alt="" class="img-fluid"></a>
                        @else
                            <a href="{{ route('front.shop', [$category->slug]) }}"><img src="{{ asset('uploads/category/thumb/default-150x150 copy.png') }}" alt="" class="img-fluid"></a>
                        @endif
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>{{ $category->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

    </div>
</section>

<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
        </div>
        <div class="row pb-3">
            @if ($featuredProducts->isNotEmpty())
            @foreach ($featuredProducts as $product)
            @php
                $productImage = $product->product_images->first();
            @endphp
            <div class="col-md-3">
                <div class="card product-card">
                    <div class="product-image position-relative">
                        <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                            
                            {{-- <img class="card-img-top" src="images/product-1.jpg" alt=""> --}}

                            @if (!empty($productImage->image))
                            <img class="card-img-top"  src="{{ asset('uploads/product/small/'.$productImage->image) }}"/>
                            @else
                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}"/>
                            @endif

                        </a>

                        <a onclick="addToWishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>

                        <div class="product-action">
                            @if ($product->track_qty == 'Yes')
                                @if ($product->qty > 0)
                                    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                            @else
                            <a class="btn btn-dark" href="javascript:void(0);" onclick="showOutOfStockAlert();">
                                Kehabisan Stock
                            </a>
                            @endif
                            @else
                            <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="{{ route("front.product",$product->slug) }}">{{ $product->title }}</a>
                        <div class="price mt-2">

                            <span class="h5"><strong> Rp    {{ $product->price }}</strong></span>
                            @if($product->compare_price > 0)
                            <span class="h6 text-underline"><del>Rp {{ $product->compare_price }}</del></span>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<section class="section-4 pt-5">
    <div class="container">
            <div class="section-title">
                <h2>Lastest Products</h2>
            </div>
            <div class="row pb-3">
            @if ($latestProducts->isNotEmpty())
                @foreach ($latestProducts as $product)
                @php
                    $productImage = $product->product_images->first();
                @endphp
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                                
                                {{-- <img class="card-img-top" src="images/product-1.jpg" alt=""> --}}

                                @if (!empty($productImage->image))
                                <img class="card-img-top"  src="{{ asset('uploads/product/small/'.$productImage->image) }}"/>
                                @else
                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}"/>
                                @endif

                            </a>
                            <a onclick="addToWishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                            <div class="product-action">
                                @if ($product->track_qty == 'Yes')
                                    @if ($product->qty > 0)
                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                @else
                                <a class="btn btn-dark" href="javascript:void(0);" onclick="showOutOfStockAlert();">
                                    Kehabisan Stock
                                </a>
                                @endif
                                @else
                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                                @endif
                            </div>
                            
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{ route("front.product",$product->slug) }}">{{ $product->title }}</a>
                            <div class="price mt-2">

                                <span class="h5"><strong> Rp    {{ $product->price }}</strong></span>
                                @if($product->compare_price > 0)
                                <span class="h6 text-underline"><del>Rp {{ $product->compare_price }}</del></span>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
        </div>
</section>
@endsection

@section('customJs')
<script>
    function showOutOfStockAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Out of Stock',
            text: 'Sorry, this product is currently out of stock.',
            confirmButtonText: 'OK'
        });
    }

    function addToCart(id) {
    $.ajax({
        url: '{{ route("front.addToCart") }}',
        type: 'post',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.status == true) {
                // Product added to the cart successfully, show a SweetAlert2 success popup
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart ',
                    html: response.message,
                    showConfirmButton: false, // Remove the "OK" button
                    timer: 1500 // Auto close after 1.5 seconds
                });
                // You can also redirect to the cart page if needed
                // window.location.href = '{{ route("front.cart") }}';
            } else {
                // Product is already added to the cart, show a SweetAlert2 info popup
                Swal.fire({
                    icon: 'info',
                    title: 'Product Already in Cart',
                    html: response.message,
                    confirmButtonText: 'OK',
                    footer: '<a href="{{ route('front.cart') }}">Go to Cart</a>'
                });
            }
        }
    });
}

    function addToWishlist(id) {
        $.ajax({
            url: '{{ route("front.addToWishlist") }}',
            type: 'post',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    // Product added to the wishlist successfully, show a SweetAlert2 success popup
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Wishlist',
                        html: response.message,
                        showConfirmButton: false, // Remove the "OK" button
                        timer: 1500 // Auto close after 1.5 seconds
                    });
                } else {
                    // Product is already in the wishlist, show a SweetAlert2 info popup
                    Swal.fire({
                        icon: 'info',
                        title: 'Product Already in Wishlist',
                        html: response.message,
                        confirmButtonText: 'OK',
                        footer: '<a href="{{ route('account.wishlist') }}">Go to Wishlist</a>'
                    });
                }
            }
        });
    }

</script>
@endsection