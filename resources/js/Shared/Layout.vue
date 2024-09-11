<script setup>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>

<template>
    <div class="flex-col">
        <Navbar />
        <div class="flex overflow-x-hidden">
            <Sidebar />
            <div class="w-full relative pl-64 m-5">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
