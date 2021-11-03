<template>
  <div>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">제목</th>
          <th scope="col">카테고리</th>
        </tr>
      </thead>
      <tbody v-for="post in posts" :key="post.id">
        <tr>
          <th scope="row">{{ post.id }}</th>
          <td @click="onClickPost(post.id)">{{ post.title }}</td>
          <td>{{ post.category }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: () => ({
    reveal: false,
    posts: [],
  }),
  mounted() {
    console.log("test");
    axios
      .get(`http://localhost:8000/api/index`)
      .then((res) => {
        this.posts = res.data;
        console.log(this.posts);
      })
      .catch((err) => {
        console.log(err);
      });
  },
  methods: {
    onClickPost(id) {
      this.$router.push({ path: "/show/" + id });
    },
  },
};
</script>

<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
</style>
