<template>
    <Header/>

    <div class="flex flex-col p-5 lg:px-48 lg:py-11 " v-for="article in articles">
        <div class="bg-gray-100 p-5 mb-10">
            <h1 class="font-bold text-2xl mb-2">{{ article.title }}</h1>
            <p class="my-3">{{ article.excerpt }}</p>
            <Link :href="route('articles.show', article.id)"
                  class="text-white font-semibold bg-blue-600 hover:bg-blue-800 p-2 my-1 rounded text-decoration-none">
                Читать статью...
            </Link>
            <span class="ml-2 text-gray-500"> Время чтения: около  {{ article.readingTime }} мин</span>
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
    components: {Pagination, Header, Link},
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
    }
}
</script>

<style scoped>

</style>
