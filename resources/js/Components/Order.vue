<script setup>
import ConfirmationModal from "./ConfirmationModal.vue";
import SecondaryButton from "./SecondaryButton.vue";
import DangerButton from "./DangerButton.vue";

import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const props = defineProps({
    order: Object,
});

const show = ref(false);
const showConfirmModal = () => {
    show.value = true;
}

const close = () => {
    show.value = false;
}

const deleteProduct = (id) => {
    router.delete(route("orders.delete", id), {
        onSuccess: () => show.value = false,
    });
}

</script>

<template>
    <th
        scope="row"
        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
    >
        {{ order.products.length }} products
    </th>
    <td class="px-6 py-4">{{ product.total_price }} Ft.</td>
    <td class="px-6 py-4">{{ product.finalized? 'Yes' : 'No' }}</td>
    <td class="px-6 py-4">{{ product.created_at }}</td>
    <td class="px-6 py-4">
        <Link
            class="flex items-center px-4"
            :href="route('products.edit', product.id)"
        >
            <button class="cursor-pointer ml-6 text-sm text-grey-500">
                Edit
            </button>
        </Link>

        <button class="cursor-pointer ml-6 text-sm text-red-500" @click="showConfirmModal">
            Delete
        </button>

        <ConfirmationModal :show="show" @close="show = false">
            <template #title>
                Delete Product
            </template>

            <template #content>
                Are you sure you would like to delete: {{ product.name }}?
            </template>

            <template #footer>
                <SecondaryButton @click="show = false">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    @click="deleteProduct(product.id)"
                >
                    Delete
                </DangerButton>
            </template>
        </ConfirmationModal>

        <!--<button v-if="!contact.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Contact</button>-->
    </td>
</template>
