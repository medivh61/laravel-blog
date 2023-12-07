<template>
    <div class="flex">
        <AdminHeader/>
        <div class="w-3/4 bg-white p-4">
            <h1 class="text-2xl md:text-3xl pl-2 my-2 border-l-4  font-sans font-bold border-teal-400  dark:text-black-200">
                Редактирование заметки
            </h1>
            <div class="max-w-2xl mx-auto p-4">
                <form action="/submit-post" method="POST">
                    <div class="mb-6">
                        <label for="title" class="block text-lg font-medium text-gray-800 mb-1">Заголовок</label>
                        <input type="text" id="title" v-model="title" name="title"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                               required>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-lg font-medium text-gray-800 mb-1">Контент</label>
                        <textarea id="description" v-model="body" name="description"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                  rows="6" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <a @click.prevent="update" href="#"
                           class="px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 focus:outline-none text-decoration-none">Обновить</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Header from "@/Pages/Header.vue";
import {router} from "@inertiajs/vue3";
import Admin from "@/Pages/Admin/AdminHeader.vue";
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";


export default {
    name: "Edit",
    components: {AdminHeader, Admin, Header},
    props: ['notePost'],
    data() {
        return {
            title: this.notePost.title,
            body: this.notePost.body,
        }
    },

    methods: {
        update() {
            router.patch(`/notes/${this.notePost.id}`, {title: this.title, body: this.body})
        }
    }


}


</script>

<style scoped>
</style>
