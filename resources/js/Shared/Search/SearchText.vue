<script setup lang="ts">
import { ref, watch } from "vue";

import { router } from "@inertiajs/vue3";

const props = defineProps<{ requestUrl: string; filter?: string }>();

let search = ref(props.filter || "");

watch(search, () => {
    if (search.value) {
        router.get(
            props.requestUrl,
            {
                search: search.value,
            },
            {
                preserveState: true,
            }
        );
    } else {
        router.get(
            props.requestUrl,
            {},
            { preserveState: false, replace: true }
        );
    }
});
</script>

<template>
    <div class="relative h-fit">
        <input
            type="text"
            class="border rounded-full pl-11 pr-5 py-2 text-dark-grey w-full"
            v-bind="$attrs"
            v-model="search"
        />
        <i
            class="pi pi-search text-light-grey absolute top-1/2 transform -translate-y-1/2 left-5"
        ></i>
    </div>
</template>
