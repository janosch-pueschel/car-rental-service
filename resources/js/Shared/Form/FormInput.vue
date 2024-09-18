<script setup lang="ts">
defineProps<{
    label: string;
    id: string;
}>();

const model = defineModel();

const updateModel = (inputValue: string) => {
    model.value = inputValue;
};
</script>

<template>
    <div class="flex flex-col">
        <label :for="id" class="text-light-grey">{{ label }}</label>
        <input
            class="border rounded-full px-5 py-2 text-dark-grey"
            :value="modelValue"
            @input="updateModel($event.target.value)"
            v-bind="$attrs"
        />
    </div>
</template>
