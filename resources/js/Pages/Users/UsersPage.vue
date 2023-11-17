<template>
    <Head title="Users" />
    <UsersView
        :users="users.data"
        :search="searchRef"
        :paginationLinks="paginationLinksParsing"
        @onFormCreate="onFormCreate"
        @onFormDelete="onFormDelete"
        @onFormEdit="onFormEdit"
        @onFormSearch="onFormSearch"
        @onProfileClick="onProfileClick"
    />
</template>

<script setup>
import { ref, computed } from 'vue';
import { UsersView } from "duquejo-dashboard-lib";
import { router } from "@inertiajs/vue3";
import AuthLayout from "../../Layout/AuthLayout.vue";

defineOptions({
    layout: AuthLayout,
});

const props = defineProps({
    users: Object,
    filters: Object,
});

const searchRef = ref(props.filters.search);
const pagination = ref(props.users.links);

const onFormCreate = () => router.get("/user/create");

const onFormDelete = (users) => {
    if( users.length > 0 ) {
        router.delete(`/users`, {
            data: users.map(user => user.id ),
            replace: true,
            
        });
    }
};

const onFormEdit = (user) => {
     router.get(`/user/${user.id}/edit`);
}

const onProfileClick = (id) => {
    if( id ) {
        router.get(`/user/${id}/profile`);
    }
}

const onFormSearch = (search) => {
    router.get('/', { search }, { replace: true });
};

const paginationLinksParsing = computed(() => pagination.value.map( page => {
    if( '&laquo; Previous' === page.label ) {
        return {
            ...page,
            label: '<<',
        };
    } else if( 'Next &raquo;' === page.label ) {
        return {
            ...page,
            label: '>>',
        };
    };
    return page;
}));
</script>