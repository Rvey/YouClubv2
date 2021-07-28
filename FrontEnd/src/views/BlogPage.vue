<template>

    <Sidebar />
    <BlogPost/>
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import BlogPost from "@/components/blogPage.vue";
export default {
    components:{
        BlogPost,
        Sidebar
    },
    setup() {
        
    },
}
</script>