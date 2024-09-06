<script setup>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>

<template>
    <Navbar />
    <div class="flex bg-white">
        <Sidebar />
        <div class="w-full m-5">
            <slot></slot>
        </div>
    </div>
</template>
