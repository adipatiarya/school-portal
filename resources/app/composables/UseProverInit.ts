// composables/usePopoverInit.ts
import { onMounted, watch, nextTick } from "vue";
import { Popover } from "bootstrap";

export function usePopoverInit(deps: any[] = []) {
  // initialize all popovers
  const initPopovers = () => {
    nextTick(() => {
      const popoverTriggerList = document.querySelectorAll(
        '[data-bs-toggle="popover"]'
      );
      [...popoverTriggerList].forEach((el) => {
        new Popover(el, { html: true });
      });
    });
  };

  // run once when mounted
  onMounted(() => {
    initPopovers();
  });

  // re-run when dependencies change (like items list)
  deps.forEach((dep) => {
    watch(dep, () => {
      initPopovers();
    });
  });
}
