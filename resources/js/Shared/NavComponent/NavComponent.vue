
<template>
  <nav>
    <ul class="flex space-x-6">
      <li>
        <NavlinkComponent
          href="/"
          :active="$page.component === 'HomePage'"
        >Home</NavlinkComponent>
      </li>
      <li>
        <NavlinkComponent
          href="/users"
          :active="$page.component === 'UsersPage'"
        >Users</NavlinkComponent>
      </li>
      <li>
        <NavlinkComponent
          href="/settings"
          :active="$page.component === 'SettingsPage'"
        >Settings</NavlinkComponent>
      </li>
      <li>
        <NavlinkComponent
          href="/logout"
          method="post"
          as="button"
        >
          Log out
        </NavlinkComponent>
      </li>
    </ul>
  </nav>
</template>

<script>
import { defineComponent } from 'vue';
import NavlinkComponent from '../NavlinkComponent/NavlinkComponent.vue';

export default defineComponent({
  name: "NavComponent",
  components: { NavlinkComponent },
});
</script>