<template>
  <div class="order-history__wrapper">
    <h2>購入履歴</h2>
      <div class="order-history__item" v-for="(detail, index) in orderHistory.data" :key="index">
        <img class="order-history__img" :src="'http://127.0.0.1:8000/'+ detail.item.image">
        <div class="order-history__item--right">
          <p>注文番号：{{detail.order_id}}</p>
            <div class="order-history__content">
              <p>{{detail.item.name}}</p>
              <p>{{detail.created_at|formatDate}}</p>
              <p>合計{{detail.quantity}}個</p>
              <p>¥{{detail.item.price * detail.quantity | moneyLocaleString}}(税込)</p>
            </div>
            <div>
              <NuxtLink :to="{name:'items-itemId', params:{itemId:detail.item_id}}">もう一度購入する</NuxtLink>
            </div>
          </div>
    </div>
    <div class="pagination" v-if="haveData">
      <ul class="pagination__items">
        <li v-if="currentPage != 1" @click="changePage(currentPage-1)">前へ</li>
        <li v-for="page in pages" :key="page" @click="changePage(page)" :class="(isCurrent(page)) ? 'current-page':''">{{page}}</li>
        <li v-if="currentPage != lastPage" @click="changePage(currentPage+1)">次へ</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      orderHistory:[],
      haveData:false,
      currentPage:1,
      lastPage:"",
      pages:[],
    }
  },
  async created(){
    await this.getOrderHistory();
    if(this.lastPage <= 5){
      this.callRange(this.currentPage, this.lastPage);
    }else{
      this.callRange(this.currentPage,this.currentPage+4);
    }
  },
  methods:{
    async getOrderHistory(){
      const resData = await this.$axios.get("http://127.0.0.1:8000/api/details",{params:
      {
        user_id:this.$auth.user.id,
        page:this.currentPage
      }
      });
      this.orderHistory = resData.data.data;
      console.log(this.orderHistory);
      if(this.orderHistory.data.length){
        this.haveData = true;
      }
      this.lastPage = this.orderHistory.last_page;
    },
    callRange(start,end){
      const checkLastPage = start <= this.lastPage;
      if(checkLastPage){
        this.pages=[];
        for(let i = start; i <= end; i++){
          if(i<=this.lastPage){
          this.pages.push(i);
          }
      }
      }
    },
    changePage(page){
      this.currentPage = page;
      this.getOrderHistory();
      //ページ数の表示を再構成するかどうかを判定
      if(!this.pages.includes(page)){
      this.callRange(page,page+4);
      }
    },
    isCurrent(page){
      return page == this.currentPage;
    }
  },
  filters:{
    formatDate(Strdate){
      const dt=new Date(Strdate);
      const year = dt.getFullYear();
      const month = dt.getMonth()+1
      const date = dt.getDate()
      return `${year}月${month}日${date}日`
    },
    moneyLocaleString(value){
      value=Number(value);
      return value.toLocaleString();
    }
  }
}
</script>

<style>
.order-history__wrapper{
  width: 70%;
  margin:50px auto;
}
.order-history__item:first-of-type{
  border-top:1px solid black;
}

.order-history__wrapper h2{
  font-size: 25px;
  margin-bottom: 20px;
}
.order-history__img{
  width: 100px;
  height: auto;
}

.order-history__item{
  width: 100%;
  border-bottom: 1px solid gray;
  display: flex;
  padding:10px;
}

.order-history__item--right{
  width: 100%;
  color:gray;
}
.order-history__item--right a{
  color: gray;
}

.order-history__content{
  display: flex;
  justify-content: space-between;
  margin:50px 0;
}
.order-history__content p:first-child{
  margin-right: 200px;
  color: black;
  font-size: 20px;
}
</style>