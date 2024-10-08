<script setup lang="ts">
import Button from "../../Shared/Button.vue";
import Card from "../../Shared/Card.vue";
import FormInput from "../../Shared/Form/FormInput.vue";
import FormValidationError from "../../Shared/Form/FormValidationError.vue";

import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";

const props = defineProps<{ booking?: BookingForm }>();

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
    id?: string;
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

watch(
    () => props.booking,
    (newBooking: BookingForm | undefined) => {
        if (newBooking) {
            bookingForm.departure = newBooking.departure || "";
            bookingForm.return = newBooking.return || "";
            bookingForm.category = newBooking.category || "";
            bookingForm.fuelType = newBooking.fuelType || "";
            bookingForm.transmission = newBooking.transmission || "";
            bookingForm.firstName = newBooking.firstName || "";
            bookingForm.lastName = newBooking.lastName || "";
            bookingForm.gender = newBooking.gender || "";
            bookingForm.birthdate = newBooking.birthdate || "";
            bookingForm.email = newBooking.email || "";
        }
    },
    { immediate: true }
);

const storeBooking = () => {
    bookingForm.post("/bookings");
};

const updateBooking = (id?: string): string => {
    if (typeof id === "string") {
        bookingForm.patch(`/bookings/${id}`);
    }
    return "";
};

const goBack = () => {
    window.history.back();
};
</script>

<template>
    <div>
        <Card class="w-11/12 max-w-2xl">
            <form
                class="space-y-6"
                @submit.prevent="
                    props.booking
                        ? updateBooking(props.booking.id)
                        : storeBooking()
                "
            >
                <fieldset class="space-y-3">
                    <legend class="text-xl font-semibold">
                        Booking Details
                    </legend>
                    <div class="grid grid-cols-2 gap-5 w-full">
                        <div class="flex flex-col">
                            <FormInput
                                name="departure"
                                type="datetime-local"
                                id="departure"
                                label="Departure"
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
                            <FormInput
                                name="return"
                                type="datetime-local"
                                id="return"
                                label="Return"
                                v-model="bookingForm.return"
                                required
                            />
                            <FormValidationError
                                v-if="bookingForm.errors.return"
                            >
                                {{ bookingForm.errors.return }}
                            </FormValidationError>
                        </div>
                    </div>
                </fieldset>
                <hr />
                <fieldset class="space-y-3">
                    <legend class="text-xl font-semibold">
                        Vehicle Details
                    </legend>
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
                                    v-for="vehicleCategory in formOptions
                                        .vehicle.vehicleCategory"
                                    :value="vehicleCategory"
                                >
                                    {{ vehicleCategory }}
                                </option>
                            </select>
                            <FormValidationError
                                v-if="bookingForm.errors.category"
                            >
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
                                    v-for="fuelType in formOptions.vehicle
                                        .fuelType"
                                >
                                    {{ fuelType }}
                                </option>
                            </select>
                            <FormValidationError
                                v-if="bookingForm.errors.fuelType"
                            >
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
                            <legend class="text-light-grey">
                                Transmission
                            </legend>
                            <div class="flex flex-col">
                                <div>
                                    <label
                                        v-for="transmission in formOptions
                                            .vehicle.transmission"
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
                <fieldset v-if="!props.booking" class="space-y-3">
                    <legend class="text-xl font-semibold">
                        Driver Details
                    </legend>
                    <div class="grid grid-cols-2 gap-5 w-full">
                        <div class="flex flex-col">
                            <FormInput
                                name="firstName"
                                type="text"
                                id="firstName"
                                label="First Name"
                                placeholder="John"
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
                            <FormInput
                                name="lastName"
                                type="text"
                                id="lastName"
                                label="Last Name"
                                placeholder="Doe"
                                v-model="bookingForm.lastName"
                                required
                            />
                            <FormValidationError
                                v-if="bookingForm.errors.lastName"
                            >
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
                            <FormValidationError
                                v-if="bookingForm.errors.gender"
                            >
                                {{ bookingForm.errors.gender }}
                            </FormValidationError>
                        </div>

                        <div class="flex flex-col">
                            <FormInput
                                name="birthdate"
                                type="date"
                                id="birthdate"
                                label="Date of birth"
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
                            <FormInput
                                name="email"
                                type="email"
                                id="email"
                                label="Email"
                                placeholder="johndoe@example.com"
                                v-model="bookingForm.email"
                                required
                            />
                            <FormValidationError
                                v-if="bookingForm.errors.email"
                            >
                                {{ bookingForm.errors.email }}
                            </FormValidationError>
                        </div>
                    </div>
                </fieldset>
                <div class="grid grid-cols-2 gap-5 pt-5">
                    <div class="flex justify-end space-x-5 col-start-2">
                        <Button
                            title="Cancel"
                            styleType="danger"
                            @click="goBack"
                        />
                        <Button
                            type="submit"
                            title="Store Booking"
                            style-type="success"
                            :disabled="bookingForm.processing"
                        />
                    </div>
                </div>
            </form>
        </Card>
    </div>
</template>
