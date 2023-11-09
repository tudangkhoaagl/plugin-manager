@extends('plugin_manager::admin.layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
        @foreach($plugins as $plugin)
            <div class="col-xl-2 col-md-3 col-sm-1">
                <div class="card">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAT4AAACfCAMAAABX0UX9AAAAk1BMVEXv8/VRr6layK////9axq/z9PdQralWyK1kw7dWyK5ZxK58k5/X6un09/hawLOG0sK74dt1jZp+0L6u3dSAnaaH0sLK2duBmKPd7Oxkx7pCq6RWvKz4+vt6mKLq8vOrxsijvMC81dWgwMFkv7WS0slStqzQ6eaj19BguLCV1clry7al2tDD49+h0M1Su6tzyLlFxaic8O/IAAAClklEQVR4nO3ca2+iQBSAYW/jSBXc1htLK7u9gFax6///dSuobIJcRk5S2OR90qRhPk3eHCiCaacDAAAAAAAAAAAAAAAAAAAAAAAAJGzbLlj/5o38l176/f7L7bKdv4yMfqxgmfmrYhd0SpYZvyrkEyGfCPlEyCdCPhHyiZBPhHwi5BNZrufz+XqZXfbnsV98aitnLx/H4/HjMtvJT5bfyFeuPN9v8pUrzTcmX4WCfIrpK6M67uTsdbxarcavk4xwHS+/XY7cpvfbLioaOVc/Y86NZPk9Pdz4Te+5PVTkjO7kfKimd90eo/egezUcdnMMM78DJ2x6060ROt3cZmWCGeN3Ed7b7sTbkO9qWyPfpOlNt4aKvHtPXu+DW8CUiraB55m387aHprfcKqfbZnfWG5iZuq7PhS9D/dA9I3pKu1vG+Szy5TCfvgX5bnHyinDyiqT5HgoxfcXSfN1hRrrwwPQV+pevyCUf05fHOJ/FX94cTJ8I+UTIJ2J+7SNfDqZPhHwi5vm4ccnB9ImQT4R8IuQTMcg34L6vkIrO+XRQVK97eVz6Sb4ck+vT5uDmiV8iGFwel/L1jFw7q2fiyNcz8qi90csOa9f0RlvKNxo/HXLu5lKhru6n99QroKJeVT+9b3qTLabcqdbaSp0vdslSvKqPu4jZK6Mms8XT1S55u5seLj7DDvUqxIH8+MfvHOJXvFv7fHBaU8S7gzrE35jc0qwedYg/bJCvJrX5en7++kO+etTs9DFEP5GvniSfRb6amD6Rcz4ejtbEyStCPhGufSLkE+HkFWH6RMgnwskrQj4R8omQT4R8IvzlFWH6RMgnwskrwvSJkE9E7Y9aH3lRWZcb8o82AQAAAAAAAAAAAAAAAAAAvtVfksk3P/omuEUAAAAASUVORK5CYII="
                        class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $plugin->name }}</h5>
                        <p class="card-text">{{ $plugin->description }}</p>
                        <p class="card-text">Status: {{ Str::title($plugin->status) }}</p>
                    </div>
                </div>
                @endforeach

            </div>
    </div>
@endsection
