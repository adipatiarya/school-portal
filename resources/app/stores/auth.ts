// src/stores/auth.ts
import { defineStore } from "pinia";
import api from "../plugins/axios";

import { useAppSidebarMenuStore } from "./app-sidebar-menu";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null as null | { id: number; name: string; email: string },
    isLoading: false,
  }),
  actions: {
    async fetchUser() {
      this.isLoading = true;
      try {
        const { data } = await api.get("/api/user");
        this.user = data;
        useAppSidebarMenuStore().setSidebarMenu([]);

        this.isLoading = false;
      } catch {
        this.user = null;
        this.isLoading = false;
      }
    },
    async login(email: string, password: string) {
      await api.post("/login", { email, password });
      await this.fetchUser();
    },
    async waitUntilReady() {
      while (this.isLoading) {
        await new Promise((resolve) => setTimeout(resolve, 50));
      }
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
