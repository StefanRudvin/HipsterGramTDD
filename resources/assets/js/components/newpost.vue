<template>
    <div class="container-fluid">
        <div class="flex-row row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 card">
                <div class="card-block">
                    <div class="thumbnail">
                        <img v-if="image != ''" v-bind:src="image">

                        <div class="caption">
                            <h1>New Post</h1>

                            <div class="form-group">
                                <div v-if="!image">
                                    <h3>Select an image</h3>
                                    <input v-bind="image" type="file" @change="onFileChange" required>
                                </div>
                            </div>

                            <div class="form-group">

                                <h3>Title</h3>

                                <input type="text" class="form-control" v-model="title" placeholder="Post Title"
                                       required/>

                            </div>

                            <div class="form-group">
                                <h3>Content</h3>
                                <textarea v-model="content" class="form-control" rows="5" required
                                          placeholder="Post Content"/>

                            </div>

                            <div class="form-group">
                                <button type="submit" v-on:click="addPost()" class="white-button btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data () {
            return {
                title: '',
                content: '',
                image: '',
                errors: [],
            }

        },

        props: ['user'],

        methods: {

            addPost () {
                let fm = new FormData()

                fm.append('title', this.title)
                fm.append('content', this.content)
                fm.append('image', this.image)
                fm.append('user_id', this.user.id)

                console.log('adding post..')

                axios.post('/api/posts/', {
                    image: this.image,
                    title: this.title,
                    content: this.content,
                    user_id: this.user.id
                }).then(response => {
                    window.location.href = '/posts/' + response.data.id;
                })
                    .then(response => {})
                    .catch(e => {
                        this.errors.push(e)
                    })
            },

            onFileChange (e) {
                let files = e.target.files || e.dataTransfer.files
                if (!files.length)
                    return
                this.createImage(files[0])
            },

            createImage (file) {
                let reader = new FileReader()
                let vm = this
                reader.onload = (e) => {
                    vm.image = e.target.result
                }
                reader.readAsDataURL(file)
            },

            removeImage: function (e) {
                this.image = ''
            }
        }

    }

</script>

<style type="text/css">

</style>

