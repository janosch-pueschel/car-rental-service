<script setup lang="ts">
import { ref, onMounted } from "vue";

defineProps<{ messageType: string | null }>();

let showMessage = ref(true);

onMounted(() => {
    setTimeout(() => (showMessage.value = false), 4000);
});
</script>

<template>
    <div
        v-if="showMessage"
        class="w-fit bg-opacity-20 z-50 fixed right-10 bottom-10 py-3 px-7 border-l-4 animate-fade-out"
        :class="{
            'bg-ec-green border-l-ec-green text-ec-green':
                messageType === 'success',
        }"
    >
        <slot></slot>
    </div>
</template>
animate-fade-out
