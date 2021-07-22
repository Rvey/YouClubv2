<template>
<div>
<modal v-if="modalOpen" 
:modalContent="modalContent"

/>
      <div>
    <form action="">
        <label for="image">
            <input type="file">
        </label>
        <label for="Post title">Post title</label>
        <input type="">
   <label for="Post title">Post content</label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
       <div>
         <button class="submit" type="submit">Submit</button>
         <button class="cancel" >cancel</button>
       </div>

    </form>
    </div> 
    </div>
</template>
<script>
import { ref } from "vue";
export default {
    name:"SubmitPostModal",
    setup(props , { emit }) {
        const close  = () => {
            return emit("close");
        }
        return {
            close
        }
     },
}
</script>