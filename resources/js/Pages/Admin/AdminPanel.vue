<template>
    <div class="flex">
        <AdminHeader/>

        <div class="w-3/4 bg-white p-4">
            <div class="flex flex-col p-5 lg:px-48 lg:py-11">
                <div class="bg-gray-100 p-5 mb-10">
                    <h1 class="font-bold text-2xl mb-2"> Создать статью</h1>
                    <p class="my-3"></p>
                    <Link :href="route('articles.create')"
                          class="text-white font-semibold bg-blue-600 hover:bg-green-800 p-2 my-1 rounded text-decoration-none">
                        Создать статью
                    </Link>
                </div>
            </div>

            <div class="flex flex-col p-5 lg:px-48 lg:py-11">
                <div class="bg-gray-100 p-5 mb-10">
                    <h1 class="font-bold text-2xl mb-2">Создать заметку</h1>
                    <p class="my-3"></p>
                    <Link :href="route('notes.create')"
                          class="text-white font-semibold bg-blue-600 hover:bg-green-800 p-2 my-1 rounded text-decoration-none">
                        Создать Заметку
                    </Link>
                </div>
            </div>

            <div class="flex flex-col p-5 lg:px-48 lg:py-11">
                <div class="bg-gray-100 p-5 mb-10">
                    <h1 class="font-bold text-2xl mb-2">Создать видео</h1>
                    <p class="my-3"></p>
                    <Link :href="route('videos.create')"
                          class="text-white font-semibold bg-blue-600 hover:bg-green-800 p-2 my-1 rounded text-decoration-none">
                        Создать видео
                    </Link>
                </div>
            </div>

        </div>
    </div>


</template>

<script>
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Pages/Pagination/Pagination.vue";

export default {
    name: "AdminPanel",
    components: {Pagination, Link, AdminHeader}
}
</script>

<style scoped>

</style>
