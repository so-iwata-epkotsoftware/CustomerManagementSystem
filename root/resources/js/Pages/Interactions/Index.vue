<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import EditCustomer from '@/Components/Customers/EditCustomer.vue';
import CreateInteraction from '@/Components/Interactions/CreateInteraction.vue';
import EditInteraction from '@/Components/Interactions/EditInteraction.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
    interactions : Object,
    errors : Object,
});

// 顧客情報更新
const customerData = ({});
const editCustomerModal = ref(false);
const editCustomer = (customer) => {
    customerData.value = customer;
    editCustomerModal.value = true;
};

// 対応履歴新規作成
const createInteractionModal = ref(false);
const createInteraction = (interaction) => {
    createInteractionModal.value = true;
};

// 対応履歴編集
const editInteractionData = ({});
const editInteractionModal = ref(false);
const editInteraction = (interaction) => {
    editInteractionData.value = interaction;
    editInteractionModal.value = true;
};

const deleteCustomer = id => {
    if (!confirm('本当に削除しますか？')) return;
    router.post(route('customers.destroy', {id}));
};
</script>

<template>
    <Head title="対応履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800" >
                対応履歴
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- モーダル画面：顧客編集画面 -->
                        <Modal :show="editCustomerModal" @close="editCustomerModal=false">
                            <EditCustomer :customer="customerData.value" :errors="errors" @close="editCustomerModal=false" />
                        </Modal>

                        <!-- モーダル画面：対応履歴新規作成画面 -->
                        <Modal :show="createInteractionModal" @close="createInteractionModal=false">
                            <CreateInteraction
                                :customerId='props.interactions.data[0].id'
                                :errors="errors"
                                @close="createInteractionModal=false" />
                        </Modal>

                        <!-- モーダル画面：対応履歴編集画面 -->
                        <Modal :show="editInteractionModal" @close="editInteractionModal=false">
                            <EditInteraction
                                :customerId='props.interactions.data[0].id'
                                :interaction="editInteractionData.value"
                                :errors="errors"
                                @close="editInteractionModal=false" />
                        </Modal>

                        <section class="text-gray-600 body-font">
                            <!-- フラッシュメッセージ -->
                            <FlashMessage/>

                            <div class="container px-5 mx-auto relative">
                                <div class="lg:w-5/6 w-full mx-auto">
                                    <div class="flex text-center w-full my-5">
                                        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
                                        対応履歴
                                        </h1>
                                        <span @click="deleteCustomer(props.interactions.data[0].id)" class="mx-2 cursor-pointer transition transform hover:scale-[1.5]">
                                            <img src="/images/trash_icon.svg" class="w-8" alt="ゴミ箱">
                                        </span>
                                    </div>

                                    <div class="mb-5">
                                        <div class="flex text-center w-full my-5">
                                            <h1 class="sm:text2xl text-3xl font-medium title-font mb-2 text-gray-900">
                                            顧客情報
                                            </h1>
                                            <span class="ml-4 cursor-pointer transition transform hover:scale-[1.5]" @click="editCustomer(props.interactions.data[0])">
                                                <img src="/images/update_customer_icon.svg" class="h-7"  alt="顧客更新">
                                            </span>
                                        </div>

                                        <ul class="w-2/3">
                                            <li class="px-4 py-1 title-font flex justify-between gap-5">
                                                <span class="w-1/3">顧客名（会社名）:</span>
                                                <span class="w-2/3">{{ props.interactions.data[0].company_name }}</span>
                                            </li>
                                            <li class="px-4 py-1 title-font flex justify-between gap-5">
                                                <span class="w-1/3">担当者名：</span>
                                                <span class="w-2/3">{{ props.interactions.data[0].name }}</span>

                                            </li>
                                            <li class="px-4 py-1 title-font flex justify-between gap-5">
                                                <span class="w-1/3">電話番号:</span>
                                                <span class="w-2/3">{{ props.interactions.data[0].phone }}</span>

                                            </li>
                                            <li class="px-4 py-1 title-font flex justify-between gap-5">
                                                <span class="w-1/3">メール:</span>
                                                <span class="w-2/3">{{ props.interactions.data[0].email }}</span>

                                            </li>
                                            <li class="px-4 py-1 title-font flex justify-between gap-5">
                                                <span class="w-1/3">ステータス:</span>
                                                <span class="w-2/3">{{ props.interactions.data[0].status_conversion }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="w-full mx-auto">
                                        <div class="flex text-center w-full my-5">
                                            <h1 class="sm:text2xl text-3xl font-medium title-font mb-2 text-gray-900">
                                            対応履歴
                                            </h1>
                                            <span class="ml-4 cursor-pointer transition transform hover:scale-[1.5]" @click="createInteraction">
                                                <img src="/images/interaction_create_icon.svg" class="h-8"  alt="新規対応履歴登録">
                                            </span>
                                        </div>
                                        <table class="table-auto w-full text-left whitespace-no-wrap">
                                            <thead>
                                                <tr>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">日時</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">担当者</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap">対応種別</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">内容</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="interaction in props.interactions.data[0].interactions" :key="interaction.key" @click="editInteraction(interaction)"
                                                    class="border-b-2 border-gray-200 cursor-pointer transition transform hover:scale-[1.03] hover:bg-gray-300">
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ interaction.created_at_formatted }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ interaction.user.name }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ interaction.supported_types_conversion }}</td>
                                                    <td class="px-4 py-3">{{ interaction.content }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ interaction.status_conversion }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-6 w-full flex self-center">
                                    <Pagination class="mx-auto"  :links="props.interactions.links" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
