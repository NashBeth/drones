@extends('site.app')
@section('title', 'Homepage')

@section('content')
    <div class="container">
        <div id="app">
            <header class="with-background">
                <div class="top-nav container">
                    <div class="top-nav-left">
                        <div class="logo">ABCDRONES</div>

                    </div>
                    {{-- <div class="top-nav-right">
                        @include('site.partials.header')
                    </div>
                </div> <!-- end top-nav --> --}}
                    <div class="hero container">
                        <div class="hero-image">
                            <img src="https://dronerush.com/wp-content/uploads/2018/08/DJI-Mavic-2-Pro-flying-top.jpg"
                                alt="hero image">
                        </div> <!-- end hero-image -->
                    </div> <!-- end hero -->
            </header>
        </div>
        <div class="container">
            <div class="products text-center">
                @foreach ($products as $product)
                    <div class="product">
                        <a href="{{ route('product.show', $product->slug) }}"><img
                                src="{{ asset('../../storage/' . $product->images->first()->full) }}" height="100px"
                                width="200px" alt="product">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <div class="product-name">{{ $product->name }}</div>
                            </a>
                            <div class="product-price">{{ $product->price }}</div>
                    </div>
                @endforeach

            </div>
        </div> <!-- end container -->
    </div>

@stop
