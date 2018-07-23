<template>
    <div class="card">
	<img class="card-img-top" :src="product.front_image.small_path" alt="Card image cap">
	<div class="card-body">
		<h5 class="card-title">
			<a :href="'pool/'+ product.id">
				<span v-for="player in product.players" :key="player.id">{{player.name}}</span>
                <span v-for="season in product.seasons" :key="season.id">{{season.name}}</span>
				<span>{{product.team.name}}</span>
				<span>{{product.level.name}}</span>
				<span v-for="item in product.items" :key="item.id">{{item.name}}</span>
                <span v-for="loa in product.loas" :key="loa.id">{{loa.name}}</span>
				<span v-if="product.note">{{product.note}}</span>
			</a>
		</h5>
		<div class="card-text">
			<p>发布者：{{ product.user.name}}</p>
            <span v-if="product.sale_status.forSale == 'forSale'" class="badge badge-primary badge-pill mr-1">出售中</span>
            <span v-if="product.sale_status.forSale == 'notForSale'" class="badge badge-primary badge-pill mr-1">收藏展示</span>
            <span v-if="product.sale_status.forSale == 'sold'" class="badge badge-primary badge-pill mr-1">已售出</span>
            <span v-if="product.sale_status.price" class="badge badge-pill badge-primary mr-1">¥{{ product.sale_status.price }} </span>  
            <span v-if="product.sale_status.tradeMethod == 'platform' || product.sale_status.tradeMethod == 'both'" class="badge badge-warning mr-1">支持平台担保</span>
            <span v-if="product.sale_status.tradeMethod == 'private' || product.sale_status.tradeMethod == 'both'" class="badge badge-warning mr-1">支持私下交易</span>
            <span v-if="product.sale_status.quotedMethod == 'fixed' || product.sale_status.quotedMethod == 'both'" class="badge badge-info mr-1">接受一口价</span>
            <span v-if="product.sale_status.quotedMethod == 'quoted' || product.sale_status.quotedMethod == 'both'" class="badge badge-info mr-1">接受报价</span>
		</div>
	</div>
</div>
</template>

<script>
export default {
  props: ["product"],
  mounted() {
    // console.log(this.product.id);
  }
};
</script>
