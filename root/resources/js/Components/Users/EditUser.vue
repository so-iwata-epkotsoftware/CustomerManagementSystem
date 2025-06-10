<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';

import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user : Object,
    errors   : Object
});

const form = reactive({
    id : props.user.id,
    name : props.user.name,
    email : props.user.email,
    role : props.user.role,
    password : props.user.password,
    password_confirmation : props.user.password_confirmation,
});

const updateUser = (id) => {
    router.post(route('users.update', {id}), form, {
        onSuccess: () => {
            emit('close');
        },
        onError: () => {
            console.warn('バリデーションエラーが発生しました');
        }
    });
};

const deleteUser = id => {
    if (!confirm('本当に削除しますか？')) return;

    router.post(route('users.destroy', {id}));
    emit('close');
};

const emit = defineEmits(['close']);

const close = () => {
    return emit('close'); // 親に「閉じて」と伝える
};
</script>

<template>
    <Head title="ユーザー情報更新" />

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="modal relative overflow-visible z-50 bg-white sm:rounded-lg">
            <div class="fixed top-0 left-0 m-3">
                <h1 class="sm:text-xl text-xl font-medium title-font mb-2 text-gray-900">ユーザー情報更新</h1>
            </div>
            <div class="flex justify-between fixed right-0 top-0 mx-1 my-2">
                <span @click="deleteUser(form.id)" class="cursor-pointer transition transform hover:scale-[1.5]">
                    <img src="/images/trash_icon.svg" class="h-7 w-10" alt="ゴミ箱">
                </span>
                <span @click="close" class="cursor-pointer transition transform hover:scale-[1.5]">
                    <img src="/images/close_icon.svg" class="h-7 w-10" alt="閉じる">
                </span>
            </div>

            <div class="p-6 text-gray-900 mt-6">
                <section class="text-gray-600 body-font relative flex flex-col">
                    <form @submit.prevent="updateUser(form.id)">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="lg:w-full md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
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

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <label for="role" class="leading-7 text-sm text-gray-600">権限</label>
                                            <select name="role" id="role" v-model="form.role"
                                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-base text-gray-700 py-2 px-3">
                                                <option value="admin">管理者</option>
                                                <option value="staff">スタッフ</option>
                                            </select>
                                            <InputError :message="props.errors.role"/>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                            <input type="password" id="password" name="password" v-model="form.password" required autocomplete="new-password"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <InputError class="mt-2" :message="props.errors.password" />
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="password_confirmation" class="leading-7 text-sm text-gray-600">パスワード(確認)</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" v-model="form.password_confirmation" required autocomplete="new-password"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <InputError class="mt-2" :message="props.errors.password_confirmation" />
                                        </div>
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
