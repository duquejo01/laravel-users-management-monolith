<template>

  <Head title="Login Page" />

  <main class="grid place-items-center min-h-screen">
    <section class="bg-white pt-12 pb-6 px-20 rounded-xl mx-auto max-w-md border">
      <h1 class="text-3xl mb-6">Login</h1>
      <form
        @submit.prevent="onSubmit"
        class="mx-auto max-w-md"
      >
        <div class="mb-6">
          <label
            for="email"
            class="block mb-2 uppercase font-bold text-xs text-gray-700"
          >
            Email
          </label>
          <input
            v-model="loginForm.email"
            type="email"
            class="rounded border p-2 w-full"
            name="email"
            id="email"
          />
          <div
            v-if="loginForm.errors.email"
            v-text="loginForm.errors.email"
            class="text-red-500 text-xs mt-1"
          />
        </div>
        <div class="mb-6">
          <label
            for="password"
            class="block mb-2 uppercase font-bold text-xs text-gray-700"
          >
            Password
          </label>
          <input
            v-model="loginForm.password"
            type="password"
            class="rounded border p-2 w-full"
            name="password"
            id="password"
          />
          <div
            v-if="loginForm.errors.password"
            v-text="loginForm.errors.password"
            class="text-red-500 text-xs mt-1"
          />
        </div>

        <div class="mb-6">
          <!-- VueJS + Inertia way: <button
            type="submit"
            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            :disabled="isFormProcessing"
          > -->
          <button
            type="submit"
            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            :disabled="loginForm.proccessing"
          >
            Log In
          </button>
        </div>
      </form>
    </section>
  </main>

</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { defineComponent } from "vue";

export default defineComponent({
  name: "LoginPage",
  setup() {
    const loginForm = useForm({
      email: "",
      password: "",
    });

    return {
      loginForm,

      onSubmit: () => {
        loginForm.post('/login');
      }
    };
  },
});
</script>