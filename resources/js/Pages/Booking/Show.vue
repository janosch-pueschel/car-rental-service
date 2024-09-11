<script setup lang="ts">
import Button from "../../Shared/Button.vue";
import Heading from "../../Shared/Heading.vue";

defineProps({
    booking: Object,
    driver: Object,
    vehicleCategory: Object,
    fuelType: Object,
    transmission: Object,
});
</script>

<template>
    <Heading title="Booking Details"></Heading>

    <div class="border py-5 rounded-lg">
        <p>Name: {{ driver?.first_name }} {{ driver?.last_name }}</p>
        <p>Departure: {{ booking?.departure }}</p>
        <p>Return: {{ booking?.return }}</p>
        <p>
            Vehicle Details: {{ vehicleCategory?.name }}, {{ fuelType?.name }},
            {{ transmission?.name }}
        </p>
        <p>Price per Day: {{ booking?.price_per_day }}</p>
    </div>
</template>
