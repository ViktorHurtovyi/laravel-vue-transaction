<template>
    <nav v-if="role==='admin'" class="navbar navbar-expand-lg navbar-light bg-light">
                       <span class="navbar-brand"><router-link :to="{ name: 'transactions' }">
                        Transactions
                    </router-link></span>
        <span class="navbar-brand"><router-link :to="{ name: 'users' }">
                        Users
                    </router-link></span>
        <span class="navbar-brand"><router-link :to="{ name: 'transactionsCreate' }">
           Add Transaction
        </router-link></span>
    </nav>
</template>
<script>
  export default {
    data() {
      return {
        role: '',
      };
    },
    mounted() {
      axios.get('/api/get-user').then((response) => {
        this.role = response.data;
      });
    }
  }
</script>
