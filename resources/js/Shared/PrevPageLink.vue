<script setup lang="ts">
const goBack = () => {
    window.history.back();
};
</script>

<template>
    <Link @click="goBack" as="button">
        <icon class="pi pi-angle-left"></icon>
    </Link>
</template>
