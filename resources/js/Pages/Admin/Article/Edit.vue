<template>
    <div class="flex">
        <AdminHeader/>
        <div class="w-3/4 bg-white p-4">
            <h1 class="text-2xl md:text-3xl pl-2 my-2 border-l-4  font-sans font-bold border-teal-400  dark:text-black-200">
                Редактирование статьи </h1>
            <div class="max-w-2xl mx-auto p-4">
                <form action="/submit-post" method="POST">
                    <div class="mb-6">
                        <label for="title" class="block text-lg font-medium text-gray-800 mb-1">Заголовок</label>
                        <input type="text" id="title" v-model="form.title" name="title"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                               required>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-lg font-medium text-gray-800 mb-1">Контент</label>
                        <textarea id="description" v-model="form.description" name="description"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                  rows="6" required></textarea>
                    </div>

                    <div class="mb-4">
                        <!--                        <label for="file">Выберите изображение:</label>-->
                        <input name="image" type="file" @input="form.image = $event.target.files[0]"/>
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

import Header from "@/Pages/Header.vue";
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";


export default {
    name: "Edit",
    components: {AdminHeader, Header},
    props: ['article'],
    data() {
        return {
            form: this.$inertia.form({
                title: this.article.title,
                description: this.article.description,
                image: null,
            })
        }
    },

    methods: {
        update() {
            if (this.form.image !== null) {
                this.$inertia.post(this.route('articles.update', {article: this.article.id, _method: 'put'}), this.form)
            } else {
                let updatedForm = {...this.form};
                delete updatedForm.image;
                this.$inertia.post(this.route('articles.update', {article: this.article.id, _method: 'put'}), updatedForm)
            }
        }
    }
}


</script>

<style scoped>
</style>
