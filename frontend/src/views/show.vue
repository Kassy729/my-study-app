<template>
  <v-container>
    <h1>show</h1>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/show/" + this.$route.params.postId)
      .then((res) => {
        this.post = res.data;
        console.log(res.data);
      })
      .catch((err) => {
        console.log(err);
        alert("실패");
      });
  },
};
</script>
