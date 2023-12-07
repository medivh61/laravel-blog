<template>
    <div class="flex">
        <AdminHeader/>
        <div class="w-3/4 bg-white p-4">
            <div class="flex flex-col p-5 lg:px-48 lg:py-11" v-for="article in articles" :key="article.id">
                <div class="bg-gray-100 p-5 mb-10">
                    <h1 class="font-bold text-2xl mb-2">{{ article.title }}</h1>
                    <p class="my-3">{{ article.excerpt }}</p>
                    <Link :href="route('articles.show', article.id)"
                          class="text-white font-semibold bg-blue-600 hover:bg-blue-800 p-2 my-1 rounded text-decoration-none">
                        Читать статью...
                    </Link>
                    <span class="ml-2 text-gray-500"> Время чтения: около  {{ article.readingTime }} мин</span>
                    <div class="mt-4">
                        <div class="inline-flex items-center rounded-md shadow-sm mr-8">
                            <Link :href="route('articles.edit', article.id)"
                                  class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center text-decoration-none">
        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
            </svg>
        </span>
                                <span class="hidden md:inline-block">Edit</span>
                            </Link>
                            <a @click.prevent="destroy(article.id)" href="#"
                               class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center text-decoration-none">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
            </svg>
        </span>
                                <span class="hidden md:inline-block">Delete</span>
                            </a>
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
        articles: Array,
    },
    computed: {
        pageNotes() {
            return this.articles.map(article => ({
                ...article,
                excerpt: article.getExcerpt(),
                readingTime: article.getReadingTime(),
            }));
        }
    },

    methods: {
        destroy(id) {
            axios.delete(`/articles/${id}`).then(res => {
                const index = this.articles.findIndex(article => article.id === id);
                if (index !== -1) {
                    this.articles.splice(index, 1);
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
