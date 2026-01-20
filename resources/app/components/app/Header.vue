<script setup lang="ts">
import { onMounted } from "vue";
import { useAppOptionStore } from "@/stores/app-option";
import { RouterLink } from "vue-router";
import { slideToggle } from "@/composables/slideToggle.js";
import AppHeaderMegaMenu from "@/components/app/HeaderMegaMenu.vue";
import { useAuthStore } from "@/stores/auth";
const auth = useAuthStore();
const appOption = useAppOptionStore();
const notificationData = [];

function toggleAppSidebarMobileToggled() {
  appOption.appSidebarMobileToggled = !appOption.appSidebarMobileToggled;
}

function toggleAppSidebarEndToggled() {
  appOption.appSidebarEndToggled = !appOption.appSidebarEndToggled;
}

function toggleAppSidebarEndMobileToggled() {
  appOption.appSidebarEndMobileToggled = !appOption.appSidebarEndMobileToggled;
}

function toggleAppTopMenuMobileToggled(event) {
  event.preventDefault();
  slideToggle(document.querySelector(".app-top-menu"));
}

function handleWindowResize() {
  window.addEventListener("resize", function () {
    var elm = document.querySelector(".app-top-menu");
    if (elm) {
      elm.removeAttribute("style");
    }
  });
}

function checkForm(event) {
  event.preventDefault();
  //this.$router.push({ path: '/extra/search' })
}

onMounted(() => {
  handleWindowResize();
});
</script>

<template>
  <div
    id="header"
    class="app-header"
    :data-bs-theme="appOption.appHeaderInverse ? 'dark' : ''"
  >
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-mobile-toggler"
        v-if="appOption.appSidebarTwo"
        v-on:click="toggleAppSidebarEndMobileToggled"
      >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <RouterLink to="/" class="navbar-brand">
        <span class="navbar-logo"></span> <b>Color</b> Admin
      </RouterLink>
      <button
        type="button"
        class="navbar-mobile-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#top-navbar"
        v-if="appOption.appMegaMenu && !appOption.appSidebarTwo"
      >
        <span class="fa-stack fa-lg">
          <i class="far fa-square fa-stack-2x"></i>
          <i class="fa fa-cog fa-stack-1x mt-1px"></i>
        </span>
      </button>
      <button
        type="button"
        class="navbar-mobile-toggler"
        v-if="
          appOption.appTopMenu &&
          !appOption.appSidebarHide &&
          !appOption.appSidebarTwo
        "
        v-on:click="toggleAppTopMenuMobileToggled"
      >
        <span class="fa-stack fa-lg">
          <i class="far fa-square fa-stack-2x"></i>
          <i class="fa fa-cog fa-stack-1x mt-1px"></i>
        </span>
      </button>
      <button
        type="button"
        class="navbar-mobile-toggler"
        v-if="
          appOption.appTopMenu &&
          appOption.appSidebarHide &&
          !appOption.appSidebarTwo
        "
        v-on:click="toggleAppTopMenuMobileToggled($event)"
      >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <button
        type="button"
        class="navbar-mobile-toggler"
        v-if="!appOption.appSidebarHide"
        v-on:click="toggleAppSidebarMobileToggled()"
      >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- END navbar-header -->

    <app-header-mega-menu v-if="appOption.appHeaderMegaMenu" />

    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
      <div class="navbar-item dropdown">
        <a
          href="#"
          class="navbar-link dropdown-toggle"
          data-bs-toggle="dropdown"
        >
          <span class="fi fi-us" title="us"></span>
          <span class="d-none d-sm-inline ms-1">EN</span> <b class="caret"></b>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a href="javascript:;" class="dropdown-item"
            ><span class="fi fi-us me-2" title="us"></span> English</a
          >
          <a href="javascript:;" class="dropdown-item"
            ><span class="fi fi-cn me-2" title="id"></span> Indonesian</a
          >
        </div>
      </div>
      <div class="navbar-item navbar-user dropdown">
        <a
          href="#"
          class="navbar-link dropdown-toggle d-flex align-items-center"
          data-bs-toggle="dropdown"
        >
          <img src="https://placehold.co/600x400/orange/white" alt="" />
          <span>
            <span class="d-none d-md-inline">{{ auth?.user.name }}</span>
            <b class="caret"></b>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end me-1">
          <router-link to="/extra/profile" class="dropdown-item"
            >Edit Profile</router-link
          >
          <router-link
            to="/email/inbox"
            class="dropdown-item d-flex align-items-center"
          >
            Inbox
            <span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
          </router-link>
          <router-link to="/calendar" class="dropdown-item"
            >Calendar</router-link
          >
          <router-link to="/extra/settings-page" class="dropdown-item"
            >Settings</router-link
          >
          <div class="dropdown-divider"></div>
          <a
            href="#"
            class="dropdown-item"
            @click="
              async (e) => {
                e.preventDefault();
                await auth.logout();
              }
            "
            >Log Out</a
          >
        </div>
      </div>
      <div
        class="navbar-divider d-none d-md-block"
        v-if="appOption.appSidebarTwo"
      ></div>
      <div class="navbar-item d-none d-md-block" v-if="appOption.appSidebarTwo">
        <a
          href="javascript:;"
          v-on:click="toggleAppSidebarEndToggled"
          class="navbar-link icon"
        >
          <i class="fa fa-th"></i>
        </a>
      </div>
    </div>
    <!-- END header-nav -->
  </div>
</template>
