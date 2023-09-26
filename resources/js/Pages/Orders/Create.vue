<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import NavLink from "@/Components/NavLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { computed, ref, watch, reactive } from "vue";

const quantity = ref({});
const selectedProducts = ref([]);
const form = useForm({});
const totalPrice = ref(0)

const updateTotalPrice = (productId) => {
  const productIndex = selectedProducts.value.findIndex(
    (product) => product.id === productId
  );

  if (productIndex >= 0) {
    selectedProducts.value[productIndex].quantity = quantity.value[productId];
  } else {
    selectedProducts.value.push({
      id: productId,
      quantity: quantity.value[productId],
    });
  }

    axios.post(route("orders.calculate"), {products: selectedProducts.value})
    .then(response => {
        console.log(response);
        totalPrice.value = response.data.totalPrice;
        console.log(totalPrice.value);
    })
    .catch(error => {
        console.log(error);
    });
};



const submit = () => {
    form.post(route("orders.store"), {});
};
</script>

<template #form>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add new order
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-5">

                        <div
                            class="px-4 py-5 bg-white sm:p-4 shadow sm:rounded-tl-md sm:rounded-tr-md"
                        >
                            <div class="grid grid-cols-4 gap-6">
                                <div class="col-span-4 sm:col-span-4">
                                    <div
                                        class="product-item"
                                        v-for="product in $page.props
                                            .products"
                                        :key="product.id"
                                    >
                                        <div class="flex items-center mb-4">
                                            <div class="product-price px-4 py-5">
                                                <span class="font-bold">Name: </span>{{ product.name }} Ft.
                                            </div>
                                            <div class="product-price px-4 py-5">
                                                <span class="font-bold">Price: </span>{{ product.price }} Ft.
                                            </div>
                                            <div class="product-price px-4 py-5 flex-alig">
                                                <span class="font-bold">Quantity: </span>
                                                <input
                                                    type="number"
                                                    v-model="quantity[product.id]"
                                                    value="0"
                                                    @change="updateTotalPrice(product.id)"
                                                    class="product-quantity"
                                                    min="0"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-5">Total Price: {{ totalPrice }} Ft.</div>

                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                        >
                            <Link :href="route('orders')">
                                <SecondaryButton> Back </SecondaryButton>
                            </Link>
                            <PrimaryButton
                                class="ml-4"
                                :disabled="form.processing"
                            >
                                Save
                            </PrimaryButton>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.product-item {
  margin-bottom: 1rem;
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 0.5rem;
}

.product-name {
  font-weight: bold;
  margin-right: 1rem;
}

.product-price {
  margin-right: 1rem;
}

.product-quantity {
  width: 5rem;
  margin-left: auto;
}
</style>