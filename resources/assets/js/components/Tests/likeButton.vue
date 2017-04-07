<template>
    <button>Like</button>
</template>

<!--

    type="submit"
    class="btn"
    v-text="text"
    v-class="btn-unlike: ! liked, btn-like: liked"
    v-on="click: toggleLike"
    v-attr="disabled: submitted"
    -->

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
        	return {
        		message : 'Hello world'
        	};
        },

        toggleLike: function()
        {
            if(this.liked) {
                this.unlikePhoto()
            } else {
                this.likePhoto()
            }
        },

        likePhoto: function() {
            this.submitted = true;

            this.$http.post('/posts/like', {'post': this.post}, function(resp) {
                this.liked = true;
                this.submitted = false;
                this.text = 'Unlike';
            });
        },

        unlikePhoto: function() {
            this.submitted = true;

            this.$http.delete('/posts/like' + this.post, function(resp) {
                this.liked = false;
                this.submitted = false;
                this.text = 'Like';
            });
        }
    }

</script>

</style>