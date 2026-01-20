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
          img: "",
          title: "Posts",
          children: [
            {
              url: "/posts",
              title: "List",
              show: true,
            },
            {
              url: "/posts/create",
              title: "Add new",
              show: true,
            },
          ],
        },
        {
          url: "/user",
          img: "",
          title: "Media",
          show: true,
        },
        {
          url: "/pages",
          img: "",
          title: "Pages",
          show: true,
        },
        {
          url: "/pages",
          img: "",
          title: "Comments",
          show: true,
        },
        { text: "", is_divider: true },
        {
          url: "/user",
          img: "",
          title: "Users",
          show: true,
        },
        {
          url: "/role",
          img: "",
          title: "Roles",
          show: true,
        },
        { text: "", is_divider: true },
        {
          img: "",
          title: "Preferences",
          show: true,

          children: [
            {
              url: "/setting",
              title: "About",
              show: true,
            },
            {
              url: "/setting",
              title: "Documentation",
              show: true,
            },
          ],
        },
      ];
      this.menus = perms;
    },
  },
});
