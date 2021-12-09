<template>
  <v-form mt-10 ref="form">
    <v-container>
      <h1 class="title">회원가입</h1>
      <br />
      <span>ProfileImage</span>
      <v-file-input
        accept="image/png, image/jpeg, image/bmp"
        enctype="multipart/form-data"
        placeholder="Pick an avatar"
        prepend-icon="mdi-camera"
        label="File input"
        @change="selectFile"
      ></v-file-input>
      <template v-slot:selection="{ index, text }">
        <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>
          {{ text }}
        </v-chip>

        <span
          v-else-if="index === 2"
          class="text-overline grey--text text--darken-3 mx-2"
        >
          +{{ files.length - 2 }} File(s)
        </span>
      </template>

      <span>이름</span>
      <v-text-field
        v-model="name"
        :counter="10"
        :rules="nameRules"
        label="Name"
        required
        outlined
      ></v-text-field>
      이메일
      <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail 입력"
        required
        outlined
      ></v-text-field>
      비밀번호
      <v-text-field
        type="password"
        v-model="password"
        :rules="passwordRules"
        label="password 입력"
        required
        outlined
      ></v-text-field>

      비밀번호 확인
      <v-text-field
        type="password"
        v-model="password2"
        label="password 확인"
        required
        outlined
      ></v-text-field>

      <v-btn
        block
        :disabled="!buttonActivation"
        color="success"
        class="mr-4"
        @click="validate"
      >
        go register
      </v-btn>
    </v-container>
  </v-form>
</template>

<script>
import axios from "axios";
// import axios from "axios";

export default {
  data() {
    return {
      valid: false,
      name: "",
      password: "",
      password2: "",
      email: "",
      password_confirmation: true,

      nameRules: [
        (v) => !!v || "이름을 입력해주세요.",
        (v) => (v && v.length <= 10) || "이름은 10글자 이하로 입력해주세요.",
      ],
      emailRules: [
        (v) => !!v || "이메일을 입력해주세요.",
        (v) => /.+@.+\..+/.test(v) || "이메일 형식이 올바르지 않습니다.",
      ],
      passwordRules: [
        (v) => !!v || "비밀번호를 입력해주세요.",
        (v) => v.length > 7 || "비밀번호는 최소 8자 이상으로 입력해주세요.",
      ],
    };
  },
  computed: {
    buttonActivation: function() {
      if (
        this.name === "" ||
        this.password === "" ||
        this.password2 === "" ||
        this.email === "" ||
        this.password !== this.password2 ||
        /.+@.+\..+/.test(this.email) == false
      ) {
        return false;
      } else return true;
    },
  },
  methods: {
    validate() {
      if (this.password != this.password2) {
        return alert("비밀번호가 일치하지 않습니다.");
      } else {
        this.password_confirmation = true;
      }

      const form = new FormData();
      form.append("image", this.image);
      form.append("email", this.email);
      form.append("name", this.name);
      form.append("password", this.password);
      form.append("password_confirmation", this.password_confirmation);
      axios
        .post("http://35.76.24.183:8000/api/register", form)
        .then(() => {
          // console.log(res.data);
          this.$router.push("/login");
        })
        .catch((err) => {
          console.log("가입이 안됐어용ㅠ");
          if (err.response.data.email.length == 1) {
            alert("이미 사용 중인 이메일입니다. 이메일을 다시 입력해주세요.");
          } else
            alert("사용 불가능한 이메일 입니다. 이메일을 다시 입력해주세요.");
          this.email = "";
        });
    },
    selectFile(file) {
      this.image = file;
    },
  },
};
</script>

<style scoped>
.title {
  text-align: center;
}
.container {
  max-width: 500px;
}
</style>
