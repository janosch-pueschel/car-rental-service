<script setup lang="ts">
defineProps<{
    title: string;
    link?: boolean;
    linkType?: string;
    icon?: string;
    disabled?: boolean;
    styleType?: string;
}>();
</script>

<template>
    <component
        :is="link ? linkType : 'button'"
        class="py-2 px-3 rounded w-fit h-fit font-medium transition-colors border"
        :class="{
            'border-ec-green text-ec-green hover:bg-ec-green hover:text-white':
                styleType === 'success',
            'border-dark-grey text-dark-grey': disabled,
            'border-red-500 text-red-500 hover:bg-red-500 hover:text-white':
                styleType === 'danger',
        }"
    >
        <i v-if="icon" class="pi mr-2 text-sm" :class="icon"></i>{{ title }}
    </component>
</template>
