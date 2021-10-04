<template>
  <v-row>
    <v-col cols="10"><h3>최근 게시글</h3></v-col>
    <v-col cols="6" v-for="post in posts" :key="post.id">
      <v-card outlined class="mx-auto" max-width="400">
        <v-card-title @click="onClickPost(post.id)">{{
          post.title
        }}</v-card-title>

        <v-card-content>
          {{ post.category }}
        </v-card-content>
      </v-card>
    </v-col>
  </v-row>
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
      .get("http://localhost:8000/api/index")
      .then((res) => {
        this.posts = res.data;
      })
      .catch((err) => {
        console.log(err);
        alert("실패");
      });
  },
  methods: {
    onClickPost(id) {
      this.$router.push({ path: "/show/" + id });
    },
  },
};
</script>
