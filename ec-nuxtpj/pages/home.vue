<template>
  <div>
    登録完了
    <p v-if="$auth.loggedIn">Name:{{$auth.user.name}}</p>
    <a @click="logout">ログアウト</a>
  </div>
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
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    },
  }
}
</script>