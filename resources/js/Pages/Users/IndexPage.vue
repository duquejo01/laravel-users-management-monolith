<template>

  <Head title="UsersPage.vue" />

  <div class="flex justify-between mb-6">

    <div class="flex items-center">
      <h1 class="text-3xl">Users</h1>
      <Link  
        v-if="can.createUser"
        href="/users/create"
        class="text-blue-500 text-sm ml-3"
      >New user</Link>
    </div>

    <input
      type="text"
      placeholder="Search..."
      class="border px-2 rounded"
      v-model="search"
    />
  </div>

  <div class="flex flex-col my-2">
    <div class="overflow-x-auto">
      <div class="inline-block min-w-full">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <tr
              v-for="user in users.data"
              :key="user.id"
              class="border-b"
            >
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ user.name }}
              </td>
              <td v-if="user.can.edit" class="text-sm px-6 py-4 whitespace-nowrap font-medium">
                <Link
                  :href="`/users/${user.id}/edit`"
                  class="text-indigo-600 hover:text-indigo-900"
                >Edit</Link>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Paginator -->
  <PaginationComponent :links="users.links" />

  <div class="mt-2">
    <p>The current time is {{ time }}</p>
    <Link
      href="/users"
      class="text-blue-500"
      preserve-scroll
    >Refresh</Link>

  </div>
</template>

<script>
import { defineComponent, ref, watch } from "vue";
import LayoutComponent from "../../Shared/LayoutComponent/LayoutComponent.vue";
import PaginationComponent from "../../Shared/PaginationComponent/PaginationComponent.vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

export default defineComponent({
  name: "UsersPage",
  layout: LayoutComponent,
  props: {
    time: String,
    users: Object,
    filters: Object,
    can: Object,
  },
  components: { PaginationComponent },
  setup({ filters }) {
    const search = ref(filters.search);

    watch(
      search,
      debounce((value) => {
        console.log("triggered");
        router.get(
          "/users",
          { search: value },
          {
            preserveState: true,
            replace: true,
          }
        );
      }, 500)
    );

    return {
      search,
    };
  },
});
</script>