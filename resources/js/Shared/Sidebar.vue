<script setup>
import SidebarLink from "./SidebarLink.vue";
</script>

<template>
    <div
        class="bg-light-grey h-screen w-72 p-4 text-neutral-900 font-work-sans shadow-xl flex flex-col justify-between"
    >
        <div class="space-y-20">
            <div
                class="flex items-center space-x-3 border-b-2 border-white pb-2"
            >
                <img src="https://placehold.co/50/f5bf03/blue" alt="" />
                <h1 class="font-poppins italic text-3xl text-blue font-bold">
                    PrimeDrive
                </h1>
            </div>

            <div class="space-y-5 text-lg flex flex-col">
                <SidebarLink href="/">Home</SidebarLink>
                <SidebarLink href="/booking">Booking</SidebarLink>
                <SidebarLink href="/reservations">Reservations</SidebarLink>
                <SidebarLink href="/drivers">Drivers</SidebarLink>
            </div>
        </div>

        <Link href="/logout" class="flex items-center mx-3 hover:font-semibold"
            ><i class="pi pi-sign-out mr-2"></i>Logout</Link
        >
    </div>
</template>
