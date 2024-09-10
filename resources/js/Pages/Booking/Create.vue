<script setup lang="ts">
import Heading from "../../Shared/Heading.vue";
import FormValidationError from "../../Shared/FormValidationError.vue";

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

interface BookingForm {
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

const bookingForm = useForm<BookingForm>({
    departure: "",
    return: "",
    category: "",
    fuelType: "",
    transmission: "",
    firstName: "",
    lastName: "",
    gender: "",
    birthdate: "",
    email: "",
});

const submit = () => {
    bookingForm.post("/booking");
};
</script>

<template>
    <Heading title="New Booking" />
    <div>
        <form
            class="w-11/12 max-w-2xl space-y-6 border py-5 px-10 rounded-lg"
            @submit.prevent="submit"
        >
            <fieldset class="space-y-3">
                <legend class="text-xl font-semibold">Booking Details</legend>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="departure" class="text-light-grey"
                            >Departure
                        </label>
                        <input
                            name="departure"
                            type="datetime-local"
                            id="departure"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.departure"
                            required
                        />
                        <FormValidationError
                            v-if="bookingForm.errors.departure"
                        >
                            {{ bookingForm.errors.departure }}
                        </FormValidationError>
                    </div>

                    <div class="flex flex-col">
                        <label for="return" class="text-light-grey"
                            >Return
                        </label>
                        <input
                            name="return"
                            type="datetime-local"
                            id="return"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.return"
                            required
                        />
                        <FormValidationError v-if="bookingForm.errors.return">
                            {{ bookingForm.errors.return }}
                        </FormValidationError>
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
                            v-model="bookingForm.category"
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
                        <FormValidationError v-if="bookingForm.errors.category">
                            {{ bookingForm.errors.category }}
                        </FormValidationError>
                    </div>
                    <div class="grid">
                        <label for="fuel_type" class="text-light-grey"
                            >Fuel Type</label
                        >
                        <select
                            name="fuelType"
                            id="fuelType"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.fuelType"
                            required
                        >
                            <option
                                :value="fuelType"
                                v-for="fuelType in formOptions.vehicle.fuelType"
                            >
                                {{ fuelType }}
                            </option>
                        </select>
                        <FormValidationError v-if="bookingForm.errors.fuelType">
                            {{ bookingForm.errors.fuelType }}
                        </FormValidationError>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <fieldset
                        v-if="
                            bookingForm.fuelType === 'Gasoline' ||
                            bookingForm.fuelType === 'Diesel'
                        "
                        class="grid"
                    >
                        <legend class="text-light-grey">Transmission</legend>
                        <div class="flex flex-col items-center">
                            <div class="flex">
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
                                        v-model="bookingForm.transmission"
                                        required
                                    />{{ transmission }}</label
                                >
                            </div>
                            <FormValidationError
                                v-if="bookingForm.errors.transmission"
                            >
                                {{ bookingForm.errors.transmission }}
                            </FormValidationError>
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
                            name="firstName"
                            type="text"
                            id="firstName"
                            placeholder="John"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.firstName"
                            required
                        />
                        <FormValidationError
                            v-if="bookingForm.errors.firstName"
                        >
                            {{ bookingForm.errors.firstName }}
                        </FormValidationError>
                    </div>

                    <div class="flex flex-col">
                        <label for="lastName" class="text-light-grey"
                            >Last Name</label
                        >
                        <input
                            name="lastName"
                            type="text"
                            id="lastName"
                            placeholder="Doe"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.lastName"
                            required
                        />
                        <FormValidationError v-if="bookingForm.errors.lastName">
                            {{ bookingForm.errors.lastName }}
                        </FormValidationError>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col">
                        <label for="gender" class="text-light-grey"
                            >Gender</label
                        >
                        <select
                            name="gender"
                            id="gender"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.gender"
                            required
                        >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="diverse">Diverse</option>
                        </select>
                        <FormValidationError v-if="bookingForm.errors.gender">
                            {{ bookingForm.errors.gender }}
                        </FormValidationError>
                    </div>

                    <div class="flex flex-col">
                        <label for="birthdate" class="text-light-grey"
                            >Date of birth</label
                        >
                        <input
                            name="birthdate"
                            type="date"
                            id="birthdate"
                            class="border rounded-full px-5 py-2 text-dark-grey w-full"
                            v-model="bookingForm.birthdate"
                            required
                        />
                        <FormValidationError
                            v-if="bookingForm.errors.birthdate"
                        >
                            {{ bookingForm.errors.birthdate }}
                        </FormValidationError>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label for="email" class="text-light-grey">Email</label>
                        <input
                            name="email"
                            type="email"
                            id="email"
                            placeholder="johndoe@example.com"
                            class="border rounded-full px-5 py-2 text-dark-grey"
                            v-model="bookingForm.email"
                            required
                        />
                        <FormValidationError v-if="bookingForm.errors.email">
                            {{ bookingForm.errors.email }}
                        </FormValidationError>
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
