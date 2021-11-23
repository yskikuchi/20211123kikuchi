<template>
  <div class="thanks__wrapper">
    <div class="thanks__top">
      <p>ありがとうございます。注文が確定されました。</p>
      <p>注文内容と配送状況につきましてはEメールでお知らせをご確認ください。</p>
    </div>
    <div class="thanks__box">
      <p>注文番号</p>
      <p>{{$route.query.orderId}}</p>
      <p>で承りました</p>
      <NuxtLink to="/"><button>ショッピングを続ける</button></NuxtLink>
    </div>
  </div>
</template>

<style>
.thanks__wrapper{
  text-align: center;
}
.thanks__top p:first-child{
  font-size: 30px;
  font-weight: bold;
  margin-top: 100px;
}
.thanks__top p:last-child{
  margin:30px 0 50px 0;
}

.thanks__box{
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  margin:0 auto;
  height: 200px;
  width: 50%;
  background: whitesmoke;
}

.thanks__box p:first-child, p:nth-child(2){
  font-weight: bold;
}

.thanks__box button{
  display: block;
  width: 200px;
  height: 30px;
  margin:0 auto;
  background: yellowgreen;
  border:none;
  border-radius: 10px;
  color: white;
}
</style>