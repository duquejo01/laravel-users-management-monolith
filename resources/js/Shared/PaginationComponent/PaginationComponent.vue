<template>
  <div class="mt-6">
    <Component
      :is="link.url ? 'Link' : 'span'"
      v-for="(link, index) in links"
      :href="link.url"
      :key="index"
      class="px-1"
      :class="{ 'text-gray-500': ! link.url, 'font-bold': link.active }"
    >
      <span v-html="link.label" />
    </Component>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "PaginationComponent",
  props: {
    links: Array,
  },
});
</script>