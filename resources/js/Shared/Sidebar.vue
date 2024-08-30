<script setup>
import SidebarLink from "./SidebarLink.vue";
</script>

<template>
    <div
        class="min-w-fit max-w-72 h-screen w-full p-4 text-white bg-dark-grey font-work-sans flex flex-col justify-between sticky top-0"
    >
        <div class="space-y-20">
            <img
                src="../../img/europcar_logo.png"
                alt="europcar_logo"
                class="max-w-60"
            />

            <div class="space-y-5 text-lg flex flex-col">
                <SidebarLink
                    href="/"
                    :active="$page.component === 'Home'"
                    :icon="'pi-home'"
                    >Home</SidebarLink
                >
                <SidebarLink
                    href="/booking"
                    :active="$page.component === 'Booking'"
                    :icon="'pi-plus-circle'"
                    >Booking</SidebarLink
                >
                <SidebarLink
                    href="/reservations"
                    :active="$page.component === 'Reservations'"
                    :icon="'pi-list'"
                    >Reservations</SidebarLink
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
