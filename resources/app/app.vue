<script setup lang="ts">

import { getCurrentInstance, onMounted } from 'vue';
const instance = getCurrentInstance();
    onMounted(() => {
        if(instance) {
            console.log(window.config.base_url)
        }
    })
  
</script>

<template>
    <div class="app app-header-fixed app-sidebar-fixed">
        <div id="header" class="app-header">
            <div class="navbar-header">navbar-header</div>
            <div class="navbar-nav">navbar-nav</div>
        </div>
        <div id="sidebar" class="app-sidebar" data-bs-theme="dark">sidebar</div>
        <div class="app-sidebar-bg" data-bs-theme="dark">sidebar bg</div>
        <div class="app-sidebar-mobile-backdrop"></div>
        <div class="app-content">
           <router-view></router-view>
        </div>

    </div>
</template>