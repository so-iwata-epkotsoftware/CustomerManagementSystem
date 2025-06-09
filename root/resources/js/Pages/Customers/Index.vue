<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import NavLink from '../../Components/NavLink.vue';

const props = defineProps({
    customers : Object,
});

console.log(props.customers);

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
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">顧客名</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">会社名</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="customer in props.customers.data" :key="customer.id">
                                        <td class="px-4 py-3">{{ customer.name }}</td>
                                        <td class="px-4 py-3">{{ customer.email }}</td>
                                        <td class="px-4 py-3">{{ customer.phone }}</td>
                                        <td class="px-4 py-3">{{ customer.company_name }}</td>
                                        <td class="px-4 py-3">{{ customer.status_conversion }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                                    <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                                </div>
                                <!-- <div class="flex space-x-2">
                                    <NavLink
                                    v-for="link in props.customers.links"
                                    :key="link.label"
                                    :href="link.url"
                                    :active="link.active"
                                    v-html="link.label"
                                    />
                                </div> -->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
