<template>
  <Head :title="getPageTitle" />
  <SingleUserEditView :user="user" @on-cancel-submit="onCancelSubmit" @on-submit-form="onSubmitForm" />
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { SingleUserEditView } from "duquejo-dashboard-lib";
import AuthLayout from '../../Layout/AuthLayout.vue';

defineOptions({
  layout: AuthLayout,
});

const props = defineProps({
  errors: Object,
  user: {
    type: Object,
    default: () => ({}),
  },
  action: String,
});

const originalUser = { ...props.user };

const form = useForm(originalUser);

const user = ref({
  ...originalUser,
  birthday: originalUser.birthday && convertToDateString(originalUser.birthday), // @TODO
  avatar: {
    url: "https://picsum.photos/400/600",
    alt: originalUser.name || '',
  },
});

console.log(user.value);

const onCancelSubmit = (args) => {
  router.get('/users');
};

const onSubmitForm = (data) => {
  form.defaults(data).reset();

  if (props.action === 'edit') {
    form.put('/users');
  } else if (props.action === 'create') {
    form.post('/users');
  }
};

// @TODO
function convertToDateString(string) {
  return new Date(string).toISOString().slice(0, 10);
}

const getPageTitle = computed(() => {
  return props.action === 'edit' ? `Editing ${props.user.name}` : 'New User';
})
</script>