<script setup lang="ts">
import { faLocation } from "@fortawesome/free-solid-svg-icons";
import { ref, watch } from "vue";

interface Node {
  name: string;
  path: string;
  files?: Node[];
  url?: string;
  directories?: Node[];
}

const props = defineProps<{ node: Node }>();

const isExpanded = ref(false);

const emit = defineEmits<{
  (e: "selected", node: Node): void;
}>();
function handleSelect() {
  emit("selected", props.node);
  // isExpanded.value = !isExpanded.value;
}
function reloadPage(url: string) {
  window.open(url, "_blank");
}
watch(isExpanded, (v) => {
  if (v) {
    emit("selected", props.node);
  } else {
    emit("selected", null);
  }
});
</script>

<template>
  <div class="file-tree">
    <div
      class="file-node"
      :class="
        (props.node.files?.length || props.node.directories?.length) &&
        'has-sub'
      "
    >
      <a href="javascript:;" class="file-link" @click.prevent="handleSelect"
        ><span class="file-arrow"></span
        ><span class="file-info"
          ><span class="file-icon"
            ><i class="fa fa-folder fa-lg text-warning"></i></span
          ><span class="file-text">{{ props.node.name }}</span></span
        ></a
      >
      <div class="file-tree">
        <div
          class="file-node"
          v-for="file in props.node.files"
          :key="file.path"
        >
          <a
            :href="file.url"
            class="file-link"
            @click.prevent="reloadPage(file.url)"
            ><span class="file-arrow"></span
            ><span class="file-info"
              ><span class="file-icon"
                ><i
                  class="fa fa-file-text fa-lg text-body text-opacity-50"
                ></i></span
              ><span class="file-text">{{ file.name }}</span></span
            ></a
          >
        </div>
      </div>

      <TreeView
        v-for="dir in props.node.directories"
        :key="dir.path"
        :node="dir"
        @selected="emit('selected', $event)"
      />
    </div>
  </div>
</template>
