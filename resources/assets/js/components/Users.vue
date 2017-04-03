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
                <tr v-for="user in users">
                  <td>
                    {{ user.name }}
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
            users: [
            {
              name:"HOHOH",
              email:"HAHA.com"
            }
            ]
        }
    },

    mounted(){
        this.fetchUsers();
    },

    methods: {
        fetchUsers(){
            axios.get('/users').then(response => {
                this.users = response.data.users;
            });
        },
    }
}
</script>