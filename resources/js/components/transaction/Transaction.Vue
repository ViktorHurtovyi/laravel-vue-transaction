<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <Nav />
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
                            <td>{{note.title}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center" v-for="note in notes">
                        <div>{{note.title}}</div>
                        <div>{{note.description}}</div>
                        <hr>
                    </div>
                    <NoteStore :noteable-id="transaction.id" noteable-type="transaction" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import NoteStore from '../note/Form'
  import Nav from "../nav/Nav";
  export default {
    components: {NoteStore, Nav},
    data() {
      return {
        role: '',
        transaction: [],
        user: {},
        note: {},
        notes: []
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
          this.notes = response.data.notes
          this.note = response.data.notes[0]?response.data.notes[0]:{};
        });
      },
    }
  }
</script>
