<template>
    <div class="w-1/4 h-screen bg-gray-200 sticky top-0 p-4">
        <h2 class="text-lg font-bold mb-4">Navigation</h2>
        <ul class="list-none">
            <li class="mb-2">
                <Link :href="route('home')" class="text-gray-700 hover:text-gray-900 text-decoration-none">Главная
                </Link>
            </li>
            <li class="mb-2">
                <Link :href="route('articles.index')" class="text-gray-700 hover:text-gray-900 text-decoration-none">
                    Статьи
                </Link>
            </li>
            <li class="mb-2">
                <Link :href="route('notes.index')" class="text-gray-700 hover:text-gray-900 text-decoration-none">
                    Заметки
                </Link>
            </li>
            <li class="mb-2">
                <Link :href="route('videos.index')" class="text-gray-700 hover:text-gray-900 text-decoration-none">
                    Видео
                </Link>
            </li>

            <li class="mb-2">
                <Link :href="route('admin.panel')" class="text-gray-700 hover:text-gray-900 text-decoration-none">
                    Админка
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>
/* TODO
    Сделать роутеры между vue'хами
 */
import {Link, router} from "@inertiajs/vue3";

export default {
    name: "AdminHeader",
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
