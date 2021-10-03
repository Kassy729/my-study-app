<template>
  <v-card>
    <v-toolbar flat color="11264f" dark>
      <v-toolbar-title>MyStudyApp</v-toolbar-title>
    </v-toolbar>
    <v-row>
      <v-col>
        <v-btn @click="selectedComponent = 'create'">create</v-btn>
        <v-btn @click="selectedComponent = 'noteList'">List</v-btn>
        <v-btn @click="selectedComponent = 'test'">test</v-btn>
        <component v-bind:is="selectedComponent">
          <p>Default</p>
        </component>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
import create from "../components/create.vue";
import noteList from "../components/noteList.vue";
import test from "../components/test.vue";

export default {
  data() {
    return {
      posts: [],
      selectedComponent: "test",
    };
  },
  components: {
    create,
    noteList,
    test,
  },
};
</script>
