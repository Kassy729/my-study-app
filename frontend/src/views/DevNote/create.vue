<template>
  <v-container class="container">
    <h1>DevNote작성</h1>
    <v-form
      ref="form"
      @submit.prevent="onsubmitForm"
      v-model="valid"
      lazy-validation
    >
      <v-select
        v-model="select"
        :items="items"
        :rules="[(v) => !!v || 'Item is required']"
        label="Item"
        required
      ></v-select>

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
        v-model="title"
        :counter="10"
        :rules="nameRules"
        label="Title"
        required
      ></v-text-field>

      <v-textarea
        v-model="content"
        background-color="amber lighten-4"
        color="orange orange-darken-4"
        label="Note"
      ></v-textarea>

      <v-checkbox
        v-model="checkbox"
        :rules="[(v) => !!v || 'You must agree to continue!']"
        label="Do you agree?"
        required
      ></v-checkbox>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="validate"
        type="submit"
      >
        작성
      </v-btn>

      <v-btn color="error" class="mr-4" @click="reset">
        Reset Form
      </v-btn>

      <v-btn color="warning" @click="resetValidation">
        리셋
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  data: () => ({
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
    select: "",
    items: ["Java", "JavaScript", "laravel", "vue.js", "html"],
    checkbox: false,

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
      form.append("select", this.select);
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
