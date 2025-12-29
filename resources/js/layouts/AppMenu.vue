<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import AppMenuItem from "./AppMenuItem.vue";

const page = usePage();

// Get menu from backend and convert route names to URLs
const model = computed(() => {
    return (page.props.menu || []).map((item) => processMenuItem(item));
});

function processMenuItem(item) {
    const processed = { ...item };

    // Convert 'route' to 'to' with actual URL
    if (item.route) {
        processed.to = item.route
        delete processed.route;
    }

    // Convert 'url' to 'to' for static links
    if (item.url) {
        processed.to = item.url;
        delete processed.url;
    }

    // Process child items recursively
    if (item.items) {
        processed.items = item.items.map((child) => processMenuItem(child));
    }

    return processed;
}
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <AppMenuItem v-if="!item.separator" :item="item" :index="i"></AppMenuItem>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>