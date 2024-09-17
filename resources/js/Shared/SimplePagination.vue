<script setup lang="ts">
defineProps<{
    prevPageUrl: string | null;
    nextPageUrl: string | null;
    currentPage: number;
}>();
</script>

<template>
    <div class="flex space-x-3 items-center text-light-grey">
        <Link v-show="prevPageUrl" :href="prevPageUrl"
            ><i class="pi pi-angle-left"></i
        ></Link>
        <div
            class="bg-light-grey text-white rounded-full min-w-fit w-7 aspect-square flex justify-center items-center"
        >
            {{ currentPage }}
        </div>

        <Link v-if="nextPageUrl" :href="nextPageUrl"
            ><i class="pi pi-angle-right"></i
        ></Link>
    </div>
</template>
