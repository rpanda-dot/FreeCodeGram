<template>
  <div class="container">
    <button class="ml-3 btn btn-primary" @click="followUser()">Follow</button>
  </div>
</template>

<script>
export default {
  prods: ['user-id'],
  mounted() {
    console.log('Component mounted.')
  },
  methods: {
    followUser() {
      axios.post('/follow/' + this.user-id).then((response) => {
        alert(response.data)
      })
    },
  },
}
</script>
