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
                            <th scope="col">Transaction Count</th>
                            <th scope="col">Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <router-link :to="{ name: 'userShow', 'params': {'userId':user.id} }">
                                    {{user.id}}
                                </router-link>
                            </td>
                            <td>{{user.name}}</td>
                            <td>{{user.transactionCount}}</td>
                            <td>{{user.balance/100}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center" v-for="note in notes">
                        <div>{{note.title}}</div>
                        <div>{{note.description}}</div>
                        <hr>
                    </div>
                    <NoteStore :noteable-id="user.id" noteable-type="user" />
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
        user: {},
        note: {},
        notes: [],
      };
    },
    mounted() {
      this.getData();
    },
    methods:{
      getData(){
        axios.get(`/api/user/${this.$route.params.userId}`).then((response) => {
          this.user = response.data;
          this.notes = response.data.notes
          this.note = response.data.notes[0]?response.data.notes[0]:{};
        });
      },
    }
  }
</script>
