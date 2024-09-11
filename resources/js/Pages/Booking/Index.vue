<script setup>
import Button from "../../Shared/Button.vue";
import Heading from "../../Shared/Heading.vue";

defineProps({ bookings: Object });

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
    <div>
        <div class="flex items-center space-x-5">
            <Heading title="Bookings" />
            <Button
                title="Add"
                icon="pi-plus"
                type="link"
                href="booking/create"
            />
        </div>

        <div class="border py-5 rounded-lg grid grid-cols-6-fit gap-6 w-fit">
            <div
                class="inline-grid grid-cols-subgrid gap-16 px-5 text-light-grey border-b pb-2 mb-2 col-span-full"
            >
                <p>Renter</p>
                <p>Departure</p>
                <p>Return</p>
                <p>Category</p>
                <p>Details</p>
            </div>
            <div
                v-for="booking in bookings"
                :key="booking.id"
                class="inline-grid grid-cols-subgrid gap-16 items-center col-span-full px-5"
            >
                <p>
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
                    type="link"
                    title="View Booking"
                    icon="pi-arrow-circle-right"
                    href="/"
                />
            </div>
        </div>
    </div>
</template>
