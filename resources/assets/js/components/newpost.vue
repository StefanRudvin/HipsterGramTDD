<template> 
<div class="container">
    
    <form enctype="multipart/form-data">

        <h1>New Post</h1>

        <div class="form-group">

            <div v-if="!image">
                <h2>Select an image</h2>

                <input v-bind="image" type="file" @change="onFileChange" required>

            </div>
             <div v-else>
            <img :src="image" style="max-height: 400px" />
                <button @click="removeImage">Remove image</button>
            </div>
        </div>

        <div class="form-group">

            <h3>Title</h3>

            <input type="text" class="form-control" v-model="title" placeholder="Post Title" required/>

        </div>

        <div class="form-group">

            <h3>Content</h3>

            <textarea v-model="content" class="form-control" rows="12" required placeholder="Post Content"/>


        </div>

        <div class="form-group">

            <button type="submit" @submit.prevent="addPost()" class="btn btn-primary">
            Submit
            </button>

        </div>

        {{ title }}
        {{ content}}

    </form>

</div>

</template>

<script>

export default {

    data(){
        return {
            title: 'YEAH',
            content: 'YEAH',
            image: 'default.jpg',
            errors: [],
        }
        
    },

    methods: {

        addPost () {
            axios.post('/posts/', {
                title: this.title,
                content: this.content,
                image: this.image
            });
        },

        onFileChange(e) {
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
          this.createImage(files[0]);
        },
        createImage(file) {
          var image = new Image();
          var reader = new FileReader();
          var vm = this;

          reader.onload = (e) => {
            vm.image = e.target.result;
          };
          reader.readAsDataURL(file);
        },
        removeImage: function (e) {
          this.image = '';
        }
    }
    
}

</script>

<style type="text/css">

</style>

