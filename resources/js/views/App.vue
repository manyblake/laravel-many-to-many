<template>
    <div>
        {{ title }}

        <ul>
            <li v-for="post in posts" :key="post.id">
                {{ post.title }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "Bentornato JS",
        };
    },

    methods: {
        fetchPost() {
            axios.get("/api/posts").then((res) => {
                const { posts } = res.data;
                this.posts = posts;
            });
        },
    },

    beforeMount() {
        this.fetchPost();
    },
};
</script>

<style lang="scss" scoped></style>
