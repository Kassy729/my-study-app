<template>
  <v-container fluid>
    <v-row>
      <v-img
        class="profileImg"
        max-height="270"
        max-width="270"
        src="https://picsum.photos/id/11/500/300"
      ></v-img>
    </v-row>

    <v-row v-if="this.$store.state.auth.user == null">
      <h1>비로그인</h1>
    </v-row>

    <v-row v-else>
      <h1>{{ userName }}</h1>
    </v-row>

    <v-row>
      <v-btn class="ma-2" outlined color="black">
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
    return {};
  },
  computed: {
    userName() {
      return this.$store.state.auth.user.user.name;
    },
  },
  mounted() {
    axios
      .get(`/api/user`)
      .then((res) => {
        console.log(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
