<script setup lang="ts">
import BookingsTable from "../Shared/Booking/BookingsTable.vue";

interface Booking {
    id: number;
    driver: {
        first_name: string;
        last_name: string;
    };
    vehicle_category: {
        name: string;
    };
    fuel_type: {
        name: string;
    };
    transmission: {
        name: string;
    };
    departure: string;
    return: string;
}

interface Bookings {
    data: Booking[];
    prev_page_url: string | null;
    next_page_url: string | null;
    current_page: number;
}

defineProps<{
    bookings: Bookings;
}>();
</script>

<template>
    <Heading title="Today's Reservations" />
    <BookingsTable :bookings="bookings" />
    <FlashMessage
        v-if="$page.props.flash.message"
        :message-type="$page.props.flash.message_type"
    >
        {{ $page.props.flash.message }}
    </FlashMessage>
</template>
