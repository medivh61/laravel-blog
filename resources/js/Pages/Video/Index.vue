<template>
    <Header/>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10 md:px-20">

        <div class="rounded-lg shadow-lg bg-white max-w-sm" v-for="video in videos" :key="videos.id">
                <video width="320" height="240" controls class="w-full rounded-t-lg">
                    <source :src="video.file_video" type="video/mp4">
                </video>
            <div class="p-6">
                <h5 class="text-gray-900 text-xl font-medium mb-2">{{ video.title }}</h5>
                <Link :href="route('videos.show', video.id)" type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg
                transition duration-150 ease-in-out">Смотреть</Link>
            </div>
        </div>
    </div>




    <Pagination :links="paginationLinks.links"/>
</template>

<script>
import Header from "@/Pages/Header.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Pages/Pagination/Pagination.vue";

export default {
    name: "Index",
    components: {Header, Link, Pagination},
    props: {
        paginationLinks: Array,
        videos: Array,
    },
}
</script>

<style scoped>

</style>

