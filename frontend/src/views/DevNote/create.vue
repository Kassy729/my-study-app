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
        label="File input"
        filled
        prepend-icon="mdi-camera"
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
        Validate
      </v-btn>

      <v-btn color="error" class="mr-4" @click="reset">
        Reset Form
      </v-btn>

      <v-btn color="warning" @click="resetValidation">
        Reset Validation
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
    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"],
    checkbox: false,
  }),

  methods: {
    onsubmitForm() {
      console.log("test");
      const form = new FormData();
      form.append("title", this.title);
      form.append("content", this.content);
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
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
