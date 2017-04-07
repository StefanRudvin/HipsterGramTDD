<template lang="html">
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                  <td>
                    <a :href="'/users/' + user.id">
                        {{ user.name }}
                    </a>
                  </td>
                  <td>
                    {{ user.email }}
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    data(){
        return {
            text: "Hi",
        }
    },
    props: [ 'user' ],

    mounted(){
        this.fetchPosts();
        this.fetchComments();
    },

    methods: {
        fetchPosts(){
            axios.get('/users' + this.user.id + '/posts').then(response => {
                this.posts = response.data.posts;
            });
        },
        fetchComments(){
            axios.get('/users' + this.user.id + '/comments').then(response => {
                this.comments = response.data.comments;
            });
        },
    }
}
</script>