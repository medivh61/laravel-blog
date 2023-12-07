<template>
    <Header/>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10 p-6">
            <div class="flex border border-gray-500 rounded-lg p-4 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="text-green-500 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                <div class="mr-3">
                    <h4 class="font-semibold text-base text-primary tracking-normal">{{ notePost.title }}</h4>
                    <p class="text-sm font-normal text-gray tracking-normal">{{ notePost.body }}</p>
                </div>
            </div>
        </div>

    <div class="flex items-center w-[120px] ml-6">
        <a @click.prevent="toggleLike(notePost)" type="button" class="flex items-center w-full px-4 py-2 text-base font-medium text-black bg-white border-t border-b border-l rounded-l-md hover:bg-gray-100 active:bg-yellow">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" :class="['w-4 h-4 mr-2', notePost.is_liked ? 'fill-yellow-500' : 'fill-grey']" fill="currentColor" viewBox="0 0 1792 1792">
                <path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
            </svg>
            Star
        </a>
        <p type="button" class="w-full px-4 py-2 text-base font-medium text-black bg-white border rounded-r-md hover:bg-gray-100">
            {{notePost.likes_count > 0 ? notePost.likes_count : 0}}
        </p>
    </div>

        <div class="w-4/5 bg-white rounded-lg border p-2 my-4 mx-6">
            <h3 class="font-bold">Discussion</h3>
            <form>
                <div class="flex flex-col">
                    <div v-for="comment in comments" class="border rounded-md p-3 ml-3 my-3">
                        <div class="flex gap-3 items-center">
                            <h3 class="font-bold">
                                {{ comment.user.name }}
                            </h3>
                            <span
                                class="text-sm text-gray-400 font-normal">{{ comment.formatted_created_at }}</span>
                        </div>
                        <p class="text-gray-900 mt-2">
                            {{ comment.comment }}
                        </p>
                    </div>
                </div>
                <div class="w-full px-3 my-2">
                    <input
                        v-model="comment"
                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">
                </div>
                <div class="w-full flex justify-end px-3">
                    <a @click.prevent="storeComment(notePost)" href="#"
                       class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500">
                        Post Comment
                    </a>
                </div>
            </form>
        </div>
</template>

<script>
import Header from "@/Pages/Header.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "show",
    components: {Header, Link},

    props: ['notePost'],

    created() {
        this.loadComments();
    },

    data() {
        return {
            comment: "",
            comments: [],
        };
    },
    methods: {
        loadComments() {
            axios.get(`/notes/${this.notePost.id}/comment`)
                .then(response => {
                    this.comments = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        storeComment(notePost) {
            axios
                .post(`/notes/${notePost.id}/comment`, {comment: this.comment})
                .then((res) => {
                    this.comment = "";
                    this.comments.unshift(res.data.data);
                    this.loadComments();
                })
                .catch((e) => {
                    this.errors = e.response.data.errors
                });
        },
        toggleLike(notePost) {
            axios.post(`/notes/${notePost.id}/toggle_like`)
                .then(res => {
                    notePost.is_liked = res.data.is_liked;
                    notePost.likes_count = res.data.likes_count;
                })
                .catch(error => {
                    console.error("Ошибка при обновлении лайка:", error);
                });
        },
    }
}

</script>

<style scoped>

</style>
