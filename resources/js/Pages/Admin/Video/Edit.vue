<template>
    <div class="flex">
        <AdminHeader/>

        <div class="w-3/4 bg-white p-4">
            <h1 class="text-2xl md:text-3xl pl-2 my-2 border-l-4  font-sans font-bold border-teal-400  dark:text-black-200">
                Редактирование видео </h1>
            <div class="max-w-2xl mx-auto p-4">
                <form action="/submit-post" method="POST">
                    <div class="mb-6">
                        <label for="title" class="block text-lg font-medium text-gray-800 mb-1">Заголовок</label>
                        <input type="text" id="title" v-model="form.title" name="title"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                               required>
                    </div>

                    <div class="mb-4">
                        <!--                        <label for="file">Выберите изображение:</label>-->
                        <input name="file_video" type="file" @input="form.file_video = $event.target.files[0]"/>
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
    props: ['video'],
    data() {
        return {
            form: this.$inertia.form({
                title: this.video.title,
                file_video: null,
            })
        }
    },

    methods: {
        update() {
            if (this.form.file_video !== null) {
                this.$inertia.post(this.route('videos.update', {video: this.video.id, _method: 'put'}), this.form)
            } else {
                let updatedForm = {...this.form};
                delete updatedForm.file_video;
                this.$inertia.post(this.route('videos.update', {video: this.video.id, _method: 'put'}), updatedForm)
            }
        }
    }
}


</script>

<style scoped>
</style>

