<script setup lang="ts">
import Button from "../Shared/Button.vue";
import Card from "../Shared/Card.vue";
import SimplePagination from "../Shared/Pagination/SimplePagination.vue";

defineProps({
    bookings: {
        type: Object,
        default: () => ({
            data: [],
            prev_page_url: null,
            next_page_url: null,
            current_page: 1,
        }),
    },
});

const transmissionShort = (string) => {
    return string.substring(0, 1);
};

const formatDateTime = (date) => {
    date = new Date(date);

    return date.toLocaleString("de-DE", {
        dateStyle: "short",
        timeStyle: "short",
    });
};

const getCategoryBadge = (category) => {
    switch (category) {
        case "Mini":
            return "bg-sky-200";
        case "Economy":
            return "bg-teal-200";
        case "Compact":
            return "bg-lime-200";
        case "Intermediate":
            return "bg-red-200";
        case "Standard":
            return "bg-indigo-200";
        case "Fullsize":
            return "bg-pink-200";
        case "Premium":
            return "bg-amber-200";
    }
};
</script>

<template>
    <Heading title="Today's Reservations" />

    <Card class="w-fit">
        <div class="grid grid-cols-bookings grid-rows-11 gap-x-14 gap-y-5">
            <div
                class="inline-grid grid-cols-subgrid px-5 text-light-grey border-b pb-3 col-span-full"
            >
                <p>Renter</p>
                <p>Departure</p>
                <p>Return</p>
                <p>Category</p>
                <p>Details</p>
            </div>
            <div
                v-if="bookings.data.length"
                v-for="booking in bookings.data"
                :key="booking.id"
                class="inline-grid grid-cols-subgrid items-center col-span-full px-5"
            >
                <p class="truncate">
                    <span class="font-semibold">{{
                        booking.driver.last_name
                    }}</span
                    >,

                    {{ booking.driver.first_name }}
                </p>
                <p>
                    {{ formatDateTime(booking.departure) }}
                </p>
                <p>
                    {{ formatDateTime(booking.return) }}
                </p>

                <p>
                    <span
                        class="py-1 px-2 rounded"
                        :class="getCategoryBadge(booking.vehicle_category.name)"
                    >
                        {{ booking.vehicle_category.name }}
                    </span>
                </p>

                <p>
                    {{ booking.fuel_type.name }}
                    <span v-if="booking.fuel_type.name !== 'Electricity'"
                        >({{
                            transmissionShort(booking.transmission.name)
                        }})</span
                    >
                </p>

                <Button
                    title="View Booking"
                    icon="pi-arrow-circle-right"
                    :link="true"
                    link-type="Link"
                    :href="`/bookings/${booking.id}`"
                />
            </div>
            <div v-else class="px-5 text-light-grey col-span-full text-center">
                No bookings found.
            </div>
        </div>
        <div class="flex justify-center mt-3">
            <SimplePagination
                :prev-page-url="bookings.prev_page_url"
                :next-page-url="bookings.next_page_url"
                :current-page="bookings.current_page"
            />
        </div>
    </Card>

    <FlashMessage
        v-if="$page.props.flash.message"
        :message-type="$page.props.flash.message_type"
    >
        {{ $page.props.flash.message }}
    </FlashMessage>
</template>
