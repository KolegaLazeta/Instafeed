<template>
    <button class="btn btn-mini" @click="likePost" v-text="buttonText"></button>
</template>

<script>
export default {

    props: ['UserId', 'post', 'likes'],

    mounted() {
            console.log(this.likes)
    },
    data: function(){
        return {
        status: this.likes
        }
    },

    methods: {
        likePost(){

                axios.post('/like/'+ this.post);
                
            this.status = !this.status;
        } 
    },
    computed: {
            buttonText() {
                return (this.status) ? "Dislike" : 'Like';
            }
        }
}
</script>