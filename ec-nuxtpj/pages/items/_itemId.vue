<template>
  <div class="item__wrapper">
    <div class="item__info">
      <img :src="image"/>
      <div class="item__info-contents">
        <p>{{product.name}}</p>
        <p>¥{{product.price | moneyLocaleString}}(税込)</p>
        <label>個数</label><input type="number" v-model.number="quantity"/>
        <button class="item__info-btn" @click="addItem">カートに入れる</button>
      </div>
    </div>
    <div class="item__intro">
      <h3>毎日履きたくなる、スニーカー。</h3>
      <p>朝の支度が格段にラクになる一足。シンプルで飽きのこないチームコートは、クリーンでモダンなデザインが魅力。合わせたいのは、デニムやバギースウェット。スタイリッシュなレザーアッパーとフレッシュなカラーが、どんなコーディネートも引き締めてくれる。もちろん、履き心地の良さも言うことなし。</p>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      product:"",
      quantity:null,
      image:"",
    };
  },
  async created(){
    const resData = await this.$axios.get("http://127.0.0.1:8000/api/items/" + this.$route.params.itemId);
    this.product = resData.data.data[0],
    this.image = 'http://127.0.0.1:8000/'+ this.product.image;
    console.log(this.product);
  },
  filters:{
    moneyLocaleString(value){
      value=Number(value);
      return value.toLocaleString();
    }
  },
  methods:{
    addItem(){
      const checkQuantity = this.quantity != 0;
      const checkInteger = Number.isInteger(this.quantity) && Math.sign(this.quantity) != -1;
      if(!checkInteger){
        alert('個数の値が不正です');
      }else if(!checkQuantity){
        alert('個数が0です');
      }else{
      this.$store.commit('putInCart', {product:this.product,quantity:this.quantity});
      this.quantity = null;
      this.$router.push('/cart');
      }
    }
  }

}
</script>

<style>
.item__wrapper{
  display: flex;
  flex-direction: column;
  justify-content: center;
  width:50%;
  margin:0 auto;
  height: 88vh;
}

.item__info{
  display: flex;
  justify-content: center;
  margin-bottom: 50px;
}
.item__info img{
  display: block;
  width: 200px;
  height: 200px;
  object-fit: cover;
}

.item__info-contents{
  padding:20px 5px;
}
.item__info p:first-of-type{
  font-size: 25px;
  margin-bottom: 30px;
}
.item__info p:nth-of-type(2){
  font-size: 30px;
  font-weight: bold;
  margin-bottom:25px;
}
.item__info input{
  width: 100px;
  background: whitesmoke;
  border:none;
}
.item__info button{
  display: block;
  position: relative;
  width: 170px;
  margin-top: 20px;
  background: yellowgreen;
  border:none;
  border-radius: 10px;
  color: white;
}

.item__info button::before{
  content: "";
  background-image: url('http://127.0.0.1:8000/storage/images/whitecart.png');
  position:absolute;
  top:10%;
  left:15px;
  height: 20px;
  width: 20px;
}

.item__intro{
  padding:0 10%;
  font-size: 15px;
}
.item__intro h3{
  margin-bottom: 20px;
}
</style>