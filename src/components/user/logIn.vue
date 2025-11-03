<template>

  <div v-if="isLoading" class="loading-screen">
    <div class="loading-spinner"></div>
    <p>Loading...</p>
  </div>

  <main>
  <div class="content">
    <div class="button-row" style="margin-top: 90px;">
      <button @click="active = 'login'">Login</button>
      <button @click="active = 'register'">Register</button>
    </div>

    <div v-if="active === 'login'" style="margin-top: 50px;" class="login-form">
      <div class="header-container">
        <h1>Login</h1>
      </div>

      <form method="post" @submit.prevent="loginn">
        <label for="email">Email: </label>
        <input type="email" required v-model="login.email" placeholder="Email">

        <br>

        <label for="password">Password: </label>
        <input type="password" required v-model="login.password" placeholder="Password">

        <br>

        <button type="submit">Login</button>
      </form>
    </div>

    <div v-if="active === 'register'" class="register-form">
      <div class="header-container">
        <h1>Register</h1>
      </div>

      <form method="post" @submit.prevent="registerr">
        <label for="email">Email: </label>
        <input type="email" placeholder="Email" required v-model="register.email">

        <br>

        <label for="password">Password: </label>
        <input type="password" placeholder="Password" required v-model="register.password">

        <br>

        <label for="conpassword">Confirm Password: </label>
        <input type="password" placeholder="Confirm Password" required v-model="register.confirmpassword">

        <br>

        <label for="flname">First Name: </label>
        <input type="text" placeholder="First Name" required v-model="register.flname">

        <br>

        <label for="lnname">Last Name: </label>
        <input type="text" placeholder="Last Name" required v-model="register.lnname">

        <br>

        <button type="submit" class="">Submit</button>
      </form>
    </div>
  </div>
  </main>

</template>

<style scoped>

.content{
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.header-container{
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 30px;
}

.login-form input{
  margin: 10px;
}

.button-row button{
  margin: 0px 20px;
}

.register-form{
  display: flex;
  flex-direction: column;
  align-items: center;
}

.register-form input{
  margin: 10px;
}
</style>

<script>
const url1 = "http://localhost:8001";
//const url2 = "https:/"

export default{
  name: "logIn",
  data() {
    return{
      loginphp: `${url1}/login_user.php`,
      registerphp: `${url1}/register.php`,
      isLoading: false,
      login: {email: "", password: "" },
      register: {email: "", password: "", confirmpassword: "", flname: "", lnname: ""},
      active: 'login'
    }
  },

  methods:{

    async loginn(){
      try{
         const response = await fetch(this.loginphp, {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({
            action: "login",
            ...this.login
          }),
         });

         const result = await response.json();

         if(result.success){
          this.$router.push('/')
         }else{
          console.log("Error")
         }
      }catch(error){
        console.error(error)
      }
    },

    async registerr(){
      try{

        const response = await fetch(this.registerphp, {
          method: "post",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({
            action: "register",
            ...this.register
          }),
        });

        const result = await response.json()

        if(result.success){
          this.isLoading = false;
          this.active = "login"
        }
      }catch(error){
        console.error(error)
      }
    }
  }

}

</script>


