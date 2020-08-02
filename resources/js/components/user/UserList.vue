<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                       <span class="navbar-brand"><router-link :to="{ name: 'transactions' }">
                        Transactions
                    </router-link></span>
                    <span class="navbar-brand"><router-link :to="{ name: 'users' }">
                        Users
                    </router-link></span>
                </nav>

                <h2 class="text-center">Search</h2>
                <input v-model="search" type="text" v-on:keyup="getData" class="form-input col-12 m-2">
                <div class="card">
                    <div class="m-2">
                    <span class="h4">Users</span>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Transaction Count</th>
                            <th scope="col">Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users">
                            <td>
                                <router-link
                                        :to="{ name: 'userShow', 'params': {'userId':user.id} }">
                                    {{user.id}}
                                </router-link>
                            </td>
                            <td>{{user.name}}</td>
                            <td>{{user.transactionCount}}</td>
                            <td>{{user.balance/100}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
      return {
        users: [],
        search: ''
      };
    },
    mounted() {
      this.getData();
    },
    methods:{
      getData(){
        axios.get(`/api/users?search=${this.search}`).then((response) => {
          this.users = response.data;
        });
      },
    }
  }
</script>
