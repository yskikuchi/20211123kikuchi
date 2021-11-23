<template>
  <div class="cart__wrapper">
    <h2>ショッピングカート</h2>
    <div class="cart__contents">
      <div class="cart__items" >
        <CartItem v-for="item in $store.getters.getCart" :key="item.id" :item="item"></CartItem>
      </div>
      <div class="cart__order">
        <p>合計：{{orderAmount | moneyLocaleString}} 税込</p>
        <button v-if="amount > 0" @click="buyItems">注文する</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      amount:null,
    };
  },
  computed:{
    orderAmount(){
      this.amount=this.$store.getters.getPrice.reduce((a,b)=> a + b,0);
      return this.amount;
    }
  },
  filters:{
    moneyLocaleString(value){
      return value.toLocaleString();
    }
  },
  methods:{
    async buyItems(){
      const cartData = this.$store.getters.getCart;
      const quantities = cartData.map(e => e.quantity);
      const checkInteger = quantities.every(e => Number.isInteger(e) && Math.sign(e) != -1);
      const checkQuantity = quantities.every(e => e != 0);
      if(!checkInteger){
        alert("個数の値が不正です");
      }else if(!checkQuantity){
        alert("個数が0です");
      }else{
      const resData = await this.$axios.post("http://127.0.0.1:8000/api/order",{user_id:this.$auth.user.id});
      console.log(resData.data.data);
      const orderId=resData.data.data.id;
      const orderData=[];
      for(let i = 0;i < cartData.length;i++){
      let data = {
        user_id:this.$auth.user.id,
        item_id:cartData[i].product.id,
        order_id:orderId,
        quantity:Number(cartData[i].quantity)
      };
      orderData.push(data);
      };
      console.log(orderData);
      await this.$axios.post("http://127.0.0.1:8000/api/details",orderData);
      this.$store.commit('clearItem');
      this.$router.push({path:'thanks',query:{orderId:orderId}});
    }
    }
  }
}
</script>

<style>
.cart__wrapper{
  margin-top:50px;
}
.cart__wrapper h2{
  font-size:20px;
  margin-bottom: 20px;
}
.cart__contents{
  display: flex;
  justify-content: space-between;
}
.cart__items{
  display: flex;
  flex-direction: column;
  width: 60%;
}
.cart__items:first-of-type{
  border-top:1px solid black;
}
.cart__order{
  display: flex;
  flex-direction: column;
  justify-content: center;
  background: whitesmoke;
  border:none;
  width:25%;
  height: 150px;
  text-align: center;
}
.cart__order p{
  font-size: 20px;
  font-weight: bold;
}

.cart__order button{
  display: block;
  margin:20px auto;
  width:100px;
  background: yellowgreen;
  border:none;
  border-radius: 10px;
  color: white;
}


</style>