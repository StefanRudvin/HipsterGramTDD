<template>   
<div>
    <div v-for="comment in comments">
        <comment :comment=comment :user=user></comment>
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

    props: [ 'post', 'user'],

    mounted(){
        this.fetchComments();
    },

    methods: {
        fetchComments(){
            axios.post('/api/posts/' + this.post.id + '/comments', {user_id: this.user.id}).then(response => {
                this.comments = response.data.comments;
            });
        },
    },

}

</script>

