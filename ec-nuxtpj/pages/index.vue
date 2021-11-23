<template>
  <div>
    <div class="eyecatch">
      <img class="eyecatch-img" :src="eyecatch">
      <div class="eyecatch-sentence">
        <h2>New Arrivals</h2>
        <p>for BOYS &amp; GIRLS</p>
      </div>
    </div>
    <Product/>
  </div>
</template>

<script>
export default{
  auth: false,
  data(){
    return{
      eyecatch:`http://127.0.0.1:8000/storage/images/sandal.jpg`,
      product:[],
    };
  }
}
</script>

<style>
.eyecatch{
  position:relative;
}
.eyecatch-img{
  height: inherit;
  width: 100%;
  height: auto;
}
.eyecatch-sentence{
  position: absolute;
  top:40%;
  left:60%;
  font-size: 30px;
}
.eyecatch-sentence h2{
  font-size:60px;
}

.eyecatch-sentence p{
  font-size:30px;
  margin-top:10px;
}

</style>