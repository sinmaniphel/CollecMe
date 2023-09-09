<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import TopNav from './components/TopNav.vue'
import Sidebar from './components/Sidebar.vue'

let firstname: String = 'Roger'
</script>

<template>
  <main>
    <div id="wrapper" class="d-inline-block h-100">
      <Sidebar></Sidebar>

      <!--header>
    
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <HelloWorld msg="You did it!" />

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header-->
      <RouterView />
    </div>
  </main>
</template>

<style ></style>
