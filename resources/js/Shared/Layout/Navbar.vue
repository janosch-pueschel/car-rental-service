<template>
    <div
        class="bg-black text-white sticky top-0 z-20 h-20 py-3 font-work-sans text-lg flex justify-center"
    >
        <div class="flex justify-between items-center w-full">
            <div class="w-64 flex justify-center items-center">
                <img
                    src="../../../img/europcar_logo.png"
                    alt="europcar_logo"
                    class="w-40"
                />
            </div>

            <div class="pr-10">
                <div class="flex items-center">
                    <i class="pi pi-user mr-2"></i>
                    <p>
                        {{
                            `${$page.props.auth.user.first_name} ${$page.props.auth.user.last_name}`
                        }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
