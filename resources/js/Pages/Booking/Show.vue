<script setup lang="ts">
import Button from "../../Shared/Button.vue";
import Card from "../../Shared/Card.vue";

import { router } from "@inertiajs/vue3";

defineProps({
    booking: Object,
    driver: Object,
    vehicleCategory: Object,
    fuelType: Object,
    transmission: Object,
});

const deleteBooking = (bookingId) => {
    router.delete(`/bookings/${bookingId}`, bookingId);
};
</script>

<template>
    <Heading title="Booking Details"></Heading>

    <Card>
        <p>Name: {{ driver?.first_name }} {{ driver?.last_name }}</p>
        <p>Departure: {{ booking?.departure }}</p>
        <p>Return: {{ booking?.return }}</p>
        <p>
            Vehicle Details: {{ vehicleCategory?.name }}, {{ fuelType?.name }},
            {{ transmission?.name }}
        </p>
        <p>Price per Day: {{ booking?.price_per_day }}</p>
    </Card>

    <Button
        @click="deleteBooking(booking?.id)"
        title="Delete"
        style-type="danger"
    />
    <Button
        title="Edit"
        :link="true"
        linkType="Link"
        style-type="success"
        :href="`/bookings/${booking?.id}/edit`"
    />
    <FlashMessage
        v-if="$page.props.flash.message"
        :message-type="$page.props.flash.message_type"
    >
        {{ $page.props.flash.message }}
    </FlashMessage>
</template>
