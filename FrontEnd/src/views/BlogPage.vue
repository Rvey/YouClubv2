<template>

    <Sidebar />
   <Mobile />

    <BlogPost/>
</template>
<script>
import Sidebar from "@/components/sidebar.vue";
import BlogPost from "@/components/blogPage.vue";
import Mobile from "@/components/mobilenav.vue"
export default {
    components:{
        BlogPost,
        Sidebar,
        Mobile
    },
    setup() {
        
    },
}
</script>