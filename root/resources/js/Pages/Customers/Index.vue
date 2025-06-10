<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import ShowCustomer from '@/Components/Customers/EditCustomer.vue';
import CreateCustomer from '@/Components/Customers/CreateCustomer.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
    customers : Object,
    errors : Object,

});

const customerData = ({});

const showModal = ref(false);

const showCustomer = (customer) => {
    customerData.value = customer;
    showModal.value = true;
};

const createModal = ref(false);

const createCustomer = () => {
    createModal.value = true;
};
</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800" >
                顧客一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Modal :show="showModal" @close="showModal=false">
                            <ShowCustomer :customer="customerData.value" :errors="errors" @close="showModal=false" />
                        </Modal>

                        <Modal :show="createModal" @close="createModal=false">
                            <CreateCustomer :errors="errors" @close="createModal=false"/>
                        </Modal>

                        <section class="text-gray-600 body-font">
                            <FlashMessage/>
                            <div class="container px-5 mx-auto relative">

                                <div class="lg:w-2/3 w-full mx-auto">
                                    <div class="flex text-center w-full my-5">
                                        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
                                        顧客一覧
                                        </h1>
                                        <span class="ml-4 cursor-pointer transition transform hover:scale-[1.5]" @click="createCustomer">
                                            <img src="/images/add_customer_icon.svg" class="w-10"  alt="新規顧客登録">
                                        </span>
                                    </div>
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">顧客名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">最終対応日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap">ステータス</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="customer in props.customers.data" :key="customer.id" @click="showCustomer(customer)"
                                            class="border-b-2 border-gray-200 cursor-pointer transition transform hover:scale-[1.03] hover:bg-gray-300">
                                            <td class="px-4 py-3 whitespace-nowrap">{{ customer.company_name }}：{{ customer.name }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ customer.email }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ customer.updated_at_formatted }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ customer.status_conversion }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-6 w-full flex self-center">
                                    <Pagination class="mx-auto"  :links="props.customers.links" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
