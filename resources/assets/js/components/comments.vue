<template>   
<div>
    <div v-for="comment in comments">
        <comment :comment=comment></comment>
    </div>
    {{ ok }}
</div>

</template>

<script>

import card from './Autonomous/comment.vue';

export default {
    data(){
        return {
            comments: '',
            ok: ''
        }
    },

    props: [ 'post' ],

    mounted(){
        this.fetchComments();
    },

    methods: {
        fetchComments(){
            axios.get('/api/posts/' + this.post.id + '/comments').then(response => {
                this.comments = response.data.comments;
            });
        },
    },

}

</script>

