<template>
  <header>
    <NuxtLink to="/"><h1 class="logo">Trace</h1></NuxtLink>
    <nav>
      <p v-if="$auth.loggedIn" class="user-name">Name:{{$auth.user.name}}</p>
      <NuxtLink to="/cart"><img src="http://127.0.0.1:8000/storage/images/cart.png"></NuxtLink>
      <NuxtLink to="/mypage"><img src="http://127.0.0.1:8000/storage/images/user.png"></NuxtLink>
      <img v-if="$auth.loggedIn" @click="logout" src="http://127.0.0.1:8000/storage/images/logout.png">
    </nav>
  </header>
</template>

<script>
export default {
  mounted(){
  console.log(this.$auth);
  },
  methods: {
    async logout() {
      try {
        await this.$auth.logout();
        this.$store.commit('clearItem');
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    },
  }
}
</script>

<style>
a{
  text-decoration: none;
  color: black;
}
header img{
  width:20px;
  height: 20px;
  margin-right: 10px;
}

header{
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 50px;
  border-bottom:solid 1px rgba(128, 128, 128, 0.26);
  margin-bottom: 10px;
}
nav{
  display: flex;
  align-items: center;
}
.logo{
  font-size: 30px;
  font-weight: normal;
  margin-left:10px;
}
.user-name{
  margin-right: 20px;
}

</style>