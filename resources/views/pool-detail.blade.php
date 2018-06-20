@extends('layouts.app')

@section('content')
<div class="container">
	<h2>基本信息</h2>
	<h6>
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
	</h6>
	<hr>
	<h2>状态</h2>
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
	<hr>
	<h2>图片</h2>
	<h3>正面</h3>
	<div>
		<img src="{{$product->frontImage->large_path}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
	</div>
	<h3>反面</h3>
	<div>
		<img src="{{$product->backImage->large_path}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
	</div>
	<h3>等级</h3>
	@foreach($product->levelImages as $levelImage)
	<div>
		<img src="{{$levelImage->large_path}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
	</div>
	@endforeach
	<h3>证书</h3>
	@foreach($product->loaImages as $loaImage)
	<div>
		<img src="{{$loaImage->large_path}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
	</div>
	@endforeach
	<h3>其他</h3>
	@foreach($product->otherImages as $otherImage)
	<div>
		<img src="{{$otherImage->large_path}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
	</div>
	@endforeach
	<form action="/productStatus/{{$product->id}}" method="post">
		@csrf
		@method('PATCH')
		<div class="form-check">
			<input class="form-check-input" type="radio" name="status" id="approved" value="approved" checked>
			<label class="form-check-label" for="approved">
				批准通过
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="status" id="rejected" value="rejected">
			<label class="form-check-label" for="rejected">
				拒绝
			</label>
		</div>

		<button type="submit" class="btn btn-primary">提交</button>
	</form>
</div>


@endsection