<template>
  <v-container>
    <h1>MY-TODO</h1>

    <div>
      <v-icon @click.stop="drawer = !drawer">mdi-firebase</v-icon>
    </div>

    <v-navigation-drawer v-model="drawer" absolute bottom temporary>
      <v-list nav dense>
        <v-list-item-group active-class="deep-purple—text text—accent-4">
          <v-list-item>
            <v-list-item-title>Foo</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Bar</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Fizz</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Buzz</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <div id="todo-app">
      <todo-input />
      <todo-list />
      <todo-clear />
      <v-btn @click="onClickReturn">돌아가기</v-btn>
    </div>
  </v-container>
</template>

<script>
import TodoInput from "./TodoInput";
import TodoList from "./TodoList";
import TodoClear from "./TodoClear";
export default {
  name: "todo-app",
  data: () => ({
    drawer: false,
    group: null,
  }),

  watch: {
    group() {
      this.drawer = false;
    },
  },
  components: {
    TodoInput,
    TodoList,
    TodoClear,
  },
  methods: {
    onClickReturn() {
      this.$router.push({ path: "/" });
      location.reload();
    },
  },
};
</script>

<style scoped>
#todo-app {
  margin: 0 0.5rem;
  position: relative;
}
h1 {
  color: #484848;
  text-align: center;
  padding-top: 2.5rem;
}
</style>
