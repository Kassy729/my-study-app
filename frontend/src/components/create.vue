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
        chips
        hint="What are the target regions"
        persistent-hint
      ></v-select>
      <v-radio-group v-model="type" row>
        <v-radio label="Public" value="Public"></v-radio>
        <v-radio label="Private" value="Private"></v-radio>
      </v-radio-group>
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
    tag: "",
    type: "",
    states: ["Java", "JavaScript", "Laravel", "Vue", "React", "Android"],
    valid: true,
    title: "",
    content: "",

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
      form.append("user_id", this.$store.state.auth.user.user.id);
      form.append("type", this.type);
      axios
        .post("http://35.76.24.183:8000/api/store", form)
        .then(() => {
          window.location.href = "http://localhost:8080";
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
