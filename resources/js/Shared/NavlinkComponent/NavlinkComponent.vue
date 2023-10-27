<template>
  <Link
    class="text-black hover:underline"
    :class="{ 'font-bold underline': active }"
  >
  <slot />
  </Link>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "NavlinkComponent",
  props: {
    active: Boolean,
  },
});
</script>