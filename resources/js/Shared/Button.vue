<script setup lang="ts">
defineProps<{ title: string; type?: string; icon?: string }>();
</script>

<template>
    <component
        :is="type ? 'Link' : 'button'"
        class="border border-green py-2 px-3 rounded w-fit h-fit text-green font-medium hover:bg-green hover:text-white transition-colors"
    >
        <i v-if="icon" class="pi mr-2 text-sm" :class="icon"></i>{{ title }}
    </component>
</template>
