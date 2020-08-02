<template>
    <div class="container">
        <h2 v-if="error" class="text-danger">Something went wrong</h2>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input min="1" v-model="amount" type="number" class="form-control" id="amount" aria-describedby="emailHelp" placeholder="amount">
        </div>
        <div class="form-group">
            <label for="amount">Type</label>
            <select :value="type" v-model="type" type="number" class="form-control" id="type" aria-describedby="emailHelp">
                <option :selected="type === 'debit'" value="debit">debit</option>
                <option :selected="type === 'credit'" value="credit">credit</option>
            </select>
        </div>
        <button @click="submitForm" type="submit" class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        role: '',
        amount: 0,
        type: '',
        error: false
      };
    },
    mounted() {
      if(this.$route.params.transactionId)
          this.getData();
    },
    methods:{
      getData(){
        axios.get(`/api/transaction/${this.$route.params.transactionId}`).then((response) => {
          this.amount = response.data.amount
          this.type = response.data.type
        });
      },
      submitForm(){
        const link = this.$route.params.transactionId?`/api/transaction/${this.$route.params.transactionId}`:`/api/transaction`
        axios.post(link, {
          'amount':this.amount,
          'type':this.type
        })
          .then((response) => {
            this.$router.push('/')
          })
          .catch((error) => {
            this.error = true;
          });
      }
    }
  }
</script>
