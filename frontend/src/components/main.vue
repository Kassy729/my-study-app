<template>
  <div>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <v-row>
      <v-card
        class="mb-2 mr-3 ml-5"
        max-width="344"
        m-2
        outlined
        v-for="post in posts.data"
        :key="post.id"
      >
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-title
              @click="onClickPost(post.id)"
              class="text-h7 mb-4 font-weight: $bold"
              style="color:#3F51B5"
            >
              {{ post.title }}
            </v-list-item-title>
            <v-list-item-subtitle>{{ post.category }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-card>
    </v-row>
    <div class="m-5">
      <img src="https://ghchart.rshah.org/Kassy729" />
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
    };
  },
  methods: {
    onClickPost(id) {
      this.$router.push({ path: "/show/" + id });
    },
  },
  mounted() {
    console.log("/api/main");
    axios
      .get("http://18.181.162.146:8000/api/main")
      .then((res) => {
        console.log("t");
        console.log(res.data);
        this.posts = res.data;
      })
      .catch((err) => {
        console.log("tt");
        console.log(err);
      });
  },
};
</script>
