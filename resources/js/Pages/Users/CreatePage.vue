<template>

  <Head title="Create User" />
  <h1 class="text-3xl">Create new user</h1>

  <form
    @submit.prevent="onSubmit"
    class="mx-auto max-w-md mt-8"
  >
    <div class="mb-6">
      <label
        for="name"
        class="block mb-2 uppercase font-bold text-xs text-gray-700"
      >
        Name
      </label>
      <input
        v-model="form.name"
        type="text"
        class="border border-gray-400 p-2 w-full"
        name="name"
        id="name"
      />
      <!-- <div
        v-if="errors.name"
        v-text="errors.name"
        class="text-red-500 text-xs mt-1"
      /> -->
      <div
        v-if="form.errors.name"
        v-text="form.errors.name"
        class="text-red-500 text-xs mt-1"
      />
    </div>
    <div class="mb-6">
      <label
        for="email"
        class="block mb-2 uppercase font-bold text-xs text-gray-700"
      >
        Email
      </label>
      <input
        v-model="form.email"
        type="email"
        class="border border-gray-400 p-2 w-full"
        name="email"
        id="email"
      />
      <div
        v-if="form.errors.email"
        v-text="form.errors.email"
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
        v-model="form.password"
        type="password"
        class="border border-gray-400 p-2 w-full"
        name="password"
        id="password"
      />
      <div
        v-if="form.errors.password"
        v-text="form.errors.password"
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
        :disabled="form.proccessing"
      >
        Submit
      </button>
    </div>
  </form>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import LayoutComponent from "../../Shared/LayoutComponent/LayoutComponent.vue";

export default defineComponent({
  name: "CreatePage",
  layout: LayoutComponent,
  // // Conventional VueJS form proccessing + InertiaJS
  // props: {
  //   errors: Object,
  // },
  // // Conventional VueJS form proccessing + InertiaJS
  // setup(props) {
  setup() {
    // // Conventional VueJS form proccessing + InertiaJS
    // const isFormProcessing = ref(false);

    const form = useForm({
      name: "",
      email: "",
      password: "",
    });

    // // Conventional VueJS form proccessing + InertiaJS
    // const form = reactive({
    //   name: "",
    //   email: "",
    //   password: "",
    // });

    return {
      // // Conventional VueJS form proccessing + InertiaJS
      // isFormProcessing,
      form,
      // errors: computed(() => props.errors ),

      onSubmit: () => {
        // // Conventional VueJS form proccessing + InertiaJS
        // isFormProcessing.value = true;
        // router.post("/users", form, {
        //   onStart: () => isFormProcessing.value = true,
        //   onFinish: () => isFormProcessing.value = false,
        // });

        form.post("/users");
      },
    };
  },
});
</script>

<style>
</style>