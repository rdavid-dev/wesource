<template>
    <main>
      <Header/>
        <router-view></router-view>
      <Footer/>
    </main>
</template>

<script>
  import Header from "./Components/Header.vue";
  import Footer from "./Components/Footer.vue";

  export default {
    components: {
      Header,
      Footer,
    }
  };
</script>