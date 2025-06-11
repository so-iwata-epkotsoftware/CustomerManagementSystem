<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SearchUser from '@/Components/Users/SearchUser.vue';

const props = defineProps({
    customerId : Number,
    errors   : Object
});

const form = reactive({
    customer_id : props.customerId,
    user_id : '',
    user_name : '',
    content : '',
    supported_types : '',
    status : '',
});

const createInteraction = () => {
    router.post(route('interactions.store'), form, {
        onSuccess: () => {
            emit('close');
        },
        onError: () => {
            console.warn('バリデーションエラーが発生しました');
        }
    });
};

const modal = ref(false);
const searchUser = () => {
    modal.value = true;
};

const getUser = (userInfo) => {
    form.user_id = userInfo.id;
    form.user_name = userInfo.name;
};


const emit = defineEmits(['close']);

const close = () => {
    return emit('close'); // 親に「閉じて」と伝える
};
</script>

<template>
    <Head title="対応履歴" />

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="modal relative overflow-visible z-50 bg-white sm:rounded-lg">
            <div class="fixed top-0 left-0 m-3">
                <h1 class="sm:text-xl text-xl font-medium title-font mb-2 text-gray-900">
                    対応履歴
                </h1>
            </div>
            <div class="flex justify-between fixed right-0 top-0 mx-1 my-2">
                <span @click="close" class="cursor-pointer transition transform hover:scale-[1.5]">
                    <img src="/images/close_icon.svg" class="h-7 w-10" alt="閉じる">
                </span>
            </div>

            <Modal :show="modal" @close="modal = false">
                <SearchUser @close="modal = false" @getUser="getUser"/>
            </Modal>

            <div class="p-6 text-gray-900 mt-6">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <form @submit.prevent="createInteraction">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="lg:w-full md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="userName" class="leading-7 text-blue-500 cursor-pointer" @click="searchUser">対応担当者選択</label>
                                            <input type="hidden" name="user_id" v-model="form.user_id">
                                            <input type="text" id="user_name" disabled v-model="form.user_name"
                                                class="mt-2 w-full border border-gray-300 rounded px-3 py-2"
                                                placeholder="担当者を選択してください" />
                                            <InputError :message="props.errors.user_name"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="supported_types" class="leading-7 text-sm text-gray-600">対応種別</label>
                                            <select name="supported_types" id="supported_types" v-model="form.supported_types"
                                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-base text-gray-700 py-2 px-3">
                                                <option value="opposing">対面</option>
                                                <option value="phone">電話</option>
                                                <option value="email">メール</option>
                                                <option value="other">その他</option>
                                            </select>
                                            <InputError :message="props.errors.supported_types"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="content" class="leading-7 text-sm text-gray-600">内容</label>
                                            <textarea id="content" name="content" v-model="form.content"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </textarea>
                                            <InputError :message="props.errors.content"/>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="status" class="leading-7 text-sm text-gray-600">ステータス</label>
                                            <select name="status" id="status" v-model="form.status"
                                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-base text-gray-700 py-2 px-3">
                                                <option value="prospected">未対応</option>
                                                <option value="corresponding">対応中</option>
                                                <option value="completed">完了</option>
                                            </select>
                                            <InputError :message="props.errors.status"/>
                                        </div>
                                    </div>

                                    <div class="p-2 w-1/3 mx-auto">
                                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
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
