<script setup>
import SidebarLink from "./SidebarLink.vue";
</script>

<template>
    <div
        class="w-64 h-screen pt-28 pb-5 text-white bg-dark-grey font-work-sans flex flex-col justify-between shrink-0 fixed top-0"
    >
        <div class="space-y-20">
            <div class="space-y-5 text-lg flex flex-col">
                <SidebarLink
                    href="/"
                    :active="$page.component === 'Home'"
                    :icon="'pi-home'"
                    >Home</SidebarLink
                >
                <SidebarLink
                    href="/booking"
                    :active="$page.component === 'Booking/Index'"
                    :icon="'pi-list'"
                    >Bookings</SidebarLink
                >
                <SidebarLink
                    href="/drivers"
                    :active="$page.component === 'Drivers'"
                    :icon="'pi-user'"
                    >Drivers</SidebarLink
                >
            </div>
        </div>

        <Link href="/logout" class="flex items-center mx-3 hover:font-semibold"
            ><i class="pi pi-sign-out mr-2"></i>Logout</Link
        >
    </div>
</template>
