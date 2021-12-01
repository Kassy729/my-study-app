<template>
  <v-container fluid>
    <v-row v-if="this.user.image == null">
      <v-img
        class="profileImg"
        max-height="270"
        max-width="270"
        :src="`http://localhost:8000/storage/images/baseicon.png`"
      ></v-img>
    </v-row>
    <v-row v-else>
      <v-img
        class="profileImg"
        max-height="270"
        max-width="270"
        :src="`http://localhost:8000/storage/images/${user.image}`"
      ></v-img>
    </v-row>

    <v-row v-if="this.$store.state.auth.user == null">
      <h1>비로그인</h1>
    </v-row>

    <v-row v-else>
      <h1>{{ userName }}</h1>
    </v-row>

    <v-row>
      <v-btn class="ma-2" outlined color="black" @click="edit">
        Edit Profile
      </v-btn>
    </v-row>

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
  },
  methods: {
    getProfileImage() {
      if (this.$store.state.auth.user == null) {
        return;
      }
      const form = new FormData();
      form.append("userId", this.userId);
      axios
        .post("/api/getProfile", form)
        .then((res) => {
          this.user = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    edit() {
      this.$router.push({ path: "/editProfile" });
    },
  },
};
</script>
