<template>
    <div class="flex">
        <AdminHeader/>
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10 md:px-20">
                <div class="relative" v-for="video in videos" :key="videos.id">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <video width="320" height="240" controls>
                                    <source :src="video.file_video" type="video/mp4">
                                </video>
                                <p class="text-lg font-medium text-gray-800 mb-2">{{video.title}}</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center" style="margin-top: 8px;">
                                <Link :href="route('videos.edit', video.id)" class="btn btn-primary mx-3 mb-1 px-5 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out text-decoration-none">
                                    Edit</Link>
                                <a
                                    @click.prevent="destroy(video.id)" href="#"
                                    class="btn btn-primary mx-3 mb-1 px-5 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out text-decoration-none">
                                    Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :links="paginationLinks.links"/>
        </div>
    </div>
</template>

<script>
import Header from "@/Pages/Admin/AdminHeader.vue";
import {Link} from "@inertiajs/vue3";
import axios from 'axios';
import Pagination from "@/Pages/Pagination/Pagination.vue";
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";

export default {
    name: "Index",
    components: {AdminHeader, Link, Pagination},
    props: {
        paginationLinks: Array,
        videos: Array,
    },

    methods: {
        destroy(id) {
            axios.delete(`/videos/${id}`).then(res => {
                const index = this.videos.findIndex(video => video.id === id);
                if (index !== -1) {
                    this.videos.splice(index, 1);
                }
            }).catch(res => {
                console.error(res);
            });
        },
    }
}
</script>

<style scoped>

</style>

