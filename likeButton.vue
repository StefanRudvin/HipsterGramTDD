<button
                                type="submit"
                                class="btn"
                                v-text="text"
                                v-bind:class="{ btnunlike: ! liked, btnlike: liked}"
                                v-on:click="toggleLike()"
                                v-attr:disabled="submitted">
                            </button>

                     // Likes Section

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

            this.$http.post('posts/like/', this.post.id, function(resp) {
                this.liked = true;
                this.submitted = false;
                this.text = 'Unlike';
            });
        },

        unlikePhoto: function() {
            this.submitted = true;

            this.$http.delete('posts/like/' + this.post.id, function(resp) {
                this.liked = false;
                this.submitted = false;
                this.text = 'Like';
            });
        }