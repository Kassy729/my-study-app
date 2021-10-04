<template>
  <v-container>
    <note-list />
    <v-row>
      <v-col cols="8"><h3>My Github Farm</h3></v-col>
      <v-col><v-img src="https://ghchart.rshah.org/Kassy729"/></v-col>
    </v-row>
  </v-container>
</template>

<script>
import noteList from "../components/noteList.vue";
// import axios from 'axios';

export default {
  components: { noteList },
};
</script>
