<script setup lang="ts">
defineProps<{ active: boolean; icon?: string }>();
</script>

<template>
    <Link
        class="px-5 py-2 flex items-center"
        :class="{
            'bg-green rounded-full hover:font-normal': active,
            'hover:font-semibold': !active,
        }"
        ><i v-if="icon" class="pi mr-2 text-sm" :class="icon"></i><slot></slot
    ></Link>
</template>
