<template>
  <div class="product__wrapper">
    <h2 class="product__ttl">Product</h2>
    <div class="cards" >
      <div class="card__item" v-for="product in products.data" :key="product.id">
        <NuxtLink :to="{name:'items-itemId', params:{itemId:product.id}}"><img class="card__item-img" :src="'http://127.0.0.1:8000/'+ product.image"/></NuxtLink>
        <p>{{product.name}}</p>
        <p>¥{{product.price|moneyLocaleString}}(税込)</p>
      </div>
    </div>
    <div class="pagination">
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
      products:[],
      currentPage:1,
      lastPage:"",
      pages:[],
    };
  },
  async created(){
    await this.getItems();
    if(this.lastPage <= 5){
      this.callRange(this.currentPage, this.lastPage);
    }else{
      this.callRange(this.currentPage,this.currentPage+4);
    }
  },
  filters:{
    moneyLocaleString(value){
      value=Number(value);
      return value.toLocaleString();
    }
  },
  methods:{
    async getItems(){
    const resData = await this.$axios.get(`http://127.0.0.1:8000/api/items?page=${this.currentPage}`);
    this.products = resData.data.data,
    console.log(this.products);
    this.lastPage = this.products.last_page;
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
      this.getItems();
      //ページ数の表示を再構成するかどうかを判定
      if(!this.pages.includes(page)){
      this.callRange(page,page+4);
      }
    },
    isCurrent(page){
      return page == this.currentPage;
    }
  }
}
</script>

<style>
.product__wrapper{
  width: 100%;
}
.product__ttl{
  text-align: center;
  font-size: 30px;
  margin-top:10px;
}

.cards{
  display: flex;
  width:100%;
  flex-wrap:wrap;
  justify-content: space-around;
}

.card__item{
  width:21%;
  margin-top:10px;
}

.card__item-img{
  width:100%;
  height: 200px;
  object-fit: cover;
}

.pagination{
  display: flex;
  align-items: center;
  height: 150px;
}
.pagination__items{
  display: flex;
  list-style: none;
  margin:0px auto;
}
.pagination li{
  text-align: center;
  height: 15px;
  width:40px;
  border:solid 3px rgba(24, 148, 7, 0.747);
  border-radius: 10px;
  margin: 10px 3px;
  cursor: pointer;
}
.current-page{
  background: rgba(24, 148, 7, 0.747);
  color: white;
}
</style>