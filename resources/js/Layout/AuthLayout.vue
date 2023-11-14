<template>
    <SidebarLayout v-if="activeComponent"
        :user="user"
        :links="links"
        :top-navigation="enabledBackwardsNav"
        :isSidebarOpen="uiStore.getSidebarStatus"
        @toggle-sidebar="onToggleSidebar"
    >
        <slot></slot>
        <Button @click="toggleDarkMode" primary label="Dark mode" />
    </SidebarLayout>
</template>

<script setup>
import { ref, onMounted, onUpdated, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { SidebarLayout, Button } from "duquejo-dashboard-lib";
import { useUIStore } from "../store/ui";

import links from "../mocks/links.json";

const uiStore = useUIStore();
const page = usePage();

const user = ref({
    name: 'Jose',
    role: 'admin',
    avatarUrl: "https://picsum.photos/100/100",
    profileUrl: "/account",
    logoutUrl: "/logout",
});

const activeComponent = ref(null);

onMounted(() => {
    /**
     * First Inertia Page render
     */
    if( ! activeComponent.value ) {
        activeComponent.value = page.component;
    }
});

onUpdated(() => {
    /**
     * For every Inertia router changes.
     */
    if( page.component !== activeComponent.value ) {
        activeComponent.value = page.component;
    }
});

const toggleDarkMode = () => uiStore.toggleDarkMode();

const enabledBackwardsNav = computed(() => ({
    active: activeComponent.value !== 'Users/UsersPage',
    backUrl: '/users',
}));

const onToggleSidebar = () => uiStore.toggleSidebar();
</script>
