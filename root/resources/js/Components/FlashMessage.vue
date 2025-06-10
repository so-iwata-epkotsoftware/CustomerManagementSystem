<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

const show = ref(false);
const page = usePage()

watch(
    () => page.props.flash,
    (flash) => {
        if (flash.status && flash.message) {
        show.value = true
        setTimeout(() => show.value = false, 3000)
        }
    },
    { immediate: true }
)

</script>

<template>

<!-- フラッシュメッセージ：追加 -->
<div v-if="show && page.props.flash.status === 'add'"
    class="bg-blue-400 text-white p-3 inline fixed right-0 mr-10">
    {{ page.props.flash.message }}
</div>

<!-- フラッシュメッセージ：更新 -->
<div v-if="show && page.props.flash.status === 'update'"
    class="bg-green-400 text-white p-3 inline fixed right-0 mr-10">
    {{ page.props.flash.message }}
</div>

<!-- フラッシュメッセージ：削除 -->
<div v-if="show && page.props.flash.status === 'delete'"
    class="bg-red-400 text-white p-3 inline fixed right-0 mr-10">
    {{ page.props.flash.message }}
</div>

<!-- フラッシュメッセージ：エラー -->
<div v-if="show && page.props.flash.status === 'error'"
    class="bg-red-400 text-white p-3 inline fixed right-0 mr-10">
    {{ page.props.flash.message }}
</div>

</template>
