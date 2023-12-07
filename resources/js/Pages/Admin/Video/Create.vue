<template>
    <div class="flex">
        <Admin/>
        <div class="w-3/4 bg-white p-4">
            <h1 class="text-2xl md:text-3xl pl-2 my-2 border-l-4  font-sans font-bold border-teal-400  dark:text-black-200">
                Создание статьи
            </h1>
            <div class="max-w-2xl mx-auto p-4">
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-800 mb-1">Заголовок</label>
                    <input type="text" id="title" v-model="title" name="title"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="file"></label>
                    <input @change="initFile" id="file" type="file">
                </div>
                <div class="flex justify-end">
                    <a @click.prevent="store" href="#"
                       class="px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 focus:outline-none text-decoration-none">Добавить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {router} from "@inertiajs/vue3";
import Header from "@/Pages/Header.vue";
import Admin from "@/Pages/Admin/AdminHeader.vue";

export default {
    name: "Create",
    components: {Admin, Header},
    data() {
        return {
            title: '',
            file_video: null
        }
    },

    methods: {

        initFile(e) {
            this.file = new FormData()
            this.file.append('file_video', e.target.files[0])
        },

        store() {
            this.file.append('title', this.title)
            router.post('/videos', this.file)
        }
    }


}


</script>

<style scoped>
</style>
