<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Order from "@/Components/Order.vue";
import SuccessNotification from "@/Components/SuccessNotification.vue";
import { Head, Link, router } from "@inertiajs/vue3";

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <SuccessNotification :text="$page.props.flash.success">
                </SuccessNotification>

                <button
                    class="mb-8 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                >
                    <Link
                        :href="route('orders.create')"
                        class="flex items-center px-4"
                    >
                        New order
                    </Link>
                </button>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-5">
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">Products</th>
                                    <th scope="col" class="px-6 py-3">
                                        Total price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Finalized
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="order in $page.props.orders"
                                    :key="order.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <Order :product="order" />
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
