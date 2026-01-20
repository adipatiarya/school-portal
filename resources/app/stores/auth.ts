// src/stores/auth.ts
import { defineStore } from "pinia";
import api from "../plugins/axios";
import { useAppSidebarMenuStore } from "./app-sidebar-menu";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null as null | { id: number; name: string; email: string },
  }),
  actions: {
    async fetchUser() {
      try {
        const { data } = await api.get("/api/user");
        const { setSidebarMenu } = useAppSidebarMenuStore();
        this.user = data;
        setSidebarMenu([]); // set menu disini;
      } catch {
        this.user = null;
      }
    },
    async login(email: string, password: string) {
      await api.post("/login", { email, password });
      await this.fetchUser();
    },
    async register(name: string, email: string, password: string) {
      await api.post("/register", {
        name,
        email,
        password,
        password_confirmation: password,
      });
      await this.fetchUser();
    },
    async logout() {
      await api.post("/logout");
      this.user = null;
    },
  },
});
