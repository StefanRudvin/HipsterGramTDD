<template>   
<div>
    <div v-for="comment in comments">
        <comment :comment=comment :user=user></comment>
    </div>

    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-comment">
                    <ul class="comments">
                        <li class="clearfix">
                            <img v-bind:src="'/uploads/avatars/' + user.avatar" class="avatar">

                            <div class="post-comments">
                                <p class="meta">
                                    <a :href="'/users/' + user.id">
                                        {{ user.name }}
                                    </a>
                                    says :
                                    <i class="pull-right">
                                        <small>
                                            now
                                        </small>
                                    </i>
                                </p>

                                <p>
                                    <textarea v-model="content" class="new-comment-textbox"
                                              placeholder="New Comment..."></textarea>
                                    <!--{{ reactiveComment.content }}-->
                                </p>

                                <div class="new-comment-button">
                                    <button class="button btn-primary" @click="postComment">Submit</button>
                                </div>

                                <!--<div v-if="reactiveComment.liked">
                                    <div class="glyphicon glyphicon-heart"/>
                                </div>
                                <div v-else>
                                    <div class="glyphicon glyphicon-heart-empty"></div>
                                </div>-->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>

import card from './Autonomous/comment.vue';

export default {
    data(){
        return {
            comments: '',
            ok: '',
            content: ''
        }
    },

    props: [ 'post', 'user'],

    mounted(){
        this.fetchComments();
    },

    methods: {
        fetchComments(){
            console.log(this.post)
            axios.post('/api/posts/' + this.post.id + '/comments', {user_id: this.user.id}).then(response => {
                this.comments = response.data.comments;
            });
        },

        postComment () {
            let fm = new FormData()

            fm.append('content', this.content)
            fm.append('user_id', this.user.id)
            fm.append('post_id', this.post.id)

            axios.post('/api/comments/', fm).then(response => {
                this.content = '';
                this.fetchComments();
            })
                .then(response => {})
                .catch(e => {
                    this.errors.push(e)
                })
        },
    },

}

</script>

