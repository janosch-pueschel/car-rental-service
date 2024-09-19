<script setup lang="ts">
defineProps<{ active: boolean; icon?: string }>();
</script>

<template>
    <Link
        class="px-5 py-2 flex items-center"
        :class="{
            'bg-white/25 border-l-4 px-4 hover:font-normal': active,
            'hover:bg-white/10': !active,
        }"
        ><i v-if="icon" class="pi mr-2 text-sm" :class="icon"></i><slot></slot
    ></Link>
</template>
