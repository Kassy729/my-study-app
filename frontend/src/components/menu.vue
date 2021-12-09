<template>
  <div>
    <v-toolbar flat color="11264f" dark>
      <v-toolbar-title
        ><v-icon large color="white"> mdi-book-open-variant </v-icon
        >MyStudyApp</v-toolbar-title
      >
      <v-spacer></v-spacer>

      <div color="white" v-if="this.users.name == null">
        로그인 해주세요
      </div>

      <div v-else>{{ this.users.name }}님 환영합니다</div>

      <v-btn
        class="ma-2"
        outlined
        color="white"
        @click="login"
        v-if="this.$store.state.auth.user == null"
      >
        Sign ip
      </v-btn>
      <v-btn class="ma-2" outlined color="white" @click="logout" v-else>
        Logout
      </v-btn>
    </v-toolbar>
  </div>
</template>

<script>
import axios from "axios";
// import axios from "axios";

export default {
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.user();
  },
  computed: {
    userId() {
      return this.$store.state.auth.user.user.id;
    },
  },

  methods: {
    login() {
      this.$router.push({ path: "/login" });
    },

    logout() {
      this.$store.dispatch("auth/logout");
    },

    user() {
      const form = new FormData();
      form.append("userId", this.userId);
      axios
        .post("http://35.76.24.183:8000/api/user", form)
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
