<template>
  <div>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <menu-table />
    <v-container>
      <v-img
        v-if="post.image"
        :src="`http://35.76.24.183:8000/storage/images/${post.image}`"
        style="width: 40rem;"
        class="card-img-top"
        alt="my post image"
      />

      <div class="mb-3">
        <label for="title" class="form-label">제목</label>
        <input
          type="text"
          class="form-control"
          name="title"
          v-model="post.title"
          readonly
          placeholder="제목"
        />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">내용</label>
        <textarea
          class="form-control"
          name="content"
          rows="10"
          v-model="post.content"
          readonly
          placeholder="내용"
        ></textarea>
      </div>

      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <v-row align="center">
            <v-col cols="auto">좋아요 : </v-col>
            <v-col><like-button :post="post" @clickLike="getPost"/></v-col>
            <v-col cols="10">X {{ post.likes.length }}</v-col>
          </v-row>
        </li>
        <li class="list-group-item">카테고리 : {{ post.category }}</li>
        <li class="list-group-item">등록일 : {{ post.created_at }}</li>
        <li class="list-group-item">작성자 : {{ post.user.name }}</li>
      </ul>
      <div>
        <v-btn tile color="success" @click="onClickUpdate(post.id)">
          <v-icon left>
            mdi-pencil
          </v-icon>
          Edit
        </v-btn>
        <v-btn
          depressed
          color="error"
          class="m-1"
          @click="onClickDelete(post.id)"
        >
          Delete
        </v-btn>
        <router-link to="/"><v-icon>mdi-home</v-icon></router-link>
      </div>
      <div class="m-3">
        <comment-index :post="post" />
        <!-- <comment-create :post="post" /> -->
      </div>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import MenuTable from "../components/menu.vue";
import CommentIndex from "../components/comment/commentIndex.vue";
import LikeButton from "../components/LikeButton.vue";

export default {
  components: {
    MenuTable,
    CommentIndex,
    LikeButton,
  },
  data() {
    return {
      post: [],
    };
  },
  mounted() {
    this.getPost();
  },
  methods: {
    getPost() {
      axios
        .get("http://35.76.24.183:8000/api/show/" + this.$route.params.postId)
        .then((res) => {
          this.post = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    onClickUpdate(id) {
      this.$router.push({ path: "/update/" + id });
    },
    onClickDelete() {
      if (confirm("Are you sure to delete")) {
        axios
          .delete("http://35.76.24.183:8000/api/" + this.$route.params.postId)
          .then(() => {
            this.$router.push({ path: "/" });
          })
          .catch((err) => {
            console.log(err);
            alert("실패");
          });
      }
    },
  },
};
</script>
