<template>

  <!-- Fallback -->

  <Head>
    <meta
      type="description"
      content="Information about my app"
      head-key="description"
    />
  </Head>

  <section class="p-6 bg-gray-200">
    <header class="flex justify-between">
      <div class="flex items-center">
        <h1 class="font-bold text-lg">My app</h1>
        <p class="text-sm ml-4">Welcome back, {{ username }}</p>
      </div>
      <NavComponent />
    </header>
  </section>

  <section class="p-6">
    <div class="max-w-3xl mx-auto">

      <!-- <iframe
        class="mb-6"
        width="100%"
        scrolling="no"
        frameborder="no"
        allow="autoplay"
        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1082675068&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"
      ></iframe> -->

      <slot />
    </div>
  </section>

</template>

<script>
import { defineComponent } from "vue";
import NavComponent from "../NavComponent/NavComponent.vue";

export default defineComponent({
  name: "LayoutComponent",
  components: { NavComponent },
  computed: {
    username() {
      return this.$page.props.auth.user.username;
    },
  },
});
</script>