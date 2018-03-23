<template>
    <div class="shops-box">
        <div class="shop-box" v-for="shop in shops" :key="shop.id" > 
            <span class="shop-title">{{shop.title}}</span>
            <img  class="shop-picture" :src="'/storage/'+shop.picture">
            <div  class="shop-box-footer">
            <button class="shop-btn remove-btn" @click="Remove(shop)">Remove</button>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props:{
        ShopsData:{
            Type:Array,
        }
    },
    data(){
        return{
            shops:this.ShopsData
        }
    },
    methods:{
        // Like a shop
        Remove(shop){
            axios.post('/remove-preferred',shop)
            .then(response=>this.delete(shop))
            .catch(error=> console.log(error.response))
        },
        // delete shop from array 
        delete(shop){
            this.shops = this.shops.filter(elem=>elem!==shop)
        }
    }
  
}
</script>
