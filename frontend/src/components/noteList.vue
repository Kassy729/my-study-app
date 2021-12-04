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
    <v-row>
      <form class="row gx-3 gy-2 align-items-center" @submit.prevent="getPosts">
        <div class="col-sm-7 ">
          <input
            type="text"
            class="form-control"
            v-model="keyword"
            placeholder="Find a posts..."
            aria-label="City"
          />
        </div>
        <div class="col-auto v-50">
          <select class="form-select" id="specificSizeSelect" v-model="tag">
            <option value="All" selected>All</option>
            <option value="Java">Java</option>
            <option value="JavaScript">JavaScript</option>
            <option value="Laravel">Laravel</option>
            <option value="Vue">Vue</option>
            <option value="React">React</option>
            <option value="Android">Android</option>
          </select>
        </div>
        <div class="col-auto">
          <select
            class="form-select w-20"
            id="specificSizeSelect"
            v-model="type"
          >
            <option value="All" selected>All</option>
            <option value="Public" selected>Public</option>
            <option value="Private">Private</option>
          </select>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-success">Search</button>
        </div>
      </form>
    </v-row>
    <br />
    <hr />
    <ul class="list-group list-group-flush">
      <li class="list-group-item" v-for="post in posts.data" :key="post.id">
        <v-row>
          <v-col cols="10">
            <h5 @click="onClickPost(post.id)" style="color:#3F51B5">
              {{ post.title }}
            </h5>
            <v-col>
              <p>{{ post.category }}</p>
            </v-col>
          </v-col>
          <v-col>
            <v-chip class="ma-2" outlined pill>
              {{ post.type }}
            </v-chip>
          </v-col>
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

export default {
  components: { Pagination },
  data: () => ({
    reveal: false,
    posts: [],
    keyword: "",
    tag: "All",
    type: "All",
  }),

  mounted() {
    this.getPosts();
  },

  methods: {
    onClickPost(id) {
      this.$router.push({ path: "/show/" + id });
    },
    getPage(url) {
      axios
        .post(url)
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPosts() {
      const form = new FormData();
      form.append("keyword", this.keyword);
      form.append("tag", this.tag);
      // form.append("type", this.type);
      axios
        .post("/api/index", form)
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
