<template>
  <div class="register">
    <h2 class="register__ttl">新規会員登録</h2>
    <p>初めてご利用の方・会員以外の方</p>
    <p>初めてご利用のお客様は、こちらから会員登録を行ってください。</p>
    <validation-observer ref="obs" v-slot="ObserverProps">
      <form @submit.prevent="register">
        <validation-provider v-slot="{ errors }" rules="required|email">
          <div class="error">{{ errors[0] }}</div>
          <label>メールアドレス</label><input type="email" name="email" v-model="email" placeholder="email" /><br>
        </validation-provider>
        <validation-provider v-slot="{ errors }" rules="required|min:6">
          <div class="error">{{ errors[0] }}</div>
          <label>パスワード</label><input type="password" name="password" v-model="password" placeholder="password" /><br>
        </validation-provider>
        <validation-provider v-slot="{ errors }" rules="required|min:4">
          <div class="error">{{ errors[0] }}</div>
          <label>お名前</label><input type="text" name="name" v-model="name" placeholder="name" />
        </validation-provider>
        <button class="register__btn" type="submit" :disabled="ObserverProps.invalid || !ObserverProps.validated">新規会員登録</button>
      </form>
    </validation-observer>
  </div>
</template>

<script>
export default {
  auth:false,
  data(){
    return{
    name:null,
    email:null,
    password:null
  };
  },
  methods:{
    async register(){
      try{
        await this.$axios.post("http://localhost:8000/api/auth/register",{
          name:this.name,
          email:this.email,
          password:this.password
        });
        await this.$auth.loginWith("laravelJWT",{
          data:{
            email:this.email,
            password:this.password
          },
        });
        this.$router.push("/");
      }catch{
        alert("メールアドレスがすでに登録されています");
      }
    }
  }
}
</script>

<style>
.error{
  color:red;
}
.register{
  width: 35%;
  margin-left:20px;
}

.register__ttl{
  font-size: 25px;
}
.register p:first-of-type{
  margin:20px 0;
  border-bottom: 3px solid black;
  font-weight: bold;
}
.register p:nth-of-type(2){
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

.register__btn{
  display: block;
  margin:10px auto;
  background: yellowgreen;
  border:none;
  width: 200px;
  color: white;
  cursor: pointer;
}
</style>