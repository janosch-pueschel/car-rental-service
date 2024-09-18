<script lang="ts">
export default {
    layout: null,
};
</script>

<script setup lang="ts">
import Button from "../../Shared/Button.vue";
import Card from "../../Shared/Card.vue";
import FormInput from "../../Shared/Form/FormInput.vue";
import Heading from "../../Shared/Heading.vue";

import { useForm } from "@inertiajs/vue3";

const loginForm = useForm({
    username: "",
    password: "",
});

const submit = () => {
    loginForm.post("/login");
};
</script>

<template>
    <div class="w-screen h-screen flex justify-center items-center">
        <Card class="w-96">
            <Heading title="Login" class="text-center" />
            <form @submit.prevent="submit" class="space-y-3">
                <FormInput
                    name="username"
                    type="text"
                    id="username"
                    label="Username"
                    v-model="loginForm.username"
                />
                <FormInput
                    name="password"
                    type="password"
                    id="password"
                    label="Password"
                    v-model="loginForm.password"
                />
                <div class="flex justify-center">
                    <Button
                        title="Sign In"
                        type="submit"
                        class="mt-5"
                        :disabled="loginForm.processing"
                    />
                </div>
            </form>
        </Card>
    </div>
</template>
