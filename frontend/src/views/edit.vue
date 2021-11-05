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
      <img
        :src="`http://localhost:8000/storage/images/${post.image}`"
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
        <li class="list-group-item">사용언어 : {{ post.category }}</li>
        <li class="list-group-item">등록일 : {{ post.created_at }}</li>
        <li class="list-group-item">작성자 : {{ post.user.name }}</li>
      </ul>

      <v-row align="center" justify="space-around">
        <v-btn tile color="success" class="m-2">
          <v-icon left>
            mdi-pencil
          </v-icon>
          Post
        </v-btn>
        <v-btn color="primary">
          돌아가기
        </v-btn>
        <!-- <router-link to="/show/{{ post.id }}">목록보기</router-link> -->
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import MenuTable from "../components/menu.vue";

export default {
  components: {
    MenuTable,
  },
  data() {
    return {
      post: [],
    };
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/show/" + this.$route.params.postId)
      .then((res) => {
        console.log(res.data);
        this.post = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
  methods: {
    imageTest(img) {
      if (!img) {
        return "noimage.jpg";
      } else {
        return img;
      }
    },
    onClickUpdate(id) {
      this.$router.push({ path: "/update/" + id });
    },
  },
};
</script>
