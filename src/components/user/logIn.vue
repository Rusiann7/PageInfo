<template>

  <div v-if="isLoading" class="loading-screen">
    <div class="loading-spinner"></div>
    <p>Loading...</p>
  </div>

  <header>
    <h1>Login</h1>
  </header>

  <main>
  <div class="Content">
    <div class="">
      <button @click="active = 'login'">Login</button>
      <button @click="active = 'register'">Register</button>
    </div>

    <div v-if="active === 'login'">
      <form method="post" @submit.prevent="loginn">
        <label for="email">Email: </label>
        <input type="email" required v-model="login.email">

        <label for="password">Password: </label>
        <input type="password" required v-model="login.password">

        <button type="submit">Login</button>
      </form>
    </div>

    <div v-if="active === 'register'">
      <form method="post" @submit.prevent="">
        <label for="email">Email: </label>
        <input type="email" placeholder="Email" required v-model="register.email">

        <label for="password">Password: </label>
        <input type="password" placeholder="Password" required v-model="register.password">

        <label for="conpassword">confirm Password: </label>
        <input type="password" placeholder="Confirm Password" required v-model="register.confirmpassword">

        <label for="flname">First Name: </label>
        <input type="text" placeholder="First Name" required v-model="register.flname">

        <label for="lnname">Last Name: </label>
        <input type="text" placeholder="Last Name" required v-model="register.lnname">
      </form>
    </div>
  </div>

  </main>

</template>

<script>
const url1 = "http:/localhost:8000";
//const url2 = "https:/"

export default{
  name: "logIn",
  data() {
    return{
      loginphp: `${url1}/login.php`,
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
          this.$router.push('/dashboard')
         }else{
          console.log("Error")
         }
      }catch(error){
        console.error(error)
      }
    }
  }

}

</script>

<style scoped>

</style>
