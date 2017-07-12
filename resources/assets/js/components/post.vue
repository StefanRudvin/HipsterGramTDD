<template>

<div class="container-fluid">
    <div class="flex-row row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 card">
            <div class="card-block">
                <div class="thumbnail">
                    <img v-bind:src="'/uploads/images/' + thispost.image" v-on:click="like()">
                    <div class="caption">
                        <h3>
                            <a :href="'/posts/' + thispost.id">{{ post.title }}</a>
                            
                            <div class="pull-left">
                                <img v-bind:src="'/uploads/avatars/' + thispost.userImg" style="width: 50px; height: 50px; top: 5px; left: 10px; border-radius: 50%;">
                            </div>
                            <small>
                               Created by <a :href="'/users/' + thispost.user_id">{{ thispost.owner }} </a>{{ thispost.time }} score {{ thispost.score }}
                            </small>

                        </h3>
                        <hr>        
                        <p>
                            {{ thispost.content }}
                        </p>

                        <div v-if="liked">
                        <button v-on:click="like()" class="heart pull-left glyphicon glyphicon-heart"/>
                        </div>
                        <div v-else>
                            <button v-on:click="like()" class="heart pull-left glyphicon glyphicon-heart-empty"/>
                        </div>

                        <div class="pull-right">
                            {{ thispost.score }}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="flex-row row">
        <div class="container bootstrap snippet">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-comment">
                        <input type="text" v-model="postBody" @change="postPost()"/>
                          <ul v-if="errors && errors.length">
                            <li v-for="error of errors">
                              {{error.message}}
                            </li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>

</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
      postBody: '',
      errors: [],
      liked: false,
      thispost: ''
    }),

    props: [ 'post'],

    mounted(){
        this.fetchPost();
    },

    methods: {
       
        // Pushes posts to the server when called.
        postPost() {
            axios.post(`http://jsonplaceholder.typicode.com/posts`, {
                content: this.postBody
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });

        },

        fetchPost(){
            axios.get('/api/posts/' + this.post.id).then(response => {
                this.thispost = response.data.post;
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });
        },

        isliked(){
            axios.get('/api/posts/' + this.post.id + '/isliked').then(response => {
                this.liked = response.data.liked;
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });
        },

        like(){
            axios.get('/api/posts/' + this.thispost.id + '/like').then(response => {
                this.thispost.score = response.data.post.score;
                this.isliked();
            })
            .then(response => {})
            .then()
            .catch(e => {
                this.errors.push(e)
        });
        }
  }
}
</script>



<style type="text/css">

.heart:hover {
    border: none;
    background-color: none;
    color: #00adee;
    margin: 0;
}

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


.card .thumbnail .caption hr{
    border-top: 1px solid #333;
    margin: 20px 40px;
}

.card .thumbnail .caption p{
    font-size: 12px;
    line-height: 1.6;
}



</style>