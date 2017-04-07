<template>   
    <div class="card-block hover01">
        <a :href="'/posts/' + post.id">
        <div class="thumbnail">
            <img class="card-image" v-bind:src="'/uploads/images/' + post.image" style="max-height: 20em;">
            <div class="caption">
                <h3>
                    {{ post.title }}
                    <small>
                       By {{ owner }} {{ time }} ago
                    </small>
                </h3>
                <hr>        
                <p class="max-lines">
                    {{ post.content}}
                </p>
                <button class="btn btn-default" role="button">View More</button>
            </div>
        </div>
        </a>
    </div>
</div>

</template>

<script>

export default {
    data(){
        return {
            owner:'',
            time: '',
            errors: [],
        }
    },

    props: [ 'post' ],

    mounted(){
        this.fetchOwner();
        this.fetchTime();
    },

    methods: {
        fetchOwner(){
            axios.get('/users/' + this.post.user_id).then(response => {
                this.owner = response.data.user.name;
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });
        },

        fetchTime(){
            axios.get('/posts/' + this.post.id).then(response => {
                this.time = response.data.post.time;
            })
            .then(response => {})
            .catch(e => {
                this.errors.push(e)
        });
        },

    },
    

}

</script>

<style type="text/css">
.row{
    padding-top: 10px;
}

.hover01 img {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transition: .15s ease-in-out;
    transition: .15s ease-in-out;
}
.hover01 img:hover {
    -webkit-transform: scale(1.05);
    transform: scale(1.05);
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

