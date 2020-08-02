<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="card-header">Transactions</h2>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Last Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <router-link :to="{ name: 'transactionShow', 'params': {'transactionId':transaction.id} }">
                                    {{transaction.id}}
                                </router-link>
                            </td>
                            <td>{{user.name}}</td>
                            <td>{{transaction.amount/100}}</td>
                            <td>{{transaction.type}}</td>
                            <td>{{notes.title}}</td>
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
        role: '',
        transaction: [],
        user: {},
        notes: {}
      };
    },
    mounted() {
      this.getData();
    },
    methods:{
      getData(){
        axios.get(`/api/transaction/${this.$route.params.transactionId}`).then((response) => {
          this.transaction = response.data;
          this.user = response.data.user;
          this.notes = response.data.notes[0]?response.data.notes[0]:{}
        });
      },
    }
  }
</script>
