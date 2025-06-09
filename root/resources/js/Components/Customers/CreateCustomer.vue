<script setup>
import { Head, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

import InputError from '@/Components/InputError.vue';

const props = defineProps({
    errors   : Object
});

const form = reactive({
    name : '',
    email : '',
    phone : '',
    company_name : '',
    status : '',
});

const createCustomer = () => {
    console.log(form);
    router.post(route('customers.store'), form, {
        onSuccess: () => {
            emit('close');
        },
        onError: () => {
            console.warn('バリデーションエラーが発生しました');
        }
    });
};

const emit = defineEmits(['close']);

const close = () => {
    return emit('close'); // 親に「閉じて」と伝える
};
</script>

<template>
    <Head title="新規顧客登録" />

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="modal relative overflow-visible z-50 bg-white sm:rounded-lg">
            <div class="fixed top-0 left-0 m-3">
                <h1 class="sm:text-xl text-xl font-medium title-font mb-2 text-gray-900">
                    新規顧客登録
                </h1>
            </div>
            <div class="flex justify-between fixed right-0 top-0 mx-1 my-2">
                <span @click="close" class="cursor-pointer transition transform hover:scale-[1.5]">
                    <img src="/images/close_icon.svg" class="h-7 w-10" alt="閉じる">
                </span>
            </div>

            <div class="p-6 text-gray-900 mt-6">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <form @submit.prevent="createCustomer">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="lg:w-full md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">顧客名</label>
                                            <input type="text" id="name" name="name" v-model="form.name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <InputError :message="props.errors.name"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                            <input type="email" id="email" name="email" v-model="form.email"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <InputError :message="props.errors.email"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="phone" class="leading-7 text-sm text-gray-600">電話番号</label>
                                            <input type="number" id="phone" name="phone" v-model="form.phone"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <InputError :message="props.errors.phone"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="company_name" class="leading-7 text-sm text-gray-600">会社名</label>
                                            <input type="text" id="company_name" name="company_name" v-model="form.company_name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <InputError :message="props.errors.company_name"/>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="status" class="leading-7 text-sm text-gray-600">ステータス</label>
                                            <select
                                            name="status"
                                            id="status"
                                            v-model="form.status"
                                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-base text-gray-700 py-2 px-3"
                                            >
                                            <option value="prospected">見込み</option>
                                            <option value="corresponding">対応中</option>
                                            <option value="completed">完了</option>
                                            </select>

                                        </div>
                                        <InputError :message="props.errors.status"/>
                                    </div>

                                    <div class="p-2 w-1/3 mx-auto">
                                        <button
                                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                            登録
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</template>
