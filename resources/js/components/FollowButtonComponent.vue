<template>
  <div class="container">
    <button
      class="ml-3 btn btn-primary"
      @click="followUser()"
      v-text="buttonText"
    ></button>
  </div>
</template>

<script>
export default {
  props: ['UserId', 'follows'],
  data: function () {
    return {
      status: this.follows,
    }
  },
  mounted() {
    console.log('Component mounted.')
  },
  methods: {
    followUser() {
      axios
        .post('/follow/' + this.UserId)
        .then((response) => {
          this.status = !this.status
          console.log(response.data)
        })
        .catch((errors) => {
          if(errors.response.status == 401){
            window.location = '/login';
          }
          // console.log(errors)
        })
    },
  },
  computed: {
    buttonText() {
      return this.status ? 'Unfollow' : 'Follow'
    },
  },
}
</script>
