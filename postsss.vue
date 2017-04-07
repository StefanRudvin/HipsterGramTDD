<template>   
<div class="container-fluid">
    <div class="flex-row row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 card">
            <div class="card-block">
                <div class="thumbnail">
                    <img v-bind:src="'/uploads/images/' + post.image">
                    <div class="caption">
                        <h3>
                            {{ post.title }}
                            <div class="pull-left">
                                <img v-bind:src="'/uploads/avatars/' + post.userImg" style="width: 50px; height: 50px; top: 5px; left: 10px; border-radius: 50%;">
                            </div>
                            <small>
                               Created by <a :href="'/users/' + post.user_id">{{ post.owner }} </a>{{ post.time }} score {{ post.score }}
                            </small>

                        </h3>
                        <hr>        
                        <p>
                            {{ post.content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-row row" v-for="commentz in comments">
        <comment :comment=commentz ></comment>
    </div>

    <div class="flex-row row">
        <div class="container bootstrap snippet">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-comment">
                        <form v-on:submit.prevent="createComment()" method="post" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.comment}">
                                <label>Comment:</label>
                                <input type="text" v-model="comment.content" class="form-control">
                                <span class="help-block" v-for="error in errors.comment">{{ error }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">New Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</template>

<script>

import comment from './comment.vue';

    export default {
        data(){
            return {
                errors: [],
                comment:{
                    content:''
                },
                postBody: ''

            }
        },
        props: [ 'post', 'comments' ],

        mounted(){
            this.fetchPost();
        },

        methods: {

            createComment() {
                axios.post('/comments/', {
                    content: this.comment.content,
                  })
                  .then(function (response) {

                    this.comments.push(response.data);
                    this.comment = {content: ''};

                    console.log(response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            },

            fetchPost(){

                axios.get('/post' + this.post.id).then(response => {
                    this.post = response.data.post;
                });
            },
        },
    }

</script>

<style type="text/css">
.row{
    padding-top: 10px;
}

.flex-row {
    display: flex;
    flex-wrap: wrap;
}

.max-lines {
  display: block; /* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 14.4em;
  line-height: 7.2em;
}

/* cards */

.card *:hover{
    text-decoration: none;
}

.card .thumbnail{
    padding: 0;
    border: none;
    text-align: center;
    border-radius: 0;
    -webkit-box-shadow: 0px 0.5px 1px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0.5px 1px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0.5px 1px 0px rgba(0,0,0,0.75);
}

.card .thumbnail .caption{
    margin: -20px 20px 20px 20px;
    padding: 19px 29px 19px 29px;
    position: relative;
    background-color: white;
}

.card .thumbnail .caption h3 small{
    font-style: italic;
    text-transform: none;
    letter-spacing: 0;
    font-weight: 400;
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
    display: block;
    padding: 5px;
}

.card .thumbnail .caption h3{
    font-family: 'Raleway',sans-serif; 
    font-weight: 600;
    letter-spacing: -1px;
    margin-top: 0;
    text-transform: uppercase;
    font-size: 18px;
}

.card .thumbnail .caption hr{
    border-top: 1px solid #333;
    margin: 20px 40px;
}

.card .thumbnail .caption p{
    font-size: 12px;
    line-height: 1.6;
}

.card .thumbnail .caption button{
    border-radius: 0;
    color: #aaa;
    -moz-transition: 0.3s;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}

.card .thumbnail .caption button:hover{
    background-color: black;
    border-color: black;
    color: white;
    -moz-transition: 0.3s;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}

</style>

