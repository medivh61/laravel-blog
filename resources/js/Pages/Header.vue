<template>

    <nav class="bg-gray-800 py-4">
        <div class="container mx-auto flex justify-between items-center px-4">

            <Link :href="route('home')" class="text-white text-2xl text-decoration-none font-bold">My Blog
            </Link>
            <div class="flex">
                <Link :href="route('home')" class="text-gray-400 hover:text-white text-decoration-none mx-2">Главная
                </Link>
                <Link :href="route('admin.panel')" class="text-gray-400 hover:text-white text-decoration-none mx-2">
                    Админка
                </Link>
                <Link :href="route('show.article')" class="text-gray-400 hover:text-white text-decoration-none mx-2">
                    Статьи
                </Link>
                <Link :href="route('show.note')" class="text-gray-400 hover:text-white text-decoration-none mx-2">
                    Заметки
                </Link>
                <Link :href="route('show.video')" class="text-gray-400 hover:text-white text-decoration-none mx-2">
                    Видео
                </Link>
                <div class="form-group mb-4">
                    <Link as="button" method="post" :href="route('logout')" class="text-gray-400 hover:text-white text-decoration-none mx-2">Выйти</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
/* TODO
    Сделать роутеры между vue'хами
 */
import {Link, router} from "@inertiajs/vue3";

export default {
    name: "Header",
    methods: {
        router() {
            return router
        }
    },
    components: {Link}
}
</script>

<style scoped>

</style>
