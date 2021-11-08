<template>
  <div id="todo-app">
    <h1>MY-TODO</h1>
    <todo-input />
    <todo-list />
    <todo-clear />
    <v-btn @click="onClickReturn">돌아가기</v-btn>
  </div>
</template>

<script>
import TodoInput from "./TodoInput";
import TodoList from "./TodoList";
import TodoClear from "./TodoClear";
export default {
  name: "todo-app",
  components: {
    TodoInput,
    TodoList,
    TodoClear,
  },
  methods: {
    onClickReturn() {
      this.$router.push({ path: "/" });
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
