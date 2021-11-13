<template>
  <div>
    <link
      href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css"
      rel="stylesheet"
    />
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
      <tbody v-for="post in posts.data" :key="post.id">
        <tr>
          <th scope="row">{{ post.id }}</th>
          <td @click="onClickPost(post.id)">{{ post.title }}</td>
          <td>{{ post.category }}</td>
        </tr>
      </tbody>
    </table>
    <div>
      <pagination
        @pageClicked="getPage"
        v-if="posts.links != null"
        :links="posts.links"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Pagination from "./Pagination.vue";

export default {
  components: { Pagination },
  data: () => ({
    reveal: false,
    posts: [],
  }),
  mounted() {
    axios
      .get(`/api/index`)
      .then((res) => {
        this.posts = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
  methods: {
    onClickPost(id) {
      this.$router.push({ path: "/show/" + id });
    },
    getPage(url) {
      axios
        .get(url)
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
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
