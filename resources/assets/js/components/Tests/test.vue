<template> 
<div class="container">
    

    <div class="form-group">

        <p> The counter has been clicked {{ counter }} times.</p>

        <button v-on:click="counter += 1" class="btn btn-primary">
        Add counter
        </button>

    </div>

    <div class="form-group">

        <button v-on:click="addPost()" class="btn btn-primary">
        Add Post
        </button>

    </div>

    

</div>

</template>

<script>

export default {

    data(){
        return {
            title: 'okasdsadsadadad',
            content: 'oksadasddsaasdsadas',
            image: 'default.jpg',
            errors: [],
            counter: 0,
        }
        
    },

    methods: {

        addClick() {
            this.counter += 1;
        },

        addPost() {


            axios.post('/posts/', {
                title: this.title,
                content: this.content,
                image: this.image
            });


        }
    }
    
}

</script>

<style type="text/css">

</style>

