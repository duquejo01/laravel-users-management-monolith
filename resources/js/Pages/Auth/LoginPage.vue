<template>
    <LoginLayout>
      <div class="flex-inline" v-if="errors">
        <span v-if="errors.email" v-text="errors.email" />
      </div>
      <LoginForm  :initialValues="form" @on-form-submit="onFormSubmit"/>
    </LoginLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { LoginLayout, LoginForm } from 'duquejo-dashboard-lib';

const props = defineProps({
  errors: Object,
});

const initialValues = {
  fullName: '',
  email: '',
  password: '',
  remember: false,
};

const form = useForm(initialValues);

const onFormSubmit = (data) => {
  console.log(data);
  form.defaults(data).reset();
  form.post('/login');
}
</script>