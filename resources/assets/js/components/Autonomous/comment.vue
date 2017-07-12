<template>   
<div class="container bootstrap snippet" v-if="show">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-comment">
                <ul class="comments">
                    <li class="clearfix">

                        <img v-bind:src="'/uploads/avatars/' + comment.img" class="avatar">
                      
                        <div class="post-comments" v-on:click="like()">
                            <p class="meta">
                                <a :href="'/users/' + comment.user_id">
                                    {{ comment.owner }}
                                </a>
                                says :
                                <i class="pull-right">
                                    <small>
                                        {{ comment.time}}
                                    </small>
                                </i>
                            </p>  

                            <p>
                                {{ comment.content }}
                            </p>

                            <div class="pull-right">
                                {{ thiscomment.score }}
                            </div>

                            <div v-if="liked">
                                <div class="glyphicon glyphicon-heart"/></div>
                                <div v-else>
                                    <div class="glyphicon glyphicon-heart-empty"></div>
                                </div>
                            </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>

export default {

    data(){
        return {
            thiscomment: this.comment,
            errors: [],
            liked: false,
            show:true,
        }
    },

    mounted(){
        this.isliked();
    },

    props: [ 'comment' ],

    methods: {

        del() {
            this.show = false;
        },

        isliked(){
            axios.get('/api/comments/' + this.comment.id + '/isliked').then(response => {
                this.liked = response.data.liked;
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });
        },

        like(){
            axios.get('/api/comments/'+ this.comment.id + '/like').then(response => {
                this.thiscomment.score = response.data.comment.score;
                this.liked = response.data.comment.liked;
            })
            .then(response => {})
            .then()
            .catch(e => {
                this.errors.push(e)
        });
        }

    },

}

</script>

<style type="text/css">

body{
    background:#eee;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #FFFFFF;
}
a {
    color: #82b440;
    text-decoration: none;
}
.blog-comment::before,
.blog-comment::after,
.blog-comment-form::before,
.blog-comment-form::after{
    content: "";
    display: table;
    clear: both;
}

.blog-comment{
    padding-left: 15%;
    padding-right: 15%;
}

.blog-comment ul{
    list-style-type: none;
    padding: 0;
}

.blog-comment img{
    opacity: 1;
    filter: Alpha(opacity=100);
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
         -o-border-radius: 4px;
            border-radius: 4px;
}

.blog-comment img.avatar {
    position: relative;
    float: left;
    margin-left: 0;
    margin-top: 0;
    width: 65px;
    height: 65px;
}

.blog-comment .post-comments{
    border: 1px solid #eee;
    margin-bottom: 20px;
    margin-left: 85px;
    margin-right: 0px;
    padding: 10px 20px;
    position: relative;
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
         -o-border-radius: 4px;
            border-radius: 4px;
    background: #fff;
    color: #6b6e80;
    position: relative;
}

.blog-comment .meta {
    font-size: 13px;
    color: #aaaaaa;
    padding-bottom: 8px;
    margin-bottom: 10px !important;
    border-bottom: 1px solid #eee;
}

.blog-comment ul.comments ul{
    list-style-type: none;
    padding: 0;
    margin-left: 85px;
}

.blog-comment-form{
    padding-left: 15%;
    padding-right: 15%;
    padding-top: 40px;
}

.blog-comment h3,
.blog-comment-form h3{
    margin-bottom: 40px;
    font-size: 26px;
    line-height: 30px;
    font-weight: 800;
}



</style>

