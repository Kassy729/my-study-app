<template>
  <v-row>
    <v-col cols="4" v-for="post in posts" :key="post.id">
      <v-card class="mx-auto" max-width="400">
        <v-card-title @click="onClickPost(post.id)">{{
          post.title
        }}</v-card-title>

        <v-card-text class="text--primary">
          작성자 : 게시일 : {{ post.created_at }}
        </v-card-text>

        <v-card-actions>
          <v-btn color="orange" text>
            Share
          </v-btn>

          <v-btn color="orange" text>
            Explore
          </v-btn>
        </v-card-actions>
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
