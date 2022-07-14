@extends("layouts.quiz-layout")

@section("container")

    <div id="wrapper">
        <div class="container">
            <div class="row text-center pt-5 mb-5">
                <div class="title">
                    <h1>{{ __("quiz.product_offer") }}</h1>
                </div>
            </div>
            <div class="row">
                @foreach($products->combination->products as $p)
                    <div class="col-md-4 col-12">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('uploads/' . $p->product->image) }}" class="card-img-top" alt="{{ $p->product->translations_string() }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $p->product->translations_string() }}</h5>
                                <p class="card-text">{{ $p->product->translations_string('description') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
