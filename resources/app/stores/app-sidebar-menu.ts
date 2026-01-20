import { defineStore } from "pinia";

export const useAppSidebarMenuStore = defineStore("appSidebarMenu", {
  state: () => ({ menus: [] as any }),

  actions: {
    setSidebarMenu(perimissions: Array<string>) {
      const perms = [
        { text: "Navigation", is_header: true },

        {
          url: "/dashboard",
          img: "",
          title: "Dashboard",
          show: true,
        },
        {
          url: "/posts",
          img: "",
          title: "Post list",
          show: true,
        },
        {
          url: "/pages",
          img: "",
          title: "Pages",
          show: true,
        },
        {
          url: "/user",
          img: "",
          title: "User Management",
          show: true,
        },
        {
          url: "/role",
          img: "",
          title: "Role Management",
          show: true,
        },
        {
          img: "",
          title: "Settings",

          children: [
            {
              url: "/setting",
              title: "Scoring Configuration",
              show: true,
            },
          ],
        },
      ];
      this.menus = perms;
    },
  },
});
