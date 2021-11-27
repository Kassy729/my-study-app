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
    <form class="row gx-3 gy-2 align-items-center">
      <div class="col-sm-7">
        <input
          type="text"
          class="form-control"
          placeholder="Find a posts..."
          aria-label="City"
        />
      </div>
      <div class="col-sm-3">
        <label class="visually-hidden" for="specificSizeSelect"
          >Preference</label
        >
        <select class="form-select" id="specificSizeSelect">
          <option selected>All</option>
          <option value="1">Java</option>
          <option value="2">JavaScript</option>
          <option value="3">Laravel</option>
          <option value="3">Vue</option>
          <option value="3">React</option>
          <option value="3">Android</option>
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success">Search</button>
      </div>
    </form>
    <br />
    <hr />
    <ul class="list-group list-group-flush">
      <li class="list-group-item" v-for="post in posts.data" :key="post.id">
        <v-row>
          <v-col cols="10">
            <h4 @click="onClickPost(post.id)" style="color:#3F51B5">
              {{ post.title }}
            </h4>
            <v-col>
              <p>{{ post.category }}</p>
            </v-col>
          </v-col>
          <v-col>즐겨찾기</v-col>
        </v-row>
      </li>
    </ul>

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
// import LikeButton from "../components/LikeButton.vue";

export default {
  components: { Pagination },
  data: () => ({
    reveal: false,
    posts: [],
  }),
  mounted() {
    axios
      .get("/api/index")
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
