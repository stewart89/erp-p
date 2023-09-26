<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import NavLink from "@/Components/NavLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { Head, Link, router, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    price: "",
    three_pack_price: "",
    five_pack_price: "",
});

const submit = () => {
    form.post(route("products.store"), {});
};
</script>

<template #form>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add new product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-5">
                        
                        <form @submit.prevent="submit">
                            <div
                                class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md"
                            >
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel
                                            value="Name"
                                            required="true"
                                        ></InputLabel>
                                        <TextInput
                                            name="name"
                                            type="text"
                                            v-model="form.name"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                        >
                                        </TextInput>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.name"
                                        />
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel
                                            value="Price"
                                            :required="true"
                                        ></InputLabel>
                                        <TextInput
                                            name="price"
                                            type="number"
                                            v-model="form.price"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block"
                                        >
                                        </TextInput>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.price"
                                        />
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel
                                            value="Price for three pack"
                                            :required="true"
                                        ></InputLabel>
                                        <TextInput
                                            name="three_pack_price"
                                            type="number"
                                            v-model="form.three_pack_price"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block"
                                        >
                                        </TextInput>
                                        <InputError
                                            class="mt-2"
                                            :message="
                                                form.errors.three_pack_price
                                            "
                                        />
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel
                                            :value="'Price for five pack'"
                                            :required="true"
                                        ></InputLabel>
                                        <TextInput
                                            name="five_pack_price"
                                            type="number"
                                            v-model="form.five_pack_price"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block"
                                        >
                                        </TextInput>
                                        <InputError
                                            class="mt-2"
                                            :message="
                                                form.errors.five_pack_price
                                            "
                                        />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                            >
                                <Link :href="route('products')">
                                    <SecondaryButton> Back </SecondaryButton>
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :disabled="form.processing"
                                >
                                    Save
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
