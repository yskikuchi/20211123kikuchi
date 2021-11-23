<template>
  <div class="login">
    <h2 class="login__ttl">ログイン</h2>
    <p>会員のお客さま</p>
    <p>メールアドレスとパスワードを入力してログインしてください。</p>
    <validation-observer ref="obs" v-slot="ObserverProps">
    <form @submit.prevent="login">
      <validation-provider v-slot="{ errors }" rules="required|email">
        <div class="error">{{ errors[0] }}</div>
        <label>メールアドレス:</label><input type="email" name="email" v-model="email" placeholder="email" /><br>
      </validation-provider>
      <validation-provider v-slot="{ errors }" rules="required|min:6">
        <div class="error">{{ errors[0] }}</div>
        <label>パスワード:</label><input type="password" name="password" v-model="password" placeholder="password" />
      </validation-provider>
      <button class="login__btn" type="submit" :disabled="ObserverProps.invalid || !ObserverProps.validated">ログイン</button>
    </form>
    </validation-observer>
  </div>
</template>

<script>
export default {
  auth:false,
  data(){
    return{
    email:null,
    password:null
  };
  },
  methods:{
    async login(){
      try{
        await this.$auth.loginWith("laravelJWT",{
          data:{
            email:this.email,
            password:this.password
          },
        });
        this.$store.commit('clearItem');
        this.$router.push("/");
      }catch{
        alert("メールアドレスまたはパスワードが間違っております");
      }
    }
  }
}
</script>

<style>
.error{
  color: red;
}
.login{
  width: 35%;
  margin-right: 20px;
}
.login__ttl{
  font-size: 25px;
}
.login p:first-of-type{
  margin:20px 0;
  border-bottom: 3px solid black;
  font-weight: bold;
}
.login p:nth-of-type(2){
  font-size: 13px;
  margin-bottom:20px;
  text-align: center;
}

form{
  text-align: right;
}

form input{
  width:50%;
}

.login__btn{
  display: block;
  margin:10px auto;
  background: black;
  border:none;
  width: 200px;
  color: white;
}
</style>