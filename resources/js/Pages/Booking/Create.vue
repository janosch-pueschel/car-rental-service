<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

const formOptions = {
    vehicle: {
        vehicleCategory: {
            mini: "Mini",
            economy: "Economy",
            compact: "Compact",
            intermediate: "Intermediate",
            standard: "Standard",
            fullsize: "Fullsize",
            premium: "Premium",
        },
        fuelType: {
            gasoline: "Gasoline",
            diesel: "Diesel",
            electricity: "Electricity",
        },
        transmission: {
            automatic: "Automatic",
            manual: "Manual",
        },
    },
};

type BookingForm = {
    booking: {
        departure: string;
        return: string;
    };
    vehicle: {
        category: string;
        fuelType: string;
        transmission: string;
    };
    driver: {
        firstName: string;
        lastName: string;
        gender: string;
        birthdate: string;
        email: string;
    };
};

const bookingForm = useForm<BookingForm>({
    booking: {
        departure: "",
        return: "",
    },
    vehicle: {
        category: "",
        fuelType: "",
        transmission: "",
    },
    driver: {
        firstName: "",
        lastName: "",
        gender: "",
        birthdate: "",
        email: "",
    },
});

const submit = () => {
    console.log(bookingForm);
};
</script>

<template>
    <div class="my-5">
        <form
            action=""
            class="w-11/12 max-w-2xl space-y-6 border py-5 px-10 rounded-lg"
            @submit.prevent="submit"
        >
            <fieldset class="space-y-3">
                <legend class="text-xl font-semibold">Booking Details</legend>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="departure" class="text-light-grey"
                            >Departure Date</label
                        >
                        <input
                            type="date"
                            id="departure"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.booking.departure"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="return" class="text-light-grey"
                            >Return Date</label
                        >
                        <input
                            type="date"
                            id="return"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.booking.return"
                            required
                        />
                    </div>
                </div>
            </fieldset>
            <hr />
            <fieldset class="space-y-3">
                <legend class="text-xl font-semibold">Vehicle Details</legend>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="category" class="text-light-grey"
                            >Vehicle Category</label
                        >
                        <select
                            name="category"
                            id="category"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.vehicle.category"
                            required
                        >
                            <option
                                v-for="vehicleCategory in formOptions.vehicle
                                    .vehicleCategory"
                                :value="vehicleCategory"
                            >
                                {{ vehicleCategory }}
                            </option>
                        </select>
                    </div>
                    <div class="grid">
                        <label for="fuel_type" class="text-light-grey"
                            >Fuel Type</label
                        >
                        <select
                            name="fuel_type"
                            id="fuel_type"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.vehicle.fuelType"
                            required
                        >
                            <option
                                :value="fuelType"
                                v-for="fuelType in formOptions.vehicle.fuelType"
                            >
                                {{ fuelType }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <fieldset
                        v-if="
                            bookingForm.vehicle.fuelType === 'Gasoline' ||
                            bookingForm.vehicle.fuelType === 'Diesel'
                        "
                        class="grid"
                    >
                        <legend class="text-light-grey">Transmission</legend>
                        <div class="flex items-center">
                            <label
                                v-for="transmission in formOptions.vehicle
                                    .transmission"
                                :for="transmission"
                                class="mr-5"
                                ><input
                                    type="radio"
                                    :id="transmission"
                                    name="transmission"
                                    :value="transmission"
                                    class="mr-1"
                                    v-model="bookingForm.vehicle.transmission"
                                    required
                                />{{ transmission }}</label
                            >
                        </div>
                    </fieldset>
                </div>
            </fieldset>
            <hr />
            <fieldset class="space-y-3">
                <legend class="text-xl font-semibold">Driver Details</legend>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="first_name" class="text-light-grey"
                            >First Name</label
                        >
                        <input
                            type="text"
                            id="first_name"
                            placeholder="John"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.driver.firstName"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="last_name" class="text-light-grey"
                            >Last Name</label
                        >
                        <input
                            type="text"
                            id="last_name"
                            placeholder="Doe"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.driver.lastName"
                            required
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="gender" class="text-light-grey"
                            >Gender</label
                        >
                        <select
                            id="gender"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.driver.gender"
                            required
                        >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="diverse">Diverse</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="birthdate" class="text-light-grey"
                            >Date of birth</label
                        >
                        <input
                            type="date"
                            id="birthdate"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.driver.birthdate"
                            required
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label for="email" class="text-light-grey">Email</label>
                        <input
                            type="email"
                            id="email"
                            placeholder="johndoe@example.com"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.driver.email"
                            required
                        />
                    </div>
                </div>
            </fieldset>
            <button
                type="submit"
                class="px-8 py-2 bg-green rounded-full text-white"
                :class="{
                    'bg-gray-400 hover:bg-gray-400': bookingForm.processing,
                }"
                :disabled="bookingForm.processing"
            >
                Submit
            </button>
        </form>
    </div>
</template>
