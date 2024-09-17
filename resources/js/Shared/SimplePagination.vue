<script setup lang="ts">
defineProps<{
    prevPageUrl: string | null;
    nextPageUrl: string | null;
    currentPage: number;
}>();
</script>

<template>
    <div class="flex justify-center items-center text-light-grey relative">
        <Link v-if="prevPageUrl" :href="prevPageUrl" class="absolute right-8"
            ><i class="pi pi-angle-left"></i
        ></Link>
        <div
            class="bg-light-grey text-white rounded-full min-w-fit w-7 aspect-square flex justify-center items-center relative"
        >
            {{ currentPage }}
        </div>

        <Link v-if="nextPageUrl" :href="nextPageUrl" class="absolute left-8"
            ><i class="pi pi-angle-right"></i
        ></Link>
    </div>
</template>
