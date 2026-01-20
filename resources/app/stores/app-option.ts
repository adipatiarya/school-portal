import { defineStore } from "pinia";

export const useAppOptionStore = defineStore("appOption", {
  state: () => {
    return {
      appThemeClass: "",
      appDarkMode: "",

      appHeaderHide: false,
      appHeaderFixed: true,
      appHeaderInverse: false,
      appHeaderSearchToggled: false,
      appHeaderLanguageBar: false,
      appHeaderMegaMenu: false,
      appSidebarTwo: false,
      appSidebarHide: false,
      appSidebarEnd: false,
      appSidebarWide: false,
      appSidebarLight: false,
      appSidebarFixed: true,
      appSidebarCollapsed: false,
      appSidebarMobileToggled: false,
      appSidebarMobileClosed: false,
      appSidebarMinified: false,
      appSidebarHover: false,
      appSidebarSearch: false,
      appSidebarEndToggled: false,
      appSidebarEndMobileToggled: false,
      appSidebarTransparent: false,
      appSidebarGrid: false,
      appTopMenu: false,
      appSidebarToggled: false,
      appContentFullHeight: false,
      appContentClass: "",
      appBoxedLayout: false,
      appFooter: false,
      appFooterFixed: false,
      appGradientEnabled: false,
      appThemePanelToggled: false,
      appMegaMenu: false,
    };
  },
});
