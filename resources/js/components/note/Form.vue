<template>
    <div class="container">
        <h2 class="text-center">ADD NOTE</h2>
        <h2 v-if="error" class="text-danger">Something went wrong</h2>
        <div class="form-group">
            <label for="title">Title</label>
            <input min="1" v-model="title" type="text" class="form-control" id="title" placeholder="title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea min="1" v-model="description" class="form-control" id="description" placeholder="title"></textarea>
        </div>
        <button @click="submitForm" type="submit" class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
  export default {
    props: ['noteableId', 'noteableType'],
    data() {
      return {
        title: '',
        description: '',
        error: false
      };
    },
    methods:{
      submitForm(){
        axios.post(`/api/notes`, {
          'title': this.title,
          'description': this.description,
          'noteableId': this.noteableId,
          'noteableType': this.noteableType
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
