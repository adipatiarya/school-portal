<script setup lang="ts">
import { useAppOptionStore } from "@/stores/app-option";
import AppSidebar from "@/components/app/Sidebar.vue";
import AppHeader from "@/components/app/Header.vue";
import { useAppVariableStore, generateVariables } from "@/stores/app-variable";
import useEmitter from "@/composables/useEmitter";
import { onMounted } from "vue";

const appOption = useAppOptionStore();
const appVariable = useAppVariableStore();
const emitter = useEmitter();
import { Popover } from "bootstrap";

function reloadVariable() {
  var newVariables = generateVariables();
  appVariable.font = newVariables.font;
  appVariable.color = newVariables.color;
}

function setDarkMode(darkMode) {
  if (darkMode == "true") {
    document.querySelector("html").setAttribute("data-bs-theme", "dark");
  } else {
    document.querySelector("html").removeAttribute("data-bs-theme");
  }
  reloadVariable();
  emitter.emit("theme-reload", true);
}

onMounted(() => {
  // Initialize all popovers globally
  const popoverTriggerList = document.querySelectorAll(
    '[data-bs-toggle="popover"]'
  );
  [...popoverTriggerList].forEach((el) => {
    new Popover(el);
  });

  setDarkMode("true");
});
</script>

<template>
  <div
    class="app"
    v-bind:class="{
      'app-header-menu-search-toggled': appOption.appHeaderSearchToggled,
      'app-header-fixed': appOption.appHeaderFixed,
      'app-sidebar-fixed': appOption.appSidebarFixed,
      'app-sidebar-grid': appOption.appSidebarGrid,
      'app-sidebar-toggled': appOption.appSidebarToggled,
      'app-sidebar-collapsed': appOption.appSidebarCollapsed,
      'app-sidebar-mobile-toggled': appOption.appSidebarMobileToggled,
      'app-sidebar-mobile-closed': appOption.appSidebarMobileClosed,
      'app-sidebar-end-toggled': appOption.appSidebarEndToggled,
      'app-sidebar-end-mobile-toggled': appOption.appSidebarEndMobileToggled,
      'app-content-full-height': appOption.appContentFullHeight,
      'app-content-full-width': appOption.appSidebarHide,
      'app-without-sidebar': appOption.appSidebarHide,
      'app-with-end-sidebar': appOption.appSidebarEnd,
      'app-with-wide-sidebar': appOption.appSidebarWide,
      'app-with-hover-sidebar': appOption.appSidebarHover,
      'app-with-top-menu': appOption.appTopMenu,
      'app-with-two-sidebar': appOption.appSidebarTwo,
      'pt-0': appOption.appHeaderHide,
      'app-boxed-layout': appOption.appBoxedLayout,
      'app-footer-fixed': appOption.appFooterFixed,
      'app-sidebar-minified': appOption.appSidebarMinified,
      'app-gradient-enabled': appOption.appGradientEnabled,
    }"
  >
    <app-header v-if="!appOption.appHeaderHide" />
    <app-sidebar v-if="!appOption.appSidebarHide" />
    <div class="app-content" v-bind:class="appOption.appContentClass">
      <slot></slot>
    </div>
    <!-- <app-theme-panel /> -->
    <slot name="app-theme-panel"></slot>
  </div>
</template>
