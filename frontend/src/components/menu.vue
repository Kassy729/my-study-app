<template>
  <div>
    <v-toolbar flat color="11264f" dark>
      <v-toolbar-title
        ><v-icon large color="white"> mdi-book-open-variant </v-icon
        >MyStudyApp</v-toolbar-title
      >
      <v-spacer></v-spacer>

      <v-btn
        class="ma-2"
        outlined
        color="white"
        @click="login"
        v-if="this.$store.state.auth.user == null"
      >
        Sign up
      </v-btn>
      <v-btn class="ma-2" outlined color="white" @click="logout" v-else>
        Logout
      </v-btn>
    </v-toolbar>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    login() {
      this.$router.push({ path: "/login" });
    },
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },
};
</script>
