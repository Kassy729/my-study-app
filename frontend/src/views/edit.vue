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
      <v-form ref="form" @submit.prevent="onEditForm">
        <v-img
          v-if="post.image"
          :src="`http://localhost:8000/storage/images/${post.image}`"
          style="width: 40rem;"
          class="card-img-top"
          alt="my post image"
        />
        <div class="mb-3">
          <v-file-input
            enctype="multipart/form-data"
            placeholder="Pick an avatar"
            prepend-icon="mdi-camera"
            name="image"
            label="File input"
            @change="selectFile"
          ></v-file-input>
          <label for="title" class="form-label">제목</label>
          <input
            type="text"
            class="form-control"
            name="title"
            v-model="post.title"
            placeholder="제목"
          />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label"
            >내용</label
          >
          <textarea
            class="form-control"
            name="content"
            rows="10"
            v-model="post.content"
            placeholder="내용"
          ></textarea>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">사용언어 : {{ post.category }}</li>
          <li class="list-group-item">등록일 : {{ post.created_at }}</li>
          <!-- <li class="list-group-item">작성자 : {{ post.user.name }}</li> -->
        </ul>
        <v-radio-group v-model="type" row>
          <v-radio label="Public" value="Public"></v-radio>
          <v-radio label="Private" value="Private"></v-radio>
        </v-radio-group>

        <v-row align="center" justify="space-around">
          <v-btn tile color="success" class="m-2" type="submit">
            <v-icon left>
              mdi-pencil
            </v-icon>
            Post
          </v-btn>

          <router-link :to="`/show/${post.id}`">돌아가기</router-link>
        </v-row>
      </v-form>
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
      image: "",
      type: "",
    };
  },
  mounted() {
    axios
      .get("http://18.181.162.146:8000/api/show/" + this.$route.params.postId)
      .then((res) => {
        console.log(res.data);
        this.post = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
  methods: {
    onEditForm() {
      const form = new FormData();
      form.append("title", this.post.title);
      form.append("content", this.post.content);
      form.append("image", this.image);
      form.append("type", this.type);
      axios
        .post(
          "http://18.181.162.146:8000/api/update/" + this.$route.params.postId,
          form
        )
        .then(() => {
          window.location.href =
            "http://localhost:8080/show/" + this.$route.params.postId;
        })
        .catch((err) => {
          console.log(err);
        });
    },
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
    selectFile(file) {
      this.image = file;
    },
  },
};
</script>
