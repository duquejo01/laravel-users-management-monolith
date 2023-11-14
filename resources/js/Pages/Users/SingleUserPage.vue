<template>
  <Head :title="props.user.name" />
  <SingleUserView :user="user" />
</template>

<script setup>
import { ref } from 'vue';
import { SingleUserView } from "duquejo-dashboard-lib";
import AuthLayout from '../../Layout/AuthLayout.vue';

defineOptions({
  layout: AuthLayout,
});

const props = defineProps({
  user: Object,
});

const user = ref({
  ...props.user,
  avatar: {
    url: "https://picsum.photos/400/600",
    alt: props.user.name,
  },
});
</script>