@extends('layouts.app')

@section('content')
<div class="row">
@foreach($products as $product)
<div class="col-3 mb-3">
    <pool-item-component :product="{{$product}}"></pool-item-component>
</div>
</div>
@endforeach
@endsection
