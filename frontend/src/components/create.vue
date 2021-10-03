<template>
  <v-form
    ref="form"
    @submit.prevent="onsubmitForm"
    v-model="valid"
    lazy-validation
  >
    <v-card-text>
      <v-file-input
        :rules="rules"
        accept="image/png, image/jpeg, image/bmp"
        enctype="multipart/form-data"
        placeholder="Pick an avatar"
        prepend-icon="mdi-camera"
        label="File input"
        @change="selectFile"
      ></v-file-input>

      <v-text-field
        filled
        label="Title"
        value="My new post"
        v-model="title"
        :counter="10"
        :rules="nameRules"
        required
      ></v-text-field>

      <v-textarea
        filled
        v-model="content"
        label="Note"
        background-color="amber lighten-4"
      ></v-textarea>

      <v-divider class="my-2"></v-divider>

      <v-select
        v-model="tag"
        :items="states"
        label="Select"
        multiple
        chips
        hint="What are the target regions"
        persistent-hint
      ></v-select>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="success" depressed type="submit">
        Post
      </v-btn>
    </v-card-actions>
  </v-form>
</template>

<script>
import axios from "axios";

export default {
  data: () => ({
    tag: [],
    states: [
      "Java",
      "JavaScript",
      "Laravel",
      "Vue.js",
      "React",
      "Android",
      "Html",
    ],
    valid: true,
    title: "",
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
    ],
    content: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],

    rules: [
      (value) =>
        !value ||
        value.size < 2000000 ||
        "Avatar size should be less than 2 MB!",
    ],
  }),

  methods: {
    onsubmitForm() {
      const form = new FormData();
      form.append("title", this.title);
      form.append("content", this.content);
      form.append("tag", this.tag);
      form.append("image", this.image);
      axios
        .post("http://localhost:8000/api/store", form)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
          alert("실패");
        });
    },

    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },

    selectFile(file) {
      this.image = file;
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
