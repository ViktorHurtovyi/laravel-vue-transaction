<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <Nav />
                <h2 class="text-center">Search</h2>
                <input v-model="search" type="text" v-on:keyup="getData" class="form-input col-12 m-2">
                <div class="card">
                    <div class="m-2">
                        <span class="h4">Transactions</span>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Last Note Title</th>
                            <th v-if="role==='admin'" scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transaction in transactions">
                            <td>
                                <router-link
                                        :to="{ name: 'transactionShow', 'params': {'transactionId':transaction.id} }">
                                    {{transaction.id}}
                                </router-link>
                            </td>
                            <td>{{transaction.userName}}</td>
                            <td>{{transaction.amount/100}}</td>
                            <td>{{transaction.type}}</td>
                            <td>{{transaction.lastNoteTitle}}</td>
                            <td v-if="role==='admin'">
                                <router-link
                                        :to="{ name: 'transactionEdit', 'params': {'transactionId':transaction.id} }">
                                    <button class="btn-short btn-primary">Edit</button>
                                </router-link>
                                <button @click="deleteTransaction(transaction.id)" class="btn-short btn-primary">Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  import Nav from "../nav/Nav";

  export default {
    components: {Nav},
    data() {
      return {
        transactions: [],
        search: '',
        role: ''
      };
    },
    mounted() {
      this.getData();
      this.getRole();
    },
    methods: {
      getData() {
        axios.get(`/api/transaction?search=${this.search}`).then((response) => {
          this.transactions = response.data;
        });
      },
      getRole() {
        axios.get('/api/get-user').then((response) => {
          this.role = response.data;
        });
      },
      deleteTransaction(id) {
        axios.delete(`/api/transaction/delete/${id}`).then((response) => {
          this.getData();
        });
      },
    }
  }
</script>
