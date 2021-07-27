<template>
<div class="body">

    <h1>Dashoard</h1>

    <div class="dashboard">
    <Stats />
    <Profile />
    </div>

</div>
</template>
<script>
import Stats from '@/components/Cards/statsCard.vue';
import Profile from '@/components/profile.vue';
export default {
    components:{
        Stats, 
        Profile
    },
    setup() {
        
    },
}
</script>