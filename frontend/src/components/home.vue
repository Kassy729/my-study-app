<template>
  <v-card>
    <menu-table />
    <v-app-bar align="center">
      <v-row>
        <v-col>
          <v-btn text @click="selectedComponent = 'home'">
            <v-icon large color="black"> mdi-home </v-icon>
            Home</v-btn
          >
          <v-btn text @click="selectedComponent = 'create'">
            <v-icon large color="black"> mdi-pencil </v-icon>
            Note작성</v-btn
          >
          <v-btn text @click="selectedComponent = 'noteList'">
            <v-icon large color="black"> mdi-book-open-variant</v-icon
            >Note목록보기</v-btn
          >
          <v-btn text @click="selectedComponent = 'todoList'">
            <v-icon large color="black"> mdi-clipboard-edit-outline </v-icon
            >TodoList</v-btn
          >
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
import todoList from "../components/todolist.vue";
import MenuTable from "../components/menu.vue";

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
    todoList,
    MenuTable,
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
