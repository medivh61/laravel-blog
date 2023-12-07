<template>
    <Header/>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-10 p-10">
        <div v-for="notePost in notePosts" :key="notePost.id" class="flex border border-gray-500 rounded-lg p-4 bg-white">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="text-green-500 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l5 5l10 -10"></path>
            </svg>
            <div class="ml-2">
                <h4 class="font-semibold text-base text-primary tracking-normal">{{ notePost.title }}</h4>
                <p class="text-sm font-normal text-gray tracking-normal">{{ notePost.body }}</p>
                <Link :href="route('notes.show', notePost.id)" class="text-indigo-700 border border-indigo-400 py-4 px-6 rounded inline-flex items-center">
                     Комментарии
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         viewBox="0 0 24 24" class="w-6 h-6 ml-2">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </Link>
            </div>
        </div>
    </div>
    <Pagination :links="paginationLinks.links"/>
</template>
<script>
import {Link, router} from "@inertiajs/vue3";
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";
import Pagination from "@/Pages/Pagination/Pagination.vue";
import Header from "@/Pages/Header.vue";

export default {
    name: "Index",
    components: {Header, AdminHeader, Link, Pagination},
    props: {
        paginationLinks: Array,
        notePosts: Array,
    },
}
</script>
