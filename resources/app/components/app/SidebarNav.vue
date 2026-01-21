<script setup lang="ts">
import SidebarNav from "@/components/app/SidebarNav.vue";
import { computed } from "vue";
import { useRouter, RouterLink } from "vue-router";
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const props = defineProps<{
  menu: {
    icon: string;
    text: string;
    url: string;
    highlight: boolean;
    children: Array<any>;
    img: string;
    title: string;
    label: string;
    show: boolean;
  };
}>();

const reversedMenu = computed(() => {
  return props.menu.children.filter(({ show }) => show).length;
});

function subIsActive(urls: Array<any>) {
  var currentRoute = useRouter().currentRoute.value.name;
  const split = currentRoute.toString().split("_"); //posts_detail
  if (split.length > 0) {
    currentRoute = split[0];
  }
  return urls.some((i) => i.url === currentRoute);
}
function subIsExpand(urls: Array<any>) {
  var currentRoute = useRouter().currentRoute.value.name;

  return urls.some((i) => i.url === currentRoute);
}
</script>
<template>
  <!-- menu with submenu -->
  <div
    v-if="menu.children"
    class="menu-item has-sub"
    v-bind:class="`${subIsActive(menu.children) && 'active'} ${subIsExpand(menu.children) ? 'expand' : 'closed'}`"
  >
    <a class="menu-link" v-if="reversedMenu">
      <span class="menu-icon" v-if="menu.icon">
        <i v-bind:class="menu.icon"></i>
        <span
          class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"
          v-if="menu.highlight"
        ></span>
      </span>
      <span class="menu-icon-img" v-if="menu.img">
        <img v-bind:src="menu.img" alt="" />
      </span>
      <span class="menu-text">
        {{ t(menu.title) }}
        <span class="menu-label" v-if="menu.label">{{ menu.label }}</span>
      </span>
      <span class="menu-caret" v-if="menu.children"></span>
    </a>
    <div
      class="menu-submenu"
      :style="
        !subIsExpand(menu.children) && 'box-sizing: border-box; display: none;'
      "
    >
      <template v-for="(submenu, index) in menu.children">
        <sidebar-nav v-bind:menu="submenu"></sidebar-nav>
      </template>
    </div>
  </div>

  <!-- menu without submenu -->
  <router-link
    v-else
    v-bind:to="{ name: menu.url }"
    custom
    v-slot="{ navigate, href, isActive }"
  >
    <div
      class="menu-item"
      v-bind:class="{
        active: menu.url === useRouter().currentRoute.value.name,
      }"
      v-if="menu.show"
    >
      <a v-bind:href="href" @click="navigate" class="menu-link">
        <span class="menu-icon" v-if="menu.icon">
          <i v-bind:class="menu.icon"></i>
        </span>
        <span class="menu-icon-img" v-if="menu.img">
          <img v-bind:src="menu.img" alt="" />
        </span>
        <span class="menu-text">
          {{ t(menu.title) }}
          <span class="menu-label" v-if="menu.label">{{ menu.label }}</span>
        </span>
      </a>
    </div>
  </router-link>
</template>
