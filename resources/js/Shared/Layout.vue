<script setup>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>

<template>
    <div class="flex-col bg-white">
        <Navbar />
        <div class="flex">
            <Sidebar />
            <div class="w-full relative left-64 m-5">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
