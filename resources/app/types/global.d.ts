// resources/js/types/global.d.ts
export {};

declare global {
  interface Window {
    config: {
      base_url: string;
      app_url: string;
      app_name: string;
      logo: string;
      // add other keys if needed
    };
  }
}
