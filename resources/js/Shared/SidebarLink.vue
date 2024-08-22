<script setup lang="ts">
defineProps({ active: Boolean });
</script>

<template>
    <Link
        class="px-3 py-2 hover:font-semibold"
        :class="{ 'bg-gold rounded-md': active }"
        ><slot></slot
    ></Link>
</template>
