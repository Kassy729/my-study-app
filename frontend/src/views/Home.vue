<template>
  <v-card>
    <v-toolbar flat color="11264f" dark>
      <v-toolbar-title>MyStudyApp</v-toolbar-title>
    </v-toolbar>
    <v-app-bar align="center">
      <v-row>
        <v-col>
          <v-btn text @click="selectedComponent = 'create'">
            <v-icon large color="black"> mdi-pencil </v-icon>
            Note작성</v-btn
          >
          <v-btn text @click="selectedComponent = 'noteList'">
            <v-icon large color="black"> mdi-book-open-variant</v-icon
            >Note목록보기</v-btn
          >
          <v-btn text @click="selectedComponent = 'noteList'">
            <v-icon large color="black"> mdi-clipboard-edit-outline </v-icon
            >TodoList</v-btn
          >
          <v-btn text @click="selectedComponent = 'test'">test</v-btn>
          <v-btn text @click="selectedComponent = 'test'">test</v-btn>
          <v-btn text @click="selectedComponent = 'test'">test</v-btn>
          <v-btn text @click="selectedComponent = 'test'">test</v-btn>
        </v-col>
      </v-row>
    </v-app-bar>
    <v-container>
      <v-row>
        <v-col cols="auto"> <profile /> </v-col>
        <v-col><component v-bind:is="selectedComponent"> </component></v-col>
      </v-row>
    </v-container>
  </v-card>
</template>

<script>
import create from "../components/create.vue";
import noteList from "../components/noteList.vue";
import profile from "../components/profile.vue";

export default {
  data() {
    return {
      posts: [],
      selectedComponent: "create",
    };
  },
  components: {
    create,
    noteList,
    profile,
  },
};
</script>

<style>
.profileImg {
  width: 300px;
  height: 300px;
  border-radius: 70%;
  overflow: hidden;
}
</style>
