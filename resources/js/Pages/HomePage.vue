<template>

  <Head title="HomePage.vue">
    <meta
      type="description"
      content="Home information"
      head-key="description"
    />
  </Head>

  <h1 class="text-3xl">Home</h1>
  <h2>Hello {{ name }}</h2>
  <p>In this series, we will use the following frameworks:</p>
  <ul>
    <li
      v-for="(framework, index ) of frameworks"
      :key="index"
    >
      {{ framework }}
    </li>
  </ul>
</template>

<script>
import { defineComponent } from "vue";
import LayoutComponent from "../Shared/LayoutComponent/LayoutComponent.vue";

export default defineComponent({
  name: "HomePage",
  props: {
    name: String,
    frameworks: Array,
  },
  layout: LayoutComponent,
});
</script>