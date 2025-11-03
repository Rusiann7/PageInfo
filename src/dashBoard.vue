<template><!--version 2-->
  <header>
    <nav>
    <ul class="sidebar" ref="sidebar">
      <li @click="hideSidebar">
        <a href="#">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            height="26"
            viewBox="0 -960 960 960"
            width="26"
            fill="#e3e3e3"
          >
          <path
            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"
          />
          </svg>
        </a>

      </li>
      <li><a href="#" @click.prevent="$router.push('/')">Home</a></li>
      <li><a href="#" @click.prevent="$router.push('/collections')">Collection</a></li>
      <li><a href="#" @click.prevent="$router.push('/discover')">Discover</a></li>
      <li><a href="#" @click.prevent="logout">Log Out</a></li>
    </ul>

    <ul>
      <li>
        <a href="#" @click.prevent="$router.push('/')"
          >PageInfo</a>
      </li>
      <li class="hideMobile">
        <a href="#" @click.prevent="$router.push('/')">Home</a>
      </li>
      <li class="hideMobile">
        <a href="#" @click.prevent="$router.push('/collections')">Collection</a>
      </li>
      <li class="hideMobile">
        <a href="#" @click.prevent="$router.push('/discover')">Discover</a>
      </li>
      <li class="hideMobile">
        <a href="#" @click.prevent="logout">Log Out</a>
      </li>
      <li class="menu-btn" @click="showSidebar">
        <a href="#">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            height="26"
            viewBox="0 -960 960 960"
            width="26"
            fill="#e3e3e3"
          >
            <path
              d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"
            />
          </svg>
        </a>
      </li>
    </ul>
  </nav>
  </header>

  <main>

    <div class="header-section" style="margin-top: 100px;">
      <h1>PageInfo</h1>
      <h3>Instant Book Info</h3>
    </div>

    <div class="search-area" style="margin-top: 50px;">

      <form method="post" @submit.prevent="">
        <p>Search your books here:</p>
        <input type="text" placeholder="Type Here">
        <br>
        <button class="" type="submit">Search</button>
      </form>
    </div>

    <div class="modal" v-if="modal === true">

      <div class="image">

        <h1>Title of book</h1>
        <br>
        <img src="../src/assets/logo5.png" alt="" style="max-width: 480px; width: 100%; height: auto;">

        <br>
        <br>

        <button class="">Favorite</button>
      </div>

      <div class="text">
        <h1>AI summarizer</h1>
        <input type="text">
      </div>

    </div>

    <div class="login" style="margin-top: 50px;">
      <h1>Login to save your books and write a review</h1>

      <button class="" @click="$router.push('/login')">Login</button>
    </div>
  </main>
</template>

<script>
import { removeToken} from "../src/utils/auth";

export default{
  name: "dashBoard",
  data(){
    return {
      modal: true
    }
  },

  methods:{
    showSidebar() {
      this.$refs.sidebar.style.display = "flex";
    },

    hideSidebar() {
      this.$refs.sidebar.style.display = "none";
    },

    handleClickOutside(event) {
      if (this.$refs.sidebar &&this.$refs.sidebar.style.display === "flex") {
        const isClickInsideSidebar = this.$refs.sidebar.contains(event.target);
        const isClickOnMenuButton = event.target.closest(".menu-btn");

        if (!isClickInsideSidebar && !isClickOnMenuButton) {
          this.hideSidebar();
        }
      }
    },

    logout() {
        try {
          removeToken();
          this.localUserData = {};
          this.$router.replace("/");
        }catch (error) {
          console.error("Logout error:", error);
        }
      },
  }

}


</script>

<style scoped>

/* Added navbar styles */
* {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  box-sizing: border-box;
}

nav {
  background-color: #2d333f;
  box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
  position: fixed;
  top: 0;
  z-index: 100;
  margin: 0;
  padding: 0;
  width: 100%;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

nav ul {
  width: 100%;
  list-style: none;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

nav li {
  height: 50px;
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

nav a {
  height: 100%;
  padding: 0 30px;
  text-decoration: none;
  display: flex;
  align-items: center;
  color: #e3e3e3;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 500;
  font-size: 15px;
  letter-spacing: 0.5px;
}

nav li:first-child a {
  font-size: 18px;
  font-weight: 600;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

nav a:hover {
  background-color: #3a4252;
  color: white;
}

nav a:active {
  background-color: #4a5568;  /* pressed state */
}

nav li:first-child {
  margin-right: auto;
}

.sidebar {
  position: fixed;
  top: 0;
  right: 0;
  height: 100vh;
  width: 250px;
  z-index: 999;
  background-color: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  box-shadow: -10px 0 10px rgba(0, 0, 0, 0.1);
  display: none;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.sidebar li {
  width: 100%;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.sidebar a {
  width: 100%;
  font-size: 16px;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.sidebar a:hover {
  background-color: #3a4252;
}

.menu-btn {
  display: none;
}

.menu-btn:hover {
  background-color: #3a4252;
}

@media (max-width: 800px) {
  .hideMobile {
    display: none;
  }
  .menu-btn {
    display: block;
  }
}

@media (max-width: 400px) {
  .sidebar {
    width: 100%;
  }
}

.search-area{
  background-color: aqua;
  align-items: center;
  justify-content: center;
  display: flex;
  border-radius: 50px;
}

.header-section{
  align-items: center;
  justify-content: center;
  display: flex;
  flex-direction: column;
  border-radius: 50px;
  gap: 50px;
}

.modal{
  display: flex;
  margin-top: 50px;
  background-color: #2d333f;
  padding: 30px;
  border-radius: 50px;
  margin: 10px;
}

.image{
  display: flex;
  flex-direction: column;
  width: 40%;
  background-color: aqua;
  border-radius: 50px;
  padding: 10px;
  align-items: center;
  justify-content: center;
}

.text{
  display: flex;
  flex-direction: column;
  width: 60%;
  background-color: blueviolet;
  border-radius: 50px;
  padding: 10px;
  align-items: center;
}

.login{
  display: flex;
  flex-direction: column;
  background-color: cadetblue;
  padding: 10px;
  border-radius: 20px;
  align-items: center;
  justify-content: center;
}

.login button{
  width: 40%;
}
</style>
