<template>
    <div class="flex">
        <AdminHeader/>
        <div class="w-3/4 bg-white p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Описание
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Действие
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="notePost in notePosts" :key="notePost.id">
                    <td class="px-6 py-4 whitespace-nowrap">{{ notePost.title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ notePost.body }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <Link :href="route('notes.edit', notePost.id)"
                              class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out text-decoration-none">
                            Edit
                        </Link>
                        <a @click.prevent="destroy(notePost.id)" href="#"
                           class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out text-decoration-none">
                            Delete
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination :links="paginationLinks.links" class="mt-5"/>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import axios from 'axios';
import AdminHeader from "@/Pages/Admin/AdminHeader.vue";
import Pagination from "@/Pages/Pagination/Pagination.vue";

export default {
    name: "Index",
    components: {AdminHeader, Link, Pagination},
    props: {
        notePosts: Array,
        paginationLinks: Array,
    },
    methods: {
        destroy(id) {
            axios.delete(`/notes/${id}`).then(res => {
                const index = this.notePosts.findIndex(notePost => notePost.id === id);
                if (index !== -1) {
                    this.notePosts.splice(index, 1);
                }
            }).catch(res => {
                console.error(res);
            });
        },
    }
}
</script>
