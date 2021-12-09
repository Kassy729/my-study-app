<template>
  <v-container fluid>
    <v-row v-if="this.user.image == null">
      <v-img
        class="profileImg"
        max-height="270"
        max-width="270"
        :src="`http://placehold.it/150x150`"
      ></v-img>
    </v-row>
    <v-row v-else>
      <v-img
        class="profileImg"
        max-height="270"
        max-width="270"
        :src="`http://18.181.162.146:8000/storage/images/${user.image}`"
      ></v-img>
    </v-row>

    <v-row v-if="this.$store.state.auth.user == null">
      <h1>비로그인</h1>
    </v-row>

    <v-row v-else>
      <!-- <h4 style="color:#2c2c2c">{{ user.name }}</h4> -->
      <h4 style="color:#2c2c2c">{{ user.name }}</h4>
    </v-row>

    <v-row v-if="this.$store.state.auth.user == null"> </v-row>

    <v-row v-else>
      <v-btn class="ma-2" outlined color="black" @click="edit = true">
        Edit Profile
      </v-btn>
    </v-row>
    <v-container v-if="edit">
      <!-- <v-row>
        <v-col><component v-bind:is="selectedComponent"> </component> </v-col>
      </v-row> -->
      <div>
        <v-row>
          <v-col>
            <v-form ref="form" @submit.prevent="onsubmitForm">
              <label for="exampleFormControlInput1" class="form-label"
                >ProfileImage</label
              >
              <v-file-input
                accept="image/png, image/jpeg, image/bmp"
                enctype="multipart/form-data"
                prepend-icon="mdi-camera"
                label="File input"
                @change="selectFile"
              ></v-file-input>

              <button type="submit" class="btn btn-success mr-3">Save</button>
              <button
                type="button"
                class="btn btn-secondary"
                @click="edit = false"
              >
                Cancel
              </button>
            </v-form>
          </v-col>
        </v-row>
      </div>
    </v-container>

    <v-row>
      <p><v-icon large color="black"> mdi-account-multiple </v-icon>follower</p>
      <br />
      <p>
        <v-icon large color="black"> mdi-account-multiple </v-icon>following
      </p>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user: [],
      selectedComponent: "",
      name: "",
      edit: false,
    };
  },

  computed: {
    userName() {
      return this.$store.state.auth.user.user.name;
    },
    userId() {
      return this.$store.state.auth.user.user.id;
    },
  },
  mounted() {
    this.getProfileImage();
    console.log(this.user.name);
    console.log("tttt");
  },
  methods: {
    getProfileImage() {
      if (this.$store.state.auth.user == null) {
        return;
      }
      const form = new FormData();
      form.append("userId", this.userId);
      axios
        .post("http://18.181.162.146:8000/api/getProfile", form)
        .then((res) => {
          this.user = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    onsubmitForm() {
      const form = new FormData();
      form.append("userId", this.userId);
      form.append("image", this.image);
      axios
        .post("http://18.181.162.146:8000/api/editProfile", form)
        .then((res) => {
          console.log(res.data);
          this.getProfileImage();
          this.edit = false;
        })
        .catch((err) => {
          console.log(err);
          alert("실패");
        });
    },
    selectFile(file) {
      this.image = file;
    },
  },
};
</script>
