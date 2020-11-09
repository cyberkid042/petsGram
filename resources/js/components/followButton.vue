<template>
  <div>
    <a class="btn btn-primary text-light" @click="followUser" v-text="buttonText">follow</a>
  </div>
</template>

<script>
export default {
  props: ["userId", "follows"],

  mounted() {
    console.log("Component mounted.");
  },

  data: function() {
    return {
      status: this.follows
    };
  },

  methods: {
    followUser() {
      axios
        .post("/follow/" + this.userId)
        .then(response => {
          this.status = !this.status;
        })
        .catch(errors => {
          if (erros.response.status == 401) {
            window.location = "/login";
          }
        });
    }
  },

  computed: {
    buttonText() {
      return this.status ? "unfollow" : "follow";
    }
  }
};
</script>