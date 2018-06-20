@extends('layouts.app')

@section('content')
@foreach($products as $product)
<div class="card mb-3">
    <div class="card-body media">
        <figure class="figure text-center mr-3">
            <span>
                <img src="{{ $product->frontImage->thumbnail_path }}" alt="..." class="img-thumbnail align-self-start">
            </span>
        </figure>
        <div class="media-body">
            <h6>
                <a href="/pool/{{$product->id}}">
                    @foreach($product->players as $player)
                    <span>{{$player->name}} </span>
                    @endforeach
                    @foreach($product->seasons as $season)
                    <span>{{$season->name}}</span>
                    @endforeach
                    <span>{{$product->team->name}} </span>
                    <span>{{$product->level->name}} </span>
                    @foreach($product->items as $item)
                    <span>{{$item->name}} </span>
                    @endforeach
                    @foreach($product->loas as $loa)
                    <span>{{$loa->name}} </span>
                    @endforeach
                    <span>{{$product->note}}</span>
                </a>
            </h6>
            <p>
                @if($product->saleStatus->forSale == 'forSale')
                <span class="badge badge-primary badge-pill mr-1">出售中</span>
                @endif
                @if($product->saleStatus->forSale == 'notForSale')
                <span class="badge badge-primary badge-pill mr-1">收藏展示</span>
                @endif
                @if($product->saleStatus->forSale == 'sold')
                <span class="badge badge-primary badge-pill mr-1">已售出</span>
                @endif

                @if($product->saleStatus->price)
                <span class="badge badge-pill badge-primary mr-1">¥{{ $product->saleStatus->price }} </span>
                @endif
                @if($product->saleStatus->tradeMethod == 'platform' || $product->saleStatus->tradeMethod == 'both')
                <span class="badge badge-warning mr-1">支持平台担保</span>
                @endif
                @if($product->saleStatus->tradeMethod == 'private' || $product->saleStatus->tradeMethod == 'both')
                <span class="badge badge-warning mr-1">支持私下交易</span>
                @endif
                @if($product->saleStatus->quotedMethod == 'fixed' || $product->saleStatus->tradeMethod == 'both')
                <span class="badge badge-info mr-1">接受一口价</span>
                @endif
                @if($product->saleStatus->quotedMethod == 'quoted' || $product->saleStatus->tradeMethod == 'both')
                <span class="badge badge-info mr-1">接受报价</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endforeach
@endsection
