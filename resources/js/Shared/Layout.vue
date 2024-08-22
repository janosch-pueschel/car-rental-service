<script setup>
import Sidebar from "./Sidebar.vue";
</script>

<template>
    <div class="flex space-x-5">
        <Sidebar />
        <div>
            <slot></slot>
        </div>
    </div>
</template>
