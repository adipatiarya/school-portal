import { createI18n } from "vue-i18n";
import en from "./lang/en.json";

const i18n = createI18n({
  legacy: false,
  locale: localStorage.getItem("lang") || "ID",
  fallbackLocale: "ID",
  messages: {
    EN: en,
  },
});

export default i18n;
