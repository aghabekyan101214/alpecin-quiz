@extends("layouts.quiz-layout")

@section("container")

    <div id="wrapper">
        <div class="container">
            <div class="row text-center">
                <div class="shap_content position-relative">
                    <img class="w-50" src="{{ asset("quiz-assets/images/rectangle.png") }}">
                    <div class="title">
                        <h1 class="position-absolute">Thank you For your Participation!</h1>
                    </div>
                </div>
                <div class="row">
                    @foreach($products->combination->products as $p)
                        <img src="{{ asset('uploads/' . $p->product->image) }}" alt="">
                        <p>{{ $p->product->translations_string() }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
