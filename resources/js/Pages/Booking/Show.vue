<script setup lang="ts">
import Button from "../../Shared/Button.vue";
import Card from "../../Shared/Card.vue";
import PrevPageLink from "../../Shared/PrevPageLink.vue";

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

const formatDateTime = (date) => {
    date = new Date(date);

    return date.toLocaleString("de-DE", {
        dateStyle: "short",
        timeStyle: "short",
    });
};

const transmissionShort = (string) => {
    return string.substring(0, 1);
};
</script>

<template>
    <Heading title="Booking Details"></Heading>

    <Card class="w-fit">
        <div class="grid grid-cols-2 gap-y-4 gap-x-12">
            <div class="col-span-2 grid grid-cols-subgrid border-b py-2">
                <div>
                    <p class="text-light-grey">Departure</p>
                    <p class="text-lg">
                        {{ formatDateTime(booking?.departure) }}
                    </p>
                </div>
                <div>
                    <p class="text-light-grey">Return</p>
                    <p class="text-lg">{{ formatDateTime(booking?.return) }}</p>
                </div>
            </div>

            <div class="col-span-2 grid grid-cols-subgrid border-b py-2">
                <div>
                    <p class="text-light-grey">Vehicle Category</p>
                    <p class="text-lg">
                        {{ vehicleCategory?.name }}
                    </p>
                </div>
                <div>
                    <p class="text-light-grey">Features</p>
                    <p class="text-lg">
                        {{ fuelType?.name }}
                        <span v-if="fuelType?.name !== 'Electricity'">
                            ({{ transmissionShort(transmission?.name) }})
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-span-2 grid grid-cols-subgrid py-2 border-b">
                <div>
                    <p class="text-light-grey">Renter</p>
                    <p class="text-lg">
                        {{ driver?.first_name }} {{ driver?.last_name }}
                    </p>
                </div>
                <div>
                    <p class="text-light-grey">Total Price</p>
                    <p class="text-lg">{{ booking?.price_total }} Euro</p>
                </div>
            </div>
            <div class="col-span-2 flex justify-between mt-5">
                <PrevPageLink />
                <div class="space-x-5">
                    <Button
                        @click="deleteBooking(booking?.id)"
                        title="Delete"
                        style-type="danger"
                        icon="pi-trash"
                    />
                    <Button
                        title="Edit"
                        :link="true"
                        linkType="Link"
                        :href="`/bookings/${booking?.id}/edit`"
                        icon="pi-pencil"
                    />
                </div>
            </div>
        </div>
    </Card>

    <FlashMessage
        v-if="$page.props.flash.message"
        :message-type="$page.props.flash.message_type"
    >
        {{ $page.props.flash.message }}
    </FlashMessage>
</template>
