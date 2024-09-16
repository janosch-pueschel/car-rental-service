<script setup lang="ts">
import BookingForm from "../../Shared/Form/BookingForm.vue";
import Heading from "../../Shared/Heading.vue";

defineProps<{ booking: BookingForm }>();

interface BookingForm {
    id: string;
    departure: string;
    return: string;
    category: string;
    fuelType: string;
    transmission: string;
    firstName: string;
    lastName: string;
    gender: string;
    birthdate: string;
    email: string;
}
</script>

<template>
    <Heading title="Edit Booking" />
    <BookingForm :booking="booking" />
</template>
