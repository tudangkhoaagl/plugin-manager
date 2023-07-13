@extends('plugin_manager::admin.layouts.app')

@section('content')
<div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($plugins as $plugin)
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{ $plugin->name }}</h5>
                <p class="card-text">{{ $plugin->description }}</p>
            </div>
        </div>
    @endforeach

    </div>
</div>
@endsection
