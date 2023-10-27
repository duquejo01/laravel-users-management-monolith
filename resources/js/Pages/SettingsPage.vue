<template>

  <Head title="SettingsPage.vue" />
  <h1 class="text-3xl">Settings</h1>
</template>

<script>
import { defineComponent } from "vue";
import LayoutComponent from "../Shared/LayoutComponent/LayoutComponent.vue";

export default defineComponent({
  name: "SettingsPage",
  layout: LayoutComponent,
});
</script>