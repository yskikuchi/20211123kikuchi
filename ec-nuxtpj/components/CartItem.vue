<template>
  <div :item="item">
    <div class="cart__item">
        <div>
          <img class="cart__item-img" :src="'http://127.0.0.1:8000/'+ item.product.image">
        </div>
        <div class="cart__item-content">
          <p>{{item.product.name}}</p>
          <button @click="deleteItem">削除する</button>
        </div>
        <div class="cart__item-input">
          <label>個数</label><input type="number" v-model.number="changeQuantity">
          <p>¥{{item.product.price}}(税込)</p>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  props:{
    item:{
      type:Object
    },
  },
  computed:{
    changeQuantity:{
      get(){
        return this.item.quantity;
      },
      set(val){
        this.$store.commit('changeQuantity',{
          item_id:this.item.product.id,
          quantity:val
        } )
      }
    }
  },
  methods:{
    deleteItem(){
      this.$store.commit('putOutItem', this.item.product.id);
    }
  }
}
</script>

<style>
.cart__item{
  border-bottom: 1px solid black;
  padding:5px;
  display: flex;
  justify-content: space-between;
  position: relative;
}

.cart__item-img{
  width: 100px;
  height: auto;
  display: block;
}
.cart__item-content{
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.cart__item-content p{
  position: absolute;
  top:50%;
  left:25%;
  transform:translate(0,-50%);
}
.cart__item-content button{
  position:absolute;
  top:70%;
  left:25%;
  border:none;
  background: none;
}
.cart__item-input{
  display: flex;
  align-items: center;
}
.cart__item-input input{
  width: 60px;
}

.cart__item-input p{
  margin-left:5px;
}

</style>