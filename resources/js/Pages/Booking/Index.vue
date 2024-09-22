<script setup lang="ts">
import BookingsTable from "../../Shared/Booking/BookingsTable.vue";
import Button from "../../Shared/Button.vue";
import SearchText from "../../Shared/Search/SearchText.vue";

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
    searchFilter?: string;
}>();
</script>

<template>
    <div class="w-fit">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-5">
                <Heading title="Bookings" />
                <Button
                    title="Add"
                    icon="pi-plus"
                    :link="true"
                    link-type="Link"
                    style-type="success"
                    href="bookings/create"
                />
            </div>
            <div class="w-72">
                <SearchText
                    placeholder="Search Renter"
                    request-url="/bookings"
                    :filter="searchFilter"
                />
            </div>
        </div>

        <BookingsTable :bookings="bookings" />
    </div>
    <FlashMessage
        v-if="$page.props.flash.message"
        :message-type="$page.props.flash.message_type"
    >
        {{ $page.props.flash.message }}
    </FlashMessage>
</template>
