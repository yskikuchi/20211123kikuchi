<template>
  <div class="trace__wrapper">
    <Header/>
    <Nuxt/>
    <Footer/>
  </div>
</template>

<style>
.trace__wrapper{
  width:65%;
  margin:0 auto;
  min-height: 100vh;
  position: relative;
}
Footer{
  position: absolute;
  bottom:0px;
}
button{
  cursor: pointer;
}

</style>